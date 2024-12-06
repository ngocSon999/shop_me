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
                        @foreach(config('define.STATUS_CARD') as $key => $label)
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
                                    <th>Khách hàng</th>
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
                    data: 'id', ordering: true,
                    render: function (colValue, type, row) {
                        if (row.customer) {
                            let url = '{{ route('admin.customers.show', ':id') }}';
                            url = url.replace(':id', row.customer.id);

                            return `<a href="${url}">${row.customer.name}</a>`;
                        }
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
                {
                    data: 'serial',
                    render: function (colValue, type, row) {
                        if (row.status === 1 || row.status === 2) {
                            return colValue;
                        }
                        return `<span class="text-content">${colValue}</span>
                                    <span class="ms-2 btn bnt-copy" title="Sao chép">
                                        <i class="fas fa-copy"></i>
                                    </span>`;
                    }
                },
                {
                    data: 'number',
                    render: function (colValue, type, row) {
                        if (row.status === 1 || row.status === 2) {
                            return colValue;
                        }
                        return `<span class="text-content">${colValue}</span>
                                    <span class="ms-2 btn bnt-copy" title="Sao chép">
                                        <i class="fas fa-copy"></i>
                                    </span>`;
                    }
                },
                {
                    data: 'status',
                    render: function (colValue, type, row) {
                        let html = '';
                        if (colValue === 1) {
                            html = `<div class="d-flex align-items-center">
                                        <span class="mr-2" style="color: #007bff">Thành công</span>
                                    </div>`;
                        } else if (colValue === 2) {
                            html = `<div class="d-flex align-items-center">
                                        <span class="mr-2 text-danger">Thẻ không hợp lệ</span>
                                    </div>`;
                        } else {
                            html = `
                                <select id="" data-id="${row.id}" class="btn-update-status form-control">
                                    <option value="0" ${colValue === 0 ? 'selected' : ''}>pending</option>
                                    <option value="1">success</option>
                                    <option value="2">deciline</option>
                                </select>`;
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
        // update status card
        $(document).on('change', '.btn-update-status', function () {
            let id = $(this).data('id');
            let status = $(this).find('option:selected').val();
            let url = '{{ route('admin.cards.update', ':id') }}';
            url = url.replace(':id', id);

            if (confirm('Xác nhận trạng thái thẻ cào?')) {
                $.ajax({
                    url: url,
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        status: status
                    },
                    success: function (res) {
                        if (res.code === 200) {
                            alert(res.message);
                            table.draw();
                        }
                    },
                    error: function (err) {

                    },
                })
            }

        });

        //copy serial and number from card
        $(document).on('click', '.bnt-copy', function() {
            $(this).attr('title', 'Sao chép');
            let copyText = $(this).closest('td').find('.text-content').text();
            const copyContent = async () => {
                try {
                    if (window.isSecureContext && navigator.clipboard) {
                        await navigator.clipboard.writeText(copyText);
                        $(this).attr('title', 'Đã sao chép');
                    } else {
                        unsecuredCopyToClipboard(copyText);
                        $(this).attr('title', 'Đã sao chép');
                    }
                } catch (err) {
                    console.error('Failed to copy: ', err);
                }
            }
            copyContent();
        });

        const unsecuredCopyToClipboard = (text) => {
            const textArea = document.createElement("textarea");
            textArea.value=text;
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try{
                document.execCommand('copy');
            } catch (err) {
                console.error('Unable to copy to clipboard', err)
            }
            document.body.removeChild(textArea);
        };
    </script>
@endsection
