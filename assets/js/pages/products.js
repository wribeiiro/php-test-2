$('#addProduct').click(() => {
    $('#id').val('')
    $('#name').val('')
    $('#price').val('')
    $('#type').prop('selectedIndex',0)
    $('#modalProducts').modal('show')
})

function datatableProducts() {
    tableProducts = $(`#tableProducts`).DataTable({
        sPaginationType: "full_numbers",
        destroy: true,
        responsive: false,
        ajax: {
            url: `${BASE_URL}/products/get`,
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
                data: "name",
                class: "text-left",
            },
            {
                data: "price",
                class: "text-left",
            },
            {
                data: "type",
                class: "text-left",
            },
            {
                orderable: false,
                data: null,
                defaultContent: ``,
                render: (data, type, row, meta) => {
                    return `
                    <button type="button" class="btn btn-purple btn-sm" onclick="editModal('${data.id}', '${data.name}', '${data.price}', '${data.type}')"> <i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm"  onclick="deleteProduct('${data.id}')"> <i class="fa fa-trash"></i></button>`
                }
            }
        ]
    })
}

function editModal(id, name, price, type) {
    $('#id').val(id)
    $('#name').val(name)
    $('#price').val(price)
    $('#type').val(type)
    $('#modalProducts').modal('show')
}

function deleteSpeaker(id) {
    $.ajax({
        url: `${BASE_URL}/products/delete/${id}`,
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

$('#saveProducts').on('click', () => {

    const params = {
        url: `${BASE_URL}/products/create`,
        method: 'POST',
        data: {
            name: $('#name').val().trim(),
            price: $('#price').val().trim(),
            type: $('#type option:selected').val()
        }
    }

    if ($('#id').val().trim()) {
        params.url     = `${BASE_URL}/products/update/${params.data.id}`
        params.method  = 'PUT'
        params.data.id = parseInt($('#id').val().trim())
    }

    if ($('#name').val().trim() === "") {
        toastr.warning('Name is required', 'Warning')
        return
    }
    
    if ($('#price').val().trim() === "") {
        toastr.warning('Price is required', 'Warning')
        return
    }

    if ($('#type').val().trim() === "") {
        toastr.warning('Type is required', 'Warning')
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
            toastr.error('Ops, a error ocurred!', 'Error!')
        }
    })

    $('#modalProducts').modal('hide')
})
