@extends('admins.layouts.master')
@section('title', 'Sản phẩm')
@section("style")
    <style>

    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sản phẩm</h1>
                    <a class="btn btn-success btn-sm" href="{{ route('admin.products.form') }}">Thêm Sản phẩm</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Sản phẩm</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6 col-md-4">
                    <label>Tên sản phẩm</label>
                    <input type="text" class="form-control" name="product_name" id="product-name">
                </div>
                <div class="form-group col-6 col-md-4">
                    <label>Danh mục</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">Tất cả</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-6 col-md-4">
                    <label>Từ ngày</label>
                    <input type="date" class="form-control" name="start_date" id="start-date">
                </div>
                <div class="form-group col-6 col-md-4">
                    <label>Đến ngày</label>
                    <input type="date" class="form-control" name="end_date" id="end-date">
                </div>
                <div class="form-group col-6 col-md-4">
                    <label>Trạng thái</label>
                    <select class="form-control" name="status" id="product-status">
                        <option value="">Tất cả</option>
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>

                <div class="form-group d-flex col-6 col-md-2 align-items-end">
                    <button type="button" id="btn-search" class="btn btn-success swalDefaultSuccess mt-2 mr-2">Search</button>
                    <button type="button" id="btn-reset" class="btn btn-success swalDefaultSuccess mt-2">Reset</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="table" style="width: 100%; overflow: hidden; overflow-x: auto" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th style="max-width: 120px;">Mô tả</th>
                                    <th>Ảnh</th>
                                    <th>Giá</th>
                                    <th>Tài khoản</th>
                                    <th>Mật khẩu</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th>Hành động</th>
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
        // $.fn.dataTable.ext.errMode = 'throw';//khong hien thi alert khi co loi voi datatable
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
                url: '{{ route('admin.products.list') }}',
                data: function (d) {
                    d.name = $('#product-name').val();
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                    d.status = $('#product-status option:selected').val();
                    d.category_id = $('#category_id option:selected').val();
                }
            },
            columns: [
                {
                    data: 'id', ordering: true,
                    render: function (colValue, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {data: 'name'},
                {
                    data: 'description',
                    render: function (colValue) {
                        return `<span
                                    style=" display: -webkit-box; -webkit-line-clamp: 5; -webkit-box-orient: vertical;
                                    overflow: hidden; text-align: justify"
                                >
                                    ${colValue}
                                </span>`;
                    }
                },
                {
                    data: 'image',
                    render: function (colValue) {
                        if (colValue.startsWith('/')) {
                            colValue = colValue.substring(1);
                        }
                        let pathImg = '{{ asset(':colValue') }}';
                        pathImg = pathImg.replace(':colValue', colValue);

                        return `<img src="${pathImg}" alt="" style="width:130px; height: 130px">`;
                    }
                },
                {
                    data: 'price',
                    render: function (colValue) {
                        return parseFloat(colValue).toLocaleString('vi-VN');
                    }
                },
                {data: 'account'},
                {data: 'password'},
                {
                    data: 'active',
                    render: function (colValue) {
                        return colValue === 1 ? 'Chưa bán' : 'Đã bán';
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
                        let deleteUrl = '{{ route('admin.products.delete', ':id') }}';
                        deleteUrl = deleteUrl.replace(':id', colValue);

                        let editUrl = '{{ route('admin.products.edit', ':id') }}';
                        editUrl = editUrl.replace(':id', colValue);

                        return `<a class="btn btn-warning btn-sm" href="${editUrl}">Sửa</a>
                                            <a class="btn btn-danger btn-sm" onclick="return confirm('Bạn muốn xóa nội dung này?')"
                                                   href="${deleteUrl}">Xóa
                                            </a>`;
                    }
                },
            ],
        });

        $('#btn-search').on('click', function () {
            table.draw();
        });

        $('#btn-reset').on('click', function () {
            $('#product-name').val('');
            $('#start_date').val('');
            $('#end_date').val('');
            $('#product-status').val('');
            $('#category_id').val('');
            table.draw();
        });
    </script>
@endsection
