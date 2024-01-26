@extends('admins.layouts.master')
@section('title', 'Nhân viên')
@section("style")
    <style>
    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>Quản lý tài khoản</h3>
                    <a class="btn btn-success btn-sm" href="{{ route('admin.users.form') }}">Thêm tài khoản</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Tài khoản</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-4">
                    <label>Từ ngày</label>
                    <input type="date" class="form-control" name="start_date" id="start-date">
                </div>
                <div class="col-6 col-md-4">
                    <label>Đến ngày</label>
                    <input type="date" class="form-control" name="end_date" id="end-date">
                </div>
                <div class="col-6 col-md-4">
                    <label>User name</label>
                    <input type="text" class="form-control" name="user_name" id="user_name">
                </div>
                <div class="col-6 col-md-4">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" id="email">
                </div>
                <div class="col-6 col-md-4">
                    <label>Vai trò</label>
                    <select class="form-control" name="role_id" id="role_id">
                        <option value="">Tất cả</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex col-6 col-md-4 align-items-end">
                    <button type="button" id="btn-search" class="btn btn-success swalDefaultSuccess mt-2 mr-2">Search</button>
                    <button type="button" id="btn-reset" class="btn btn-success swalDefaultSuccess mt-2 mr-2">Reset</button>
                </div>
            </div>
        </div>
    </section>


    <section class="content mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="table" class="table">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Quyền</th>
                                    <th>Ngày tạo</th>
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
        let tableUser = $('#table').DataTable({
            processing: true,
            serverSide: true,
            lengthMenu: [10, 25, 50],
            "oLanguage": {
                "sLengthMenu": "Hiển thị _MENU_ dữ liệu trên trang",
                "sZeroRecords": "Không có dữ liệu",
                "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ dữ liệu ",
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
                url: '{{ route('admin.users.list') }}',
                data: function (d) {
                    d.user_name = $('#user_name').val();
                    d.email = $('#email').val();
                    d.role_id = $('#role_id').find(':selected').val();
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
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
                    data: 'first_name',
                    render: function (colValue, type, row) {
                        return colValue;
                    }
                },
                {data: 'email'},
                {data: 'phone'},
                {
                    data: 'roles',
                    orderable: false,
                    render: function (colValue, type, row) {
                        let resultHTML = '<ul>';
                        if (row?.roles?.length > 0) {
                            row.roles.map(function (role) {
                                resultHTML += `<li>${role.name}</li>`
                            })
                        }
                        resultHTML += '</ul>';

                        return resultHTML;
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
                        let deleteUrl = '{{ route('admin.users.delete', ':id') }}';
                        deleteUrl = deleteUrl.replace(':id', colValue);

                        let editUrl = '{{ route('admin.users.edit', ':id') }}';
                        editUrl = editUrl.replace(':id', colValue);
                        let resultHtml = '<div class="actions">';
                        if (row?.roles?.length > 0) {
                            row.roles.map(function (role) {
                                if (role.slug !== 'super-admin') {
                                    resultHtml += `<a class="btn btn-warning btn-sm" href="${editUrl}">Sửa</a>
                                                    <a class="btn btn-danger btn-sm" onclick="return confirm('Bạn muốn xóa tài khoản này?')"
                                                           href="${deleteUrl}">Xóa
                                                    </a>`
                                }
                            })
                        }
                        resultHtml += '</div>';

                        return resultHtml;
                    }
                },

            ],
        });

        $('#btn-search').on('click', function () {
            tableUser.draw();
        });
        $('#btn-reset').on('click', function () {
            $('#user_name').val('');
            $('#email').val('');
            $('#start_date').val('');
            $('#end_date').val('');
            $('#role_id').val('');
            tableUser.draw();
        })
    </script>
@endsection
