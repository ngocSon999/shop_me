@extends('admins.layouts.master')
@section('title', 'Contact')
@section("style")
    <style>

    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Feedback</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Contact</li>
                    </ol>
                </div>
            </div>
            <form class="row" action="" method="POST">
                <div class="form-group col-6 col-md-2">
                    <label>Trạng thái</label>
                    <select class="form-control" name="is_read" id="is_read">
                        <option value="">Tất cả</option>
                        <option value="0">not answered</option>
                        <option value="1">answered</option>
                    </select>
                </div>
                <div class="form-group d-flex col-6 col-md-2 align-items-end">
                    <button type="button" id="btn-search" class="btn btn-success swalDefaultSuccess mt-2 mr-2">Search</button>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="table" style="width: 100%" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Customer</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>IsRead</th>
                                    <th>CreatedAt</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="ContactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Send mail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="content-contact">
                        </div>
                        <div>
                            <input type="hidden" id="contact-id">
                            <input type="hidden" id="contact-subject">
                            <input type="hidden" id="contact-message">
                            <input type="hidden" id="contact-mail">
                            <div class="form-group">
                                <label for="title_mail">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title_mail" name="title_mail">
                            </div>
                            <div class="form-group">
                                <label for="content_mail">Content <span class="text-danger">*</span></label>
                                <textarea rows="3" class="form-control" id="content_mail" name="content_mail"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="send-mail">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $.fn.dataTable.ext.errMode = 'throw';
        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            lengthMenu: [10, 25, 50],
            "oLanguage": {
                "sLengthMenu": "Hiển thị _MENU_ dữ liệu trên trang",
                "sZeroRecords": "Không có dữ liệu",
                "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ dữ liệu",
                "sInfoEmpty": "Không có dữ liệu",
                "sInfoFiltered": "(được lọc from _MAX_ total records)",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Sau",
                    "sPrevious": "Trước"
                },
            },

            ajax: {
                url: '{{ route('admin.contacts.list') }}',
                data: function (d) {
                    d.is_read = $('#is_read').find('option:selected').val();
                }
            },
            columns: [
                {
                    data: 'id', ordering: true,
                    render: function (colValue, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'customer_id',
                    render: function (colValue, type, row) {
                        let customerName = row.customer?.name;
                        let url = '{{ route('admin.customers.show', ':id') }}';
                        url = url.replace(':id', colValue);
                        if (customerName) {
                            return `<a href="${url}">${customerName}</a>`;
                        }

                        return `<span>Khach le</span>`;
                    }
                },
                {data: 'email'},
                {data: 'subject'},
                {data: 'message'},
                {
                    data: 'is_read',
                    render: function (colValue) {
                        let html = `<span class="badge badge-danger">not answered</span>`;
                        if (colValue === 1) {
                            html = `<span class="badge badge-success">answered</span>`;
                        }
                        return html;
                    }
                },
                {
                    data: 'created_at',
                    render: function (colValue) {
                        const today = new Date(colValue);
                        const yyyy = today.getFullYear();
                        let mm = today.getMonth() + 1; // Months start at 0!
                        let dd = today.getDate();
                        if (dd < 10) {
                            dd = '0' + dd
                        }
                        if (mm < 10) {
                            mm = '0' + mm
                        }
                        return dd + '/' + mm + '/' + yyyy
                    }
                },
                {
                    data: 'id', orderable: false,
                    render: function (colValue, type, row) {
                        let deleteUrl = '{{ route('admin.contacts.delete', ':id') }}';
                        deleteUrl = deleteUrl.replace(':id', colValue);
                        let html = '';
                        if (row.is_read === 0) {
                            html += `<a type="button" class="btn btn-sm btn-primary mr-1" id="reply-contact" data-contact_id="${row.id}" data-toggle="modal" data-target="#ContactModal">
                                        Reply
                                </a>`;
                        }
                        return html += `<a class="btn btn-danger btn-sm" onclick="return confirm('Bạn muốn xóa nội dung này?')"
                                           href="${deleteUrl}">Xóa
                                        </a>`;
                    }
                },
            ],
        });

        $(document).on('click', '#is_read, #btn-search', function () {
            table.draw();
        })

        $(document).on('click', '#reply-contact', function () {
            let contact_id = $(this).data('contact_id');
            let contact_email = $(this).closest('tr').find('td:eq(2)').text();
            let subject = $(this).closest('tr').find('td:eq(3)').text();
            let message = $(this).closest('tr').find('td:eq(4)').text();
            $('#ContactModal #content-contact').text(subject + ': ' + message);
            $('#ContactModal #contact-id').val(contact_id);
            $('#ContactModal #contact-subject').val(subject);
            $('#ContactModal #contact-message').val(message);
            $('#ContactModal #contact-mail').val(contact_email);
        });

        $(document).on('click', '#send-mail', function () {
            let contact_id = $('#ContactModal #contact-id').val();
            let contact_email = $('#ContactModal #contact-mail').val();
            let title_subject = $('#ContactModal #contact-subject').val();
            let content_mail = $('#ContactModal #contact-message').val();
            let url = '{{ route('admin.contacts.reply', ':id') }}';
            url = url.replace(':id', contact_id);

            $.ajax({
                url: url,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    contact_email: contact_email,
                    title_mail: $('#title_mail').val(),
                    content_mail: $('#content_mail').val(),
                },
                success: function (res) {
                    if (res.code === 200) {
                        $('#ContactModal').modal('hide');
                        alert(res.message);
                        table.draw();
                    }
                },
                error: function (err) {
                    if (err.status === 422) {
                        let errors = err.responseJSON.errors;
                        let message = '';
                        if (errors.title_mail) {
                            message += errors.title_mail.join(', ') + '\n';
                        }
                        if (errors.content_mail) {
                            message += errors.content_mail.join(', ');
                        }
                        alert(message);
                    } else {
                        alert('Đã xảy ra lỗi, vui lòng thử lại.');
                    }
                }
            })
        })

        $('#ContactModal').on('hidden.bs.modal', function () {
            $('#title_mail').val('');
            $('#content_mail').val('');
            $('#ContactModal #content-contact').text('');
            $('#ContactModal #contact-id').val('');
            $('#ContactModal #contact-subject').val('');
            $('#ContactModal #contact-message').val('');
            $('#ContactModal #contact-mail').val('');
        });
    </script>
@endsection
