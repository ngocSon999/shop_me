$(document).ready(function () {
    $('#table').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "lengthMenu": [10, 25, 50, 100],
        "columnDefs": [
            {
                "targets": 0,
                "data": null,
                "ordering": true,
                "searchable": false,
                "render": function (data, type, full, meta) {
                    return meta.row + 1;
                }
            }
        ]
    });
})

Validator({
    form: '#form-product',
    nextStep: '#submit-add',
    formGroupSelector: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('input[name=name]', 'Por favor no deje este campo en blanco'),
        Validator.maxLength('input[name=name]', 50),

        Validator.isRequired('select[name=categoryId]', 'Por favor no deje este campo en blanco'),
        Validator.isRequired('input[name=img]', 'Por favor no deje este campo en blanco'),
        Validator.maxLength('textarea[name=description]', 200),
        Validator.maxLength('textarea[name=message_sms]', 255),

        Validator.isRequired('input[name=price]', 'Por favor no deje este campo en blanco'),
        Validator.maxLength('input[name=price]', 11),

        Validator.isRequired('input[name=cantidad]', 'Por favor no deje este campo en blanco'),
        Validator.maxLength('input[name=cantidad]', 8),
        Validator.isNumberPositive('input[name=cantidad]'),
    ],
});



$(document).on('click', '.btn-check-update-status', function () {
    let id = $(this).data('id');
    let log = $(this).data('log');
    let active = $(this).data('active');
    Swal.fire({
        title: 'Are you sure?',
        text: 'You want to update!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#007bff',
        cancelButtonColor: '#fd7e14',
        confirmButtonText: 'OK',
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: 'delete.php',
                type: 'post',
                dataType: 'json',
                data: {
                    log: log,
                    id: id,
                    active: active
                },
                success : function (data)
                {
                    if(data.rs == true){
                        Swal.fire({
                            title: 'Updated!',
                            text: data.msg,
                            icon: 'success',
                            willClose: () => {
                                window.location.reload();
                            }
                        });
                    } else {
                        Swal.fire('Error', 'Failed to delete the record.', 'error');
                    }
                }
            });
        }
    });
})

async function getCategories(id) {
    try {
        const categoriesResponse = await fetch(`/api/categories/`);
        const categoriesData = await categoriesResponse.json();
        editProduct(id, categoriesData);
    } catch (error) {
        console.error(error);
    }
}

function editProduct(id, categoriesData) {
    let name = $("#namePr_" + id).html();
    let img = $("#imgPr_" + id).html();
    let des = $("#desPr_" + id).html();
    let price = $("#pricePr_" + id).html();
    let cantidad = $("#cantidadPr_" + id).html();
    let type = $("#typePr_" + id).val();
    let categoryId = $("#categoryPr_" + id).val();
    let messageSms = $("#messageSmsPr_" + id).val();
    let categories = categoriesData.payload;

    let render = '';
    render += `<form class="form-horizontal" id="form-edit" method="POST" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="hidden" class="form-control" name="id" placeholder="Name" value="` + id + `">
                    <input type="text" class="form-control" name="name_edit" placeholder="Name" value="` + name + `">
                    <div class="form-message color-red"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Categories</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="categoryIdEdit">`
    categories.forEach(category => {
        render += `<option value="${category.id}" ${categoryId == category.id ? 'selected' : ''}>${category.name}</option>`;
    });
    render += `</select>
                    <div class="form-message color-red"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Image</label>
                  <div class="col-sm-10">
                    ` + img + `
                    <input type="file" class="btn btn-success col fileinput-button dz-clickable" name="image_edit" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                    <div class="form-message color-red"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Description (length of 200 words)</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="3" id="descriptionEdit" name="desciption" maxlength="200" placeholder="Enter ...">` + des + `</textarea>
                    <div class="form-message color-red"></div>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">SMS</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="3" id="messageSmsEdit" name="message_sms" maxlength="255" placeholder="Enter ...">` + messageSms + `</textarea>
                    <div class="form-message color-red"></div>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Price</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="price" placeholder="Price" value="` + price + `" maxlength="11">
                    <div class="form-message color-red"></div>
                    </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Quantity</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="cantidad" placeholder="Quantity" min="0" max="99999999" value="` + cantidad + `">
                    <div class="form-message color-red"></div>
                    </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" id="submit-edit" class="btn btn-info">Save</button>
                    <button type="button" class="btn btn-default float-right" data-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
              </div>
            </form>`;
    $("#modal-content-edit").html(render);
    Validator({
        form: '#form-edit',
        nextStep: '#submit-edit',
        formGroupSelector: '.form-group',
        errorSelector: '.form-message',
        rules: [
            Validator.isRequired('input[name=name_edit]', 'Por favor no deje este campo en blanco'),
            Validator.maxLength('input[name=name_edit]', 50),

            Validator.isRequired('select[name=categoryIdEdit]', 'Por favor no deje este campo en blanco'),

            Validator.maxLength('#descriptionEdit', 200),
            Validator.maxLength('#messageSmsEdit', 255),

            Validator.isRequired('input[name=price]', 'Por favor no deje este campo en blanco'),
            Validator.maxLength('input[name=price]', 11),

            Validator.isRequired('input[name=cantidad]', 'Por favor no deje este campo en blanco'),
            Validator.maxLength('input[name=cantidad]', 8),
            Validator.isNumberPositive('input[name=cantidad]'),
        ],
    });
}
