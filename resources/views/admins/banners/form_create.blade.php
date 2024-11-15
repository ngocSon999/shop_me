@extends('admins.layouts.master')
@section('style')
    <style>
        .banner-position {
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
                    <form class="mt-4 col-12" action="{{ route('admin.banners.update', $banner->id) }}"
                          method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @else
                            <form class="mt-4 col-12" action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="form-group mb-3 col-12">
                                        <label>Tên Banner<span class="color-red">*</span></label>
                                        <input type="text" maxlength="100" class="form-control" name="name"
                                               value="{{ old('name') ?? $banner?->name }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-12">
                                        <label>Mô tả<span class="color-red"></span></label>
                                        <textarea class="form-control" name="description" id="" cols="10" rows="3">
                                        {{ old('description') ?? $banner?->description }}
                                    </textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-12">
                                        <label>Link<span class="color-red"></span></label>
                                        <textarea class="form-control" name="link" id="" cols="10" rows="3">
                                        {{ old('link') ?? $banner?->link }}
                                    </textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-12">
                                        <label>Trạng thái hiển thị<span class="color-red"></span></label>
                                        <select name="active" class="banner-position">
                                            <option value="1" @if($banner?->active == 1) selected @endif>Hiển thị</option>
                                            <option value="0" @if($banner?->active == 0) selected @endif>Không hiển thị</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-12">
                                        <label>Vị trí hiển thị<span class="color-red"></span></label>
                                        <select name="position" class="banner-position">
                                            <option value="0" @if($banner?->position == 0) selected @endif>Trên</option>
                                            <option value="1" @if($banner?->position == 1) selected @endif>Dưới</option>
                                            <option value="2" @if($banner?->position == 2) selected @endif>Trái</option>
                                            <option value="3" @if($banner?->position == 3) selected @endif>Phải</option>
                                        </select>
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
