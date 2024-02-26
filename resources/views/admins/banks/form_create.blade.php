@extends('admins.layouts.master')
@section('style')
    <style>
        .bank-status {
            min-width: 120px;
            outline: none;
            border: 1px solid #b3d3f4;
            border-radius: 4px;
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if(!empty($bank))
                        <h1>Cập thẻ ngân hàng</h1>
                    @else
                        <h1>Thêm thẻ ngân hàng</h1>
                    @endif
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.banks.index') }}">Bank</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
        @if ($errors)
            @foreach ($errors as $error)
                <p class="form-message">{{ $error }}</p>
            @endforeach
        @endif
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if(!empty($bank))
                    <form class="mt-4 col-12" action="{{ route('admin.banks.update', ['id' => $bank->id]) }}"
                          method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @else
                            <form class="mt-4 col-12" action="{{ route('admin.banks.store') }}" method="POST">
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="form-group mb-3 col-12">
                                        <label>Tên chủ tài khoản<span class="color-red">*</span></label>
                                        <input type="text" maxlength="150" class="form-control" name="bank_account"
                                               value="{{ old('bank_account') ?? $bank?->bank_account }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-12">
                                        <label>Tên ngân hàng<span class="color-red">*</span></label>
                                        <input type="text" maxlength="255" class="form-control" name="bank_name"
                                               value="{{ old('bank_name') ?? $bank?->bank_name }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-12">
                                        <label>Số tài khoản/Số thẻ<span class="color-red">*</span></label>
                                        <input type="text" maxlength="20" class="form-control" name="bank_number"
                                               value="{{ old('bank_number') ?? $bank?->bank_number }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-12">
                                        <label>Chi nhánh ngân hàng<span class="color-red"></span></label>
                                        <input type="text" maxlength="255" class="form-control" name="bank_address"
                                               value="{{ old('bank_address') ?? $bank?->bank_address }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-12">
                                        <label>Trạng thái hoạt động thẻ<span class="color-red">*</span></label>
                                        <select name="status" id="" class="bank-status">
                                            <option value="">Chọn trạng thái</option>
                                            <option value="0" @if(isset($bank) && $bank->status == 0)selected @endif>Không hoạt động</option>
                                            <option value="1" @if(isset($bank) && $bank->status == 1)selected @endif>Hoạt động</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" id="submit-add" class="btn btn-success mt-2">Save</button>
                            </form>
                    @endsection
            </div>
        </div>
    </section>
@section('js')
@endsection
