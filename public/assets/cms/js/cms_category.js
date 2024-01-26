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
    form: '#form-category',
    nextStep: '#submit-add',
    formGroupSelector: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('input[name=name]', 'Por favor no deje este campo en blanco'),
        Validator.maxLength('input[name=name]', 150),
        Validator.isRequired('input[name=image]', 'Por favor no deje este campo en blanco'),
    ],
});

$(document).on('click', '[data-toggle="modal"][data-target="#modal-edit-category"]', function() {
    let id = $(this).data('category_id');
    let name = $("#nameCategory_" + id).html();
    let img = $("#imgCategory_" + id).html();
    $('input[name=id]').val(id);
    $('#preview-img').html(img);
    $('input[name=name_edit]').val(name);

    Validator({
        form: '#form-edit',
        nextStep: '#submit-edit',
        formGroupSelector: '.form-group',
        errorSelector: '.form-message',
        rules: [
            Validator.isRequired('input[name=name_edit]', 'Por favor no deje este campo en blanco'),
            Validator.maxLength('input[name=name_edit]', 150),
        ],
    });
});
