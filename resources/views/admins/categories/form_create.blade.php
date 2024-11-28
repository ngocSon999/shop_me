@extends('admins.layouts.master')
@section('style')
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if(!empty($category))
                        <h1>Cập nhật danh mục</h1>
                    @else
                        <h1>Thêm danh mục</h1>
                    @endif
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.categories.index') }}">Danh mục</a></li>
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
                @if(!empty($category))
                    <form class="mt-4" action="{{ route('admin.categories.update', ['id' => $category->id]) }}"
                          method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @else
                            <form class="mt-4" action="{{ route('admin.categories.store') }}" method="POST"
                            enctype="multipart/form-data">
                                @endif
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Tên danh mục<span
                                            class="color-red">*</span></label>
                                    <input type="text" maxlength="100" class="form-control" name="name"
                                           value="{{ old('name') ?? $category?->name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Hình ảnh<span
                                            class="color-red">{{ !empty($category) ? '' : '*' }}</span></label>
                                    <input type="file" maxlength="100" class="form-control" name="image">
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Xác nhận</button>
                            </form>
                    @endsection
            </div>
        </div>
    </section>


