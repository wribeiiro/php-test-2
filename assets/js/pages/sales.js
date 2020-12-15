if ($('#sectionSales').length) {
    let totalItem = 0
    let totalTax  = 0

    datatableSales()
    
    $('#addSale').click(() => {
        $('#id').val('')
        $('#clientName').val("").trigger("change")
        $('#productName').val("").trigger("change")
        $('#quantity').val('1,00')
        $('#price').val('0,00')
        $('#tax').val('0,00')
        $('#totalItem').val('0,00')
        $('#tableItensSales tbody').empty()
        $('#totalTax').val('0,00')
        $('#totalSale').val('0,00')

        $('#saveSale').removeAttr('disabled')
        $('#addItem').removeAttr('disabled')
        $('#productName').removeAttr('disabled')
        $('#clientName').removeAttr('disabled')
        $('#quantity').removeAttr('disabled')

        $('#modalSales').modal({backdrop: 'static', keyboard: false})

        totalItem = 0
        totalTax  = 0
    })

    function datatableSales() {
        tableSales = $(`#tableSales`).DataTable({
            sPaginationType: "full_numbers",
            destroy: true,
            responsive: false,
            ajax: {
                url: `${BASE_URL}sales/getAll`,
                dataType: "JSON",
                cache: false,
                dataSrc: (data) => {
                    return data.data || []
                },
                error: (e) => {
                    $("#addSale").removeAttr("disabled").find("i").removeClass("fa-spinner fa-spin").addClass("fa-plus")
                },
                beforeSend: (xhr) => {
                    $("#addSale").attr("disabled", true).find("i").removeClass("fa-plus").addClass("fa-spinner fa-spin")
                },
                complete: () => {
                    $("#addSale").removeAttr("disabled").find("i").removeClass("fa-spinner fa-spin").addClass("fa-plus")
                }
            },
            order: [[0, "DESC"]],
            columns: [
                {
                    data: "id",
                    class: "text-right",
                },
                {
                    data: "client_name",
                    class: "text-left",
                },
                {
                    data: "total_tax",
                    class: "text-right",
                    render: function(data) {
                        return numberFormat(data)
                    }
                },
                {
                    data: "total_price",
                    class: "text-right",
                    render: function(data) {
                        return numberFormat(data)
                    }
                },
                {
                    data: "created_at",
                    class: "text-left",
                    render: function(data) {
                        return dateToDayMonthYear(data)
                    }
                },
                {
                    orderable: false,
                    data: null,
                    defaultContent: ``,
                    render: (data, type, row, meta) => {
                        return `
                        <button type="button" class="btn btn-purple btn-sm" onclick="editModal('${data.id}', '${data.client_name}', 'null')"> <i class="fa fa-search"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteSale('${data.id}')"> <i class="fa fa-trash"></i></button>`
                    }
                }
            ]
        })
    }

    function editModal(id, clientName, items) {
        $('#id').val(id)
        $('#clientName').val(clientName).trigger("change")

        $('#saveSale').attr('disabled', true)
        $('#addItem').attr('disabled', true)
        $('#productName').attr('disabled', true)
        $('#clientName').attr('disabled', true)
        $('#quantity').attr('disabled', true)
        
        $.ajax({
            url: `${BASE_URL}sales/getItems/${id}`,
            method: "GET",
            dataType: 'JSON',
            success: (data) => {
                if (data.code === 200) {
                    populateTableItems(data.data)
                    $('#modalSales').modal({backdrop: 'static', keyboard: false})
                }
            },
            error: (e) => {
                console.log(e)
                toastr.error('Ops, a error ocurred!', 'Error!')
            }
        })
    }

    function deleteSale(id) {
        $.ajax({
            url: `${BASE_URL}sales/delete/${id}`,
            method: "DELETE",
            dataType: 'JSON',
            success: (data) => {
                if (data.code === 200) {
                    toastr.success('Sale is deleted!', 'Success!')
                    tableSales.ajax.reload()
                }
            },
            error: (e) => {
                toastr.error('Ops, a error ocurred!', 'Error!')
            }
        })
    }

    $('#addItem').on('click', () => {
        let strItem = ``
        let itemExists = false

        if ($('#clientName option:selected').val().trim() === "") {
            toastr.warning('Client is required', 'Warning')
            return
        }

        if ($('#productName option:selected').val().trim() === "") {
            toastr.warning('Product is required', 'Warning')
            return
        }
        
        if ($('#quantity').val() === "" || $('#quantity').val() == 0) {
            toastr.warning('Quantity is required', 'Warning')
            return
        }

        if ($('#price').val() === "" || $('#price').val() == 0) {
            toastr.warning('Price is required', 'Warning')
            return
        }

        $('#tableItensSales').find("tbody tr").each(function () {
            itemExists = false 

            if ($('#productName option:selected').val() == $(this).find("td:eq(0)").html()) {
                itemExists = true
            }
        })

        if (itemExists === false) {
            strItem = `<tr class="deleteItem">
                            <td>${$('#productName option:selected').val()}</td>
                            <td>${$('#productName option:selected').text()}</td>
                            <td>${numberFormat($('#price').val())}</td>
                            <td>${numberFormat($('#quantity').val())}</td>
                            <td>${numberFormat($('#tax').val())}</td>
                            <td>${numberFormat($('#totalItem').val())}</td>
                            <td><button type="button" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></button></td>
                        </tr>`

            $('#tableItensSales').append(strItem)
            clearItemFields()
        } else {
            toastr.warning(`${$('#productName option:selected').text()} already exists`)  
        }

        calculateTotalItem()
        $('#addItem').focus()
    })

    function populateTableItems(data) {
        let strItem = ``

        if (!data) {
            return
        }

        data.forEach(el => {
            strItem += `<tr class="deleteItem">
                            <td>${el.product_id}</td>
                            <td>${el.product_name}</td>
                            <td>${numberFormat(el.price)}</td>
                            <td>${numberFormat(el.tax)}</td>
                            <td>${numberFormat(el.quantity)}</td>
                            <td>${numberFormat(calculateItem(el.price, el.quantity, el.tax))}</td>
                            <td><button type="button" class="btn btn-danger btn-sm" disabled> <i class="fa fa-trash"></i></button></td>
                        </tr>`
        })

        $('#tableItensSales').append(strItem)
        calculateTotalItem()
    }

    function calculateItem(price, quantity, tax) {
        //return (currencyToNumber($('#price').val()) * currencyToNumber($('#quantity').val())) + currencyToNumber($('#tax').val())
        return (currencyToNumber(price) * currencyToNumber(quantity)) + currencyToNumber(tax)
    }

    function calculateTotalItem() {
        totalTax  = 0
        totalItem = 0
        $('#tableItensSales').find("tbody tr").each(function () {
            
            let tax   = currencyToNumber($(this).find("td:eq(4)").html())
            totalTax += tax

            let value = currencyToNumber($(this).find("td:eq(5)").html())
            totalItem += value
        })

        $('#totalTax').val(totalTax)
        $('#totalSale').val(totalItem)
    }

    $('#quantity, #price').on('change', function() {
        $("#totalItem").val(currencyToNumber(calculateItem($('#price').val(), $('#quantity').val(), $('#tax').val())))
    })

    $('#productName').on('change', function() {
        $('#price').val(numberFormat($(this).find(':selected').data('price')))
        $('#tax').val(numberFormat($(this).find(':selected').data('tax')))
        
        $("#totalItem").val(numberFormat(calculateItem($('#price').val(), $('#quantity').val(), $('#tax').val())))
    })

    function clearItemFields() {
        $('#productName').val("").trigger("change")
        $('#quantity').val('1,00')
        $('#price').val('0,00')
        $('#tax').val('0,00')
        $('#totalItem').val('0,00')
    }

    $("#tableItensSales").on("click", ".deleteItem", function() {
        $(this).closest("tr").remove()
        calculateTotalItem()
    })
     
    $('#saveSale').on('click', () => {

        const params = {
            url: `${BASE_URL}sales/create`,
            method: 'POST',
            data: {
                description: $('#description').val().trim(),
                price: parseFloat($('#price').val()),
                product_type_id: parseInt($('#productType option:selected').val())
            }
        }

        if ($('#id').val().trim()) {
            params.url  = `${BASE_URL}products/update/${$('#id').val().trim()}`
        }

        $.ajax({
            url: params.url,
            method: params.method,
            data: params.data,
            dataType: 'JSON',
            success: (data) => {
                if (data.code === 200 || data.code === 201) {
                    toastr.success('Sale created/updated!', 'Success!')
                } else {
                    toastr.warning(data.data, 'Warning!')
                }

                tableSales.ajax.reload()
            },
            error: (e) => {
                console.log(e)
                toastr.error(e.responseJSON.data, 'Error!')
            }
        })

        $('#modalSales').modal('hide')
    })
    
}