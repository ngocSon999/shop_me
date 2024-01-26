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
});

Validator({
    form: '#form-add',
    nextStep: '#submit-add',
    formGroupSelector: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('input[name=name]', 'Por favor no deje este campo en blanco'),
        Validator.maxLength('input[name=name]', 200),

        Validator.isRequired('input[name=image]', 'Por favor no deje este campo en blanco'),
    ],
});

function editBanner(id) {
    let name = $("#nameBanner_" + id).html();
    let img = $("#imgBanner_" + id).html();
    let render = `<div class="card card-info">
            <form class="form-horizontal" id="form-edit" method="POST" enctype="multipart/form-data">
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
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Image</label>
                  <div class="col-sm-10">
                    ` + img + `
                    <input type="file" class="btn btn-success col fileinput-button dz-clickable" name="image_edit" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                    <div class="form-message color-red"></div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-info" id="submit-edit">Save</button>
                    <button type="button" class="btn btn-default float-right" data-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
              </div>
            </form>
          </div>`;
    $("#modal-content-edit").html(render);

    Validator({
        form: '#form-edit',
        nextStep: '#submit-edit',
        formGroupSelector: '.form-group',
        errorSelector: '.form-message',
        rules: [
            Validator.isRequired('input[name=name_edit]', 'Por favor no deje este campo en blanco'),
            Validator.maxLength('input[name=name_edit]', 200),
        ],
    });
}

$(document).on('click', '#update-type-banner', function () {
    const id = $(this).data('banner_id');
    const type = $(this).data('type');
    let log;
    if (type === 0) {
        log = "check_type_banner";
    } else {
        log = "update_type_banner"
    }

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
