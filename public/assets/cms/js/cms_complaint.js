$(document).ready(function () {
    let page = 0;
    let table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        paging: true,
        autoWidth: true,
        order: [[7, 'desc']],
        lengthMenu: [[10, 25, 50, 100, 500, -1],[10, 25, 50, 100, 500, 'All']],
        fnDrawCallback: function () {
            page = this.api().page();
        },
        "oLanguage": {
            "sZeroRecords": "No data",
            "sInfoEmpty": "No data",
            "sInfoFiltered": "(filtered from _MAX_ total records)",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Next",
                "sPrevious": "Previous"
            },
        },
        ajax: {
            url: 'pagination.php',
            data: function (d) {
                d.status = $('#complaint-status').val();
                d.type = $('#complaint-type').val();
                d.startDate = $('#start-date').val();
                d.endDate = $('#end-date').val();
                d.log = 'Complaint'
            },
        },
        columns: [
            {
                data: 'id', ordering: true,
                render: function (colValue, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {
                data: 'msisdn', ordering: true,
                render: function (colValue, type, row, meta) {
                    return colValue;
                }
            },
            {
                data: 'option_name', orderable: false,
                render: function (colValue, type, row, meta) {
                    return colValue;
                }
            },
            {
                data: 'content', ordering: true,
                render: function (colValue, type, row, meta) {
                    return colValue;
                }
            },
            {
                data: 'reward', orderable: false,
                render: function (colValue, type, row, meta) {
                    return colValue;
                }
            },
            {
                data: 'type', ordering: true,
                render: function (colValue, type, row, meta) {
                    return colValue;
                }
            },
            {
                data: 'status', ordering: true,
                render: function (colValue, type, row, meta) {
                    let html = '';
                    if (colValue == 0) {
                        html = `<select class="status-complaint bg-complaint-0 update-status-complaint" id="IdComplaint_${row.id}" data-id="${row.id}" data-status_complaint="${row.status}">
                    <option value="0" selected >Pendiente</option>
                    <option value="1">En Proceso</option>
                    <option value="2">Resuelto</option>
                  </select>`;
                    } else if (colValue == 1) {
                        html = `<select class="status-complaint bg-complaint-1 update-status-complaint" id="IdComplaint_${row.id}" data-id="${row.id}" data-status_complaint="${row.status}">
                    <option value="0">Pendiente</option>
                    <option value="1" selected>En Proceso</option>
                    <option value="2">Resuelto</option>
                  </select>`;
                    } else {
                        html = `<span style="margin: 0 5px" class="status-complaint d-block bg-complaint-2">Resuelto</span>`
                    }
                    return html;
                }
            },
            {
                data: 'created_at', ordering: true,
                render: function (colValue, type, row, meta) {
                    return colValue;
                }
            },
        ],
    });

    table.on('order', function() {
        if (table.page() !== page) {
            table.page(page).draw('page');
        }
    });

    $(document).on('click', '#btn-search', function () {
        table.draw();
    });

    $('#export-excel').on('click', function () {
        let data = table.ajax.params();
        $.ajax({
            url: 'excelComplain.php',
            method: 'POST',
            data: data,
            success: function (res)
            {
                console.log(res)
                window.location.href = '/assets/files/complaint/complaint.csv';
            },
            error: function () {

            },
        })
    })
});


$(document).on('change', ".update-status-complaint",function(){
    let id = $(this).data('id');
    let StatusComplaint = $('#IdComplaint_'+id).val();
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
                url : 'complaint.php',
                type : 'POST',
                dataType : 'json',
                data : {
                    status : StatusComplaint,
                    id : id
                },
                success: function (data)
                {
                }
            });
            Swal.fire({
                title: 'Updated!',
                text: 'Update successful complaint!',
                icon: 'success',
                willClose: () => {
                    window.location.reload();
                }
            });
        }
    });
})
