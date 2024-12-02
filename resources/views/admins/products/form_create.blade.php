@extends('admins.layouts.master')
@section('style')
    <style>
        .ck-editor__editable[role="textbox"] {
            /* Editing area */
            min-height: 200px;
        }
        .ck.ck-powered-by {
            display: none!important;
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if(!empty($product))
                        <h1>Cập nhật sản phẩm</h1>
                    @else
                        <h1>Thêm sản phẩm</h1>
                    @endif
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.products.index') }}">Sản phẩm</a></li>
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
                @if(!empty($product))
                    <form class="mt-4 col-12" action="{{ route('admin.products.update', $product->id) }}"
                          method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @else
                            <form class="mt-4 col-12" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="form-group mb-3 col-md-6 col-12">
                                        <label>Danh mục sản phẩm<span class="color-red">*</span></label>
                                        <select name="category_id" class="form-control">
                                            <option value="">Chọn danh mục</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ (!empty($product) && $product->categories->contains('id', $category->id)) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3 col-md-6 col-12">
                                        <label>Tên sản phẩm<span class="color-red">*</span></label>
                                        <input type="text" maxlength="100" class="form-control" name="name"
                                               value="{{ old('name') ?? $product?->name }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-12">
                                        <label>Mô tả<span class="color-red"></span></label>
                                        <textarea class="form-control" name="description" id="editor">
                                            {{ old('description') ?? $product?->description }}
                                        </textarea>
                                        <div id="references"></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-md-6 col-12">
                                        <label>Tài khoản<span class="color-red">*</span></label>
                                        <input type="text" maxlength="100" class="form-control" name="account"
                                               value="{{ old('account') ?? $product?->account }}">
                                    </div>
                                    <div class="form-group mb-3 col-md-6 col-12">
                                        <label>Mật khẩu<span class="color-red">*</span></label>
                                        <input type="text" maxlength="15" class="form-control" name="password"
                                               value="{{ old('password') ?? $product?->password }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-md-6 col-12">
                                        <label>Giá<span class="color-red">*</span></label>
                                        <input type="number" maxlength="100" class="form-control" name="price"
                                               value="{{ old('price') ?? $product?->price }}">
                                    </div>
                                    <div class="form-group mb-3 col-md-6 col-12">
                                        <label>Giảm giá<span class="color-red"></span></label>
                                        <input type="number" min="0" max="100" class="form-control" name="discount_price"
                                               value="{{ old('discount_price') ?? $product?->discount_price }}">
                                    </div>
                                    <div class="form-group mb-3 col-md-6 col-12">
                                        <div class="form-group mb-3 col-12">
                                            <label>Hình ảnh
                                                @if(empty($product))
                                                    <span class="color-red">*</span>
                                                @endif
                                            </label>
                                            <input type="file" maxlength="100" class="form-control" id="image" name="image">
                                            <span id="status-image" style="color: red"></span>
                                        </div>
                                        <div class="form-group mb-3 col-12">
                                            @if(!empty($product))
                                                <img id="imgPreview" src="{{ asset($product->image) }}" alt="">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if(!empty($product))
                                    <button type="submit" id="submit-edit" class="btn btn-success mt-1">Save</button>
                                @else
                                    <button type="submit" id="submit-add" class="btn btn-success mt-1">Save</button>
                                @endif
                            </form>
                    @endsection
            </div>
        </div>
    </section>

@section('js')
    <script src="{{ asset('assets/cms/js/preview_upload_image.js') }}"></script>
    <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/cms/js/ckeditor_page.js') }}"></script>
@endsection
