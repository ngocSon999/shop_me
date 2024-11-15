@extends('admins.layouts.master')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nạp xu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.customers.index') }}">Customer</a></li>
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
                <form class="mt-4 col-12" action="{{ route('admin.customers.add_coin', ['id' => $customer->id]) }}"method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="form-group mb-3 col-md-6 col-12">
                            <label>Tên khách hàng<span class="color-red"></span></label>
                            <input type="text" maxlength="100" class="form-control" name="name"
                                   disabled value="{{ $customer->name }}">
                        </div>
                        <div class="form-group mb-3 col-md-6 col-12">
                            <label>Mã khách hàng<span class="color-red"></span></label>
                            <input type="text" maxlength="100" class="form-control" name="name"
                                   disabled value="{{ $customer->code }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group mb-3 col-md-6 col-12">
                            <label>Số xu hiện có<span class="color-red"></span></label>
                            <input type="number" class="form-control" name="coin"
                                   disabled value="{{ $customer->coin }}">
                        </div>
                        <div class="form-group mb-3 col-md-6 col-12">
                            <label>Trạng thái</label>
                            <input type="text" min="0" class="form-control" name="add_coin"
                                   style="color: {{ $customer->status ===1 ? 'green' : 'red' }}"
                                   value="{{ $customer->status ===1 ? 'Active' : 'unActive' }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group mb-3 col-md-6 col-12">
                            <label>Số xu nạp</label>
                            <input type="number" min="0" class="form-control" name="add_coin"
                                   value="{{ old('add_coin') }}">
                        </div>

                        <div class="form-group mb-3 col-md-6 col-12">
                            <label>Giảm xu(trường hợp nạp thừa)</label>
                            <input type="number" min="0" class="form-control" name="minus_coin"
                                   value="{{ old('minus_coin') }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Save</button>
                </form>
            @endsection
            </div>
        </div>
    </section>

@section('js')
@endsection
