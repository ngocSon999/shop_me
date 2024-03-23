@extends('admins.layouts.master')
@section('title', 'Card')
@section("style")
    <style>

    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Card</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Card</li>
                    </ol>
                </div>
            </div>
            <form class="row" action="" method="POST">
                <div class="form-group col-6 col-md-3">
                    <label>Loại thẻ</label>
                    <select class="form-control" name="type" id="card-type">
                        <option value="">Tất cả</option>
                        @foreach(config('define.TYPE_CARD') as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-6 col-md-3">
                    <label>Trạng thái</label>
                    <select class="form-control" name="status" id="card-status">
                        <option value="">Tất cả</option>
                        <option value="1">Đã sử dụng</option>
                        <option value="0">Chưa sử dụng</option>
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
                                    <th>Loại thẻ</th>
                                    <th>Mệnh giá</th>
                                    <th>Số seri</th>
                                    <th>Số thẻ</th>
                                    <th>Trạng thái</th>
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
                url: '{{ route('admin.cards.list') }}',
                data: function (d) {
                    d.type = $('#card-type').find('option:selected').val();
                    d.status = $('#card-status').find('option:selected').val();
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
                    data: 'type',
                    render: function (colValue) {
                        let options = {!! json_encode(config('define.TYPE_CARD')) !!};

                        return options[String(colValue)];
                    }

                },
                {
                    data: 'card_price',
                    render: function (colValue) {
                        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND', maximumFractionDigits: 2}).format(colValue);
                    }
                },
                {data: 'serial'},
                {data: 'number'},
                {
                    data: 'status',
                    render: function (colValue, type, row) {
                        let html = '';
                        if (colValue == 0) {
                            html = `<div class="d-flex align-items-center">
                                        <span class="mr-2">Chưa sử dụng</span>
                                        <input type="checkbox" value="${colValue}" data-id="${row.id}" class="btn-update-status">
                                    </div>`;
                        } else {
                            html = `<div class="d-flex align-items-center">
                                        <span class="mr-2">Đã sử dụng</span>
                                        <input disabled checked type="checkbox" value="${colValue}">
                                    </div>`;
                        }

                        return html;
                    }

                },
                {
                    data: 'id', orderable: false,
                    render: function (colValue) {
                        let deleteUrl = '{{ route('admin.cards.delete', ':id') }}';
                        deleteUrl = deleteUrl.replace(':id', colValue);

                        return `<a class="btn btn-warning btn-sm" href="${deleteUrl}">Xóa</a>`;
                    }
                },
            ],
        });

        $('#btn-search').on('click', function () {
            table.draw();
        });

        $(document).on('click', '.btn-update-status', function () {
            let id = $(this).data('id');
            let url = '{{ route('admin.cards.update', ':id') }}';
            url = url.replace(':id', id);

            if (confirm('Xác nhận thẻ đã sử dụng?')) {
                $.ajax({
                    url: url,
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {status:1},
                    success: function (res) {
                        if (res.code === 200) {
                            alert(res.message);
                        }
                    },
                    error: function (err) {

                    },
                })
            }

        });
    </script>
@endsection
