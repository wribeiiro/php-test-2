if ($('#sectionProductsType').length) {

    datatableProductsType()

    $('#addType').click(() => {
        $('#id').val('')
        $('#description').val('')
        $('#taxPercentage').val('')
        $('#modalProductsType').modal({backdrop: 'static', keyboard: false})
    })

    function datatableProductsType() {
        tableProductsType = $(`#tableProductsType`).DataTable({
            sPaginationType: "full_numbers",
            destroy: true,
            responsive: false,
            ajax: {
                url: `${BASE_URL}products-type/getAll`,
                dataType: "JSON",
                cache: false,
                dataSrc: (data) => {
                    return data.data || []
                },
                error: (e) => {
                    $("#addType").removeAttr("disabled").find("i").removeClass("fa-spinner fa-spin").addClass("fa-plus")
                },
                beforeSend: (xhr) => {
                    $("#addType").attr("disabled", true).find("i").removeClass("fa-plus").addClass("fa-spinner fa-spin")
                },
                complete: () => {
                    $("#addType").removeAttr("disabled").find("i").removeClass("fa-spinner fa-spin").addClass("fa-plus")
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
                    data: "tax_percentage",
                    class: "text-right",
                    render: function(data) {
                        return numberFormat(data)
                    }
                },
                {
                    orderable: false,
                    data: null,
                    defaultContent: ``,
                    render: (data, type, row, meta) => {
                        return `
                        <button type="button" class="btn btn-purple btn-sm" onclick="editModal('${data.id}', '${data.description}', '${data.tax_percentage}')"> <i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm"  onclick="deleteType('${data.id}')"> <i class="fa fa-trash"></i></button>`
                    }
                }
            ]
        })
    }

    function editModal(id, description, taxPercentage) {
        $('#id').val(id)
        $('#description').val(description)
        $('#taxPercentage').val(currencyToNumber(taxPercentage))
        $('#modalProductsType').modal({backdrop: 'static', keyboard: false})
    }

    function deleteType(id) {
        $.ajax({
            url: `${BASE_URL}products-type/delete/${id}`,
            method: "DELETE",
            dataType: 'JSON',
            success: (data) => {
                if (data.code === 200) {
                    toastr.success('Type is deleted!', 'Success!')
                    tableProductsType.ajax.reload()
                }
            },
            error: (e) => {
                toastr.error('Ops, a error ocurred!', 'Error!')
            }
        })
    }

    $('#saveType').on('click', () => {

        const params = {
            url: `${BASE_URL}products-type/create`,
            method: 'POST',
            data: {
                description: $('#description').val().trim(),
                tax_percentage: parseFloat($('#taxPercentage').val()),
            }
        }

        if ($('#id').val().trim()) {
            params.url     = `${BASE_URL}products-type/update/${$('#id').val().trim()}`
        }

        if ($('#description').val().trim() === "") {
            toastr.warning('Description is required', 'Warning')
            return
        }
        
        if ($('#taxPercentage').val() === "" || $('#taxPercentage').val() == 0) {
            toastr.warning('Tax Percentage is required', 'Warning')
            return
        }

        $.ajax({
            url: params.url,
            method: params.method,
            data: params.data,
            dataType: 'JSON',
            success: (data) => {
                if (data.code === 200 || data.code === 201) {
                    toastr.success('Type created/updated!', 'Success!')
                } else {
                    toastr.warning(data.data, 'Warning!')
                }

                tableProductsType.ajax.reload()
            },
            error: (e) => {
                if (e.responseJSON.code === 400) {
                    toastr.warning(e.responseJSON.data, 'Warning!')
                } else {
                    toastr.error(e.responseJSON.data, 'Error!')
                }
            }
        })

        $('#modalProductsType').modal('hide')
    })
    
}