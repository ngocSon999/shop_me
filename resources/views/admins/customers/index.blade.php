@extends('admins.layouts.master')
@section('title', 'Customer')
@section("style")
    <style>
        table tbody a {
            color: black;
        }
        table tbody a:hover {
            color: deepskyblue;
        }
        table tbody a i {
            font-size: 37px;
            color: deepskyblue;
        }
        a.action {
            width: 32px;
            height: 32px;
            background-color: deepskyblue;
            color: #ffffff !important;
            font-size: 14px;
            padding: 1px;
            border: 1px solid deepskyblue;
            border-radius: 50%;
            line-height: 28px;
            display: block;
            text-align: center;
        }
        table tbody a i:hover {
            opacity: 0.6;
        }
        a.action:hover {
            opacity: 0.6;
        }
        .btn-lock {
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Customer</li>
                    </ol>
                </div>
            </div>
            <form class="row" action="" method="POST">
                <div class="form-group col-6 col-md-4">
                    <label>Nội dung</label>
                    <input type="text" class="form-control" name="code" id="search-code">
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Xu</th>
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
                url: '{{ route('admin.customers.list') }}',
                data: function (d) {
                    d.code = $('#search-code').val();
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
                    data: 'name',
                    render: function (colValue, type, row, meta) {
                        let url = '{{ route('admin.customers.show', ':id') }}';
                        url = url.replace(':id', row.id);

                        return `<a href="${url}" title="Chi tiết">${colValue}</a>`;
                    }
                },
                {data: 'email'},
                {data: 'phone'},
                {
                    data: 'coin',
                    render: function (colValue) {
                        return parseFloat(colValue).toLocaleString('vi-VN');
                    }
                },
                {
                    data: 'created_at',
                    render: function (colValue) {
                        return new Date(colValue).toLocaleDateString('vi-VN');
                    }
                },
                {
                    data: 'id', orderable: false,
                    render: function (colValue, type, row) {
                        let urlAddCoin = '{{ route('admin.customers.edit_coin', ':id') }}';
                        urlAddCoin = urlAddCoin.replace(':id', colValue);

                        let urlShow = '{{ route('admin.customers.show', ':id') }}';
                        urlShow = urlShow.replace(':id', colValue);

                        let htm = `<div class="d-flex align-items-center justify-content-center w-100">
                                    <a class="action mr-1" href="${urlAddCoin}" title="Nạp xu">+ Xu</a>
                                    <a title="Chi tiết" href="${urlShow}">
                                        <i class="font-32 fas fa-info-circle"></i>
                                    </a>`;
                        if (row.status === 0) {
                            htm += `<a class="ml-1" title="Unlock">
                                        <i class="btn-lock font-32 fas fa-lock color-red"
                                            data-id="${colValue}" data-status="${row.status}"></i>
                                    </a>`;
                        }
                        if (row.status === 1) {
                        htm += `<a class="ml-1" title="Lock">
                                    <i class="btn-lock font-32 fas fa-unlock"
                                        data-id="${colValue}" data-status="${row.status}"></i>
                                </a>`;
                        }
                        htm += `</div>`;
                        return htm;
                    }
                },
            ],
        });

        $('#btn-search').on('click', function () {
            table.draw();
        })

        $(document).on('click', '.btn-lock', function () {
            let id = $(this).data('id');
            let status = $(this).data('status');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#fd7e14',
                confirmButtonText: 'OK',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url : '{{ route('admin.customers.change_status') }}',
                        type : 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data : {
                            status : status,
                            id : id
                        },
                        success : function (data)
                        {
                            if(data.code === 200){
                                Swal.fire({
                                    title: data.title ?? 'Success!',
                                    text: data.msg,
                                    willClose: () => {
                                        window.location.reload();
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: data.title ?? 'Error!',
                                    text: data.msg,
                                    willClose: () => {
                                        window.location.reload();
                                    }
                                });
                            }
                        }
                    });
                }
            });
        })
    </script>
@endsection
