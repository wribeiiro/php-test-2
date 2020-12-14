if ($('#sectionProducts').length) {

    datatableProducts()

    $('#addProduct').click(() => {
        $('#id').val('')
        $('#description').val('')
        $('#price').val('')
        $('#productType').prop('selectedIndex', 0)
        $('#modalProducts').modal('show')
    })

    function datatableProducts() {
        tableProducts = $(`#tableProducts`).DataTable({
            sPaginationType: "full_numbers",
            destroy: true,
            responsive: false,
            ajax: {
                url: `${BASE_URL}products/getAll`,
                dataType: "JSON",
                cache: false,
                dataSrc: (data) => {
                    return data.data || []
                },
                error: (e) => {
                    $("#addProduct").removeAttr("disabled").find("i").removeClass("fa-spinner fa-spin").addClass("fa-plus")
                },
                beforeSend: (xhr) => {
                    $("#addProduct").attr("disabled", true).find("i").removeClass("fa-plus").addClass("fa-spinner fa-spin")
                },
                complete: () => {
                    $("#addProduct").removeAttr("disabled").find("i").removeClass("fa-spinner fa-spin").addClass("fa-plus")
                }
            },
            order: [[0, "DESC"]],
            columns: [
                {
                    data: "id",
                    class: "text-right",
                },
                {
                    data: "description",
                    class: "text-left",
                },
                {
                    data: "price",
                    class: "text-right",
                    render: function(data) {
                        return numberFormat(data)
                    }
                },
                {
                    data: "product_type_name",
                    class: "text-left",
                },
                {
                    orderable: false,
                    data: null,
                    defaultContent: ``,
                    render: (data, type, row, meta) => {
                        return `
                        <button type="button" class="btn btn-purple btn-sm" onclick="editModal('${data.id}', '${data.description}', '${data.price}', '${data.product_type_id}')"> <i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm"  onclick="deleteProduct('${data.id}')"> <i class="fa fa-trash"></i></button>`
                    }
                }
            ]
        })
    }

    function editModal(id, description, price, type) {
        $('#id').val(id)
        $('#description').val(description)
        $('#price').val(currencyToNumber(price))
        $('#productType').val(type)
        $('#modalProducts').modal('show')
    }

    function deleteProduct(id) {
        $.ajax({
            url: `${BASE_URL}products/delete/${id}`,
            method: "DELETE",
            dataType: 'JSON',
            success: (data) => {
                if (data.code === 200) {
                    toastr.success('Product is deleted!', 'Success!')
                    tableProducts.ajax.reload()
                }
            },
            error: (e) => {
                toastr.error('Ops, a error ocurred!', 'Error!')
            }
        })
    }

    $('#saveProduct').on('click', () => {

        const params = {
            url: `${BASE_URL}products/create`,
            method: 'POST',
            data: {
                description: $('#description').val().trim(),
                price: parseFloat($('#price').val()),
                product_type_id: parseInt($('#productType option:selected').val())
            }
        }

        if ($('#id').val().trim()) {
            params.url     = `${BASE_URL}products/update/${$('#id').val().trim()}`
        }

        if ($('#description').val().trim() === "") {
            toastr.warning('Description is required', 'Warning')
            return
        }
        
        if ($('#price').val() === "" || $('#price').val() == 0) {
            toastr.warning('Price is required', 'Warning')
            return
        }

        if ($('#productType option:selected').val().trim() === "") {
            toastr.warning('ProductType is required', 'Warning')
            return
        }

        $.ajax({
            url: params.url,
            method: params.method,
            data: params.data,
            dataType: 'JSON',
            success: (data) => {
                if (data.code === 200 || data.code === 201) {
                    toastr.success('Product created/updated!', 'Success!')
                } else {
                    toastr.warning(data.data, 'Warning!')
                }

                tableProducts.ajax.reload()
            },
            error: (e) => {
                console.log(e)
                toastr.error(e.responseJSON.data, 'Error!')
            }
        })

        $('#modalProducts').modal('hide')
    })
    
}