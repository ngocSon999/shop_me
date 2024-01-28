@extends('admins.layouts.master')
@section('title', 'Banner')
@section("style")
    <style>

    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh mục</h1>
                    <a class="btn btn-success btn-sm" href="{{ route('admin.banners.form') }}">Thêm Banner</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Banner</li>
                    </ol>
                </div>
            </div>
            <form class="row" action="" method="POST">
                <input type="hidden" name="export_excel" value="true">
                <div class="form-group col-6 col-md-2">
                    <label>Từ ngày</label>
                    <input type="date" class="form-control" name="start_date" id="start-date">
                </div>
                <div class="form-group col-6 col-md-2">
                    <label>Đến ngày</label>
                    <input type="date" class="form-control" name="end_date" id="end-date">
                </div>
                <div class="form-group col-6 col-md-2">
                    <label>Trạng thái</label>
                    <select class="form-control" name="status" id="complaint-status">
                        <option value="">Tất cả</option>
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
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
                                    <th>Name</th>
                                    <th>Mô tả</th>
                                    <th>Hình ảnh</th>
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
                url: '{{ route('admin.banners.list') }}',
            },
            columns: [
                {
                    data: 'id', ordering: true,
                    render: function (colValue, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {data: 'name'},
                {data: 'description'},
                {
                    data: 'image',
                    render: function (colValue) {
                        let imgPath = '{{ asset(':colValue') }}';
                        imgPath = imgPath.replace(':colValue', colValue);

                        return `<img src="${imgPath}" alt="" style="width: 130px; height: 130px">`;
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
                        let deleteUrl = '{{ route('admin.banners.delete', ':id') }}';
                        deleteUrl = deleteUrl.replace(':id', colValue);

                        let editUrl = '{{ route('admin.banners.edit', ':id') }}';
                        editUrl = editUrl.replace(':id', colValue);

                        let resultHtml = `<a class="btn btn-warning btn-sm" href="${editUrl}">Sửa</a>
                                                    <a class="btn btn-danger btn-sm" onclick="return confirm('Bạn muốn xóa nội dung này?')"
                                                           href="${deleteUrl}">Xóa
                                                    </a>`
                        return resultHtml;
                    }
                },
            ],
        });
    </script>
@endsection
