@extends('admins.layouts.master')
@section('title', 'Feedback')
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
                        <li class="breadcrumb-item active">Feedback</li>
                    </ol>
                </div>
            </div>
            <form class="row" action="" method="POST">
                <div class="form-group col-6 col-md-2">
                    <label>Trạng thái</label>
                    <select class="form-control" name="status" id="banner-status">
                        <option value="">Tất cả</option>
                        @foreach(__('banners/title.STATUS') as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
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
                                    <th>Content</th>
                                    <th>Rating</th>
                                    <th>Status</th>
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
    </section>
@endsection
@section('js')
    <script>
        $.fn.dataTable.ext.errMode = 'throw';
        let table = $('#table').DataTable({
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
                url: '{{ route('admin.feedback.list') }}',
                data: function (d) {
                    d.status = $('#banner-status').find('option:selected').val();
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
                        return `<a href="${url}">${customerName}</a>`;
                    }
                },
                {data: 'message'},
                {data: 'rating'},
                {
                    data: 'status',
                    render: function (colValue, type, row) {
                        return `
                            <select id="status" data-id="${row.id}" class="form-control status-dropdown">
                                <option value="0" ${colValue === 0 ? 'selected' : ''}>Ẩn</option>
                                <option value="1" ${colValue === 1 ? 'selected' : ''}>Hiển thị</option>
                            </select>
                        `;
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
                        let deleteUrl = '{{ route('admin.feedback.delete', ':id') }}';
                        deleteUrl = deleteUrl.replace(':id', colValue);

                        return `<a class="btn btn-danger btn-sm" onclick="return confirm('Bạn muốn xóa nội dung này?')"
                                                           href="${deleteUrl}">Xóa
                                                    </a>`;
                    }
                },
            ],
        });

        $('#btn-search').on('click', function () {
            table.draw();
        })

        $(document).on('change', '#status', function () {
            let status = $(this).val();
            let id = $(this).data('id');
            let url = '{{ route('admin.feedback.update', ':id') }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: 'POST',
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    status: status
                },
                success: function (res) {
                    if (res.code === 200) {
                        alert(res.message);
                    }
                },
                error: function (err) {
                    console.log(err);
                }
            })
        })
    </script>
@endsection
