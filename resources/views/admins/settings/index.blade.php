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
                            <table id="table" style="width: 100%" class="table table-bordered table-hover col-8">
                                <thead>
                                <tr>
                                    <th>Key</th>
                                    <th>Value</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($settings as $setting)
                                    <tr>
                                        <td>{{ $setting->key }}</td>
                                        <td>
                                            <form action="{{ route('admin.setting.update', $setting->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <label>
                                                    <input class="form-control" name="value" type="text" value="{{ $setting->value }}">
                                                </label>
                                                    <button class="btn btn-sm btn-primary ml-4" type="submit">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
