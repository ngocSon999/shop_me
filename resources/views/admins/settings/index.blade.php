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
                    <h1>Setting: @if(!empty($slug)) {{ $slug }} @endif</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Setting</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="table" style="width: 100%" class="table table-bordered table-hover col-12 col-lg-8">
                                <thead>
                                <tr>
                                    <th>Key</th>
                                    <th>Value</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($settings as $setting)
                                    @if(isset($slug) && $slug !== 'logo')
                                        <tr>
                                            <td>{{ str_replace('_', ' ', $setting->key) }}</td>
                                            <td>
                                                <form action="{{ route('admin.setting.update', $setting->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <label>
                                                        <input class="form-control" name="value" type="text" value="{{ $setting->value }}">
                                                    </label>
                                                    <label>
                                                        <input class="form-control" name="status" type="text" value="{{ $setting->status }}">
                                                    </label>
                                                    <button class="btn btn-sm btn-primary ml-4" type="submit">Update</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{ str_replace('_', ' ', $setting->key) }}</td>
                                            <td>
                                                <img src="{{ asset($setting->value) }}" alt="" width="150px" height="150px">
                                                <form action="{{ route('admin.setting.update-logo', $setting->id) }}"
                                                        method="POST" enctype="multipart/form-data"
                                                >
                                                    @csrf
                                                    <label>
                                                        <input class="form-control" name="{{ $setting->key }}" type="file">
                                                    </label>
                                                    <button class="btn btn-sm btn-primary ml-4" type="submit">Update</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>

                            @if(isset($slug) && $slug !== 'logo')
                                <div class="d-flex justify-content-center mt-2">
                                    <form action="{{ route('admin.setting.update_all') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        @foreach($settings as $setting)
                                            <label>
                                                <input hidden="hidden" class="form-control" name="id[]" type="text" value="{{ $setting->id }}">
                                            </label>
                                            <label>
                                                <input hidden="hidden" class="form-control" name="key[]" type="text" value="{{ $setting->value }}">
                                            </label>
                                            <label>
                                                <input hidden="hidden" class="form-control" name="value[]" type="text" value="{{ $setting->value }}">
                                            </label>
                                            <label>
                                                <input hidden="hidden" class="form-control" name="status[]" type="text" value="{{ $setting->status }}">
                                            </label>
                                        @endforeach
                                        <button class="btn btn-sm btn-primary">Update all</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
