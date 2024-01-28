@extends('admins.layouts.master')
@section('style')
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if(!empty($banner))
                        <h1>Cập Banner</h1>
                    @else
                        <h1>Thêm Banner</h1>
                    @endif
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.banners.index') }}">Banner</a></li>
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
                @if(!empty($banner))
                    <form class="mt-4 col-12" action="{{ route('admin.banners.update', ['id' => $banner->id]) }}"
                          method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @else
                            <form class="mt-4 col-12" action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="form-group mb-3 col-md-6 col-12">
                                        <label>Tên Banner<span class="color-red">*</span></label>
                                        <input type="text" maxlength="100" class="form-control" name="name"
                                               value="{{ old('name') ?? !empty($banner->name) ? $banner->name : '' }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-12">
                                        <label>Mô tả<span class="color-red">*</span></label>
                                        <textarea class="form-control" name="description" id="" cols="10" rows="3">
                                        {{ old('description') ?? !empty($banner->description) ? $banner->description : '' }}
                                    </textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-md-3 col-12">
                                        <label>Hình ảnh<span class="color-red">*</span></label>
                                        <input type="file" maxlength="100" class="form-control" id="image" name="image">
                                        <span id="status-image" style="color: red"></span>
                                    </div>
                                    <div class="form-group mb-3 col-md-6 col-12">
                                        @if(!empty($banner))
                                            <img id="imgPreview" src="{{ asset($banner->image) }}" alt="">
                                        @else
                                            <img style="display: none" id="imgPreview" src="" alt="">
                                        @endif
                                    </div>
                                </div>

                                @if(!empty($banner))
                                    <button type="submit" id="submit-edit" class="btn btn-success mt-2">Save</button>
                                @else
                                    <button type="submit" id="submit-add" class="btn btn-success mt-2">Save</button>
                                @endif
                            </form>
                    @endsection
            </div>
        </div>
    </section>

@section('js')
    <script src="{{ asset('assets/cms/js/preview_upload_image.js') }}"></script>
@endsection
