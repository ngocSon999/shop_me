@extends('admins.layouts.master')
@section('style')
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if(!empty($banner))
                        <h1>Cập nhật vai trò</h1>
                    @else
                        <h1>Thêm mới vai trò</h1>
                    @endif
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.roles.index') }}">Role</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if(!empty($role))
                    <form class="mt-4 col-12" action="{{ route('admin.roles.update', ['id' => $role->id]) }}"
                          method="POST">
                        @method('PUT')
                        @else
                            <form class="mt-4 col-12" action="{{ route('admin.roles.store') }}" method="POST">
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="form-group mb-3 col-md-6 col-12">
                                        <label>Tên Vài trò<span class="color-red">*</span></label>
                                        @if(!empty($role))
                                            <input type="text" maxlength="100" class="form-control" name="name"
                                            value="{{ old('name') ?? $role->name }}">
                                        @else
                                            <input type="text" maxlength="100" class="form-control" name="name"
                                                   value="{{ old('name') }}">
                                        @endif
{{--                                        @error('name')--}}
{{--                                        <div class="parsley-required color-red">{{ $message }}</div>--}}
{{--                                        @enderror--}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-body">
                                                <div class="example-box-wrapper">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center d-flex">
                                                                     Chức năng
                                                                    <label for="" class="d-block text-left ml-4">
                                                                        <input type="checkbox" class="checkbox_wrapper">
                                                                        Tất cả
                                                                    </label>
                                                                </th>
                                                                <th class="text-center">Chọn quyền</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($permissions as $rp => $items)
                                                            @if (is_array($items))
                                                                <tr>
                                                                    <th class="text-left font-weight-bold d-flex">
                                                                        <label class="control-label w-50">{{ $rp }}</label>
                                                                        <label for="" class="d-block w-50 text-right pr-4">
                                                                            <input type="checkbox" class="check_all">
                                                                            Tất cả
                                                                        </label>
                                                                    </th>
                                                                    <td>
                                                                        @foreach ($items as $srp => $label)
                                                                            <label style="margin-left: 10px;margin-bottom: 5px">
                                                                                <input type="checkbox" class="checkbox_children"
                                                                                       name="permission[]"
                                                                                       @if(isset($role) && $role->hasAccess($srp)) checked="checked"
                                                                                       @endif
                                                                                       value="{{ $srp }}">
                                                                                {{__($label)}}
                                                                            </label>
                                                                        @endforeach
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
{{--                                @error('permission')--}}
{{--                                <div class="parsley-required color-red">{{ $message }}</div>--}}
{{--                                @enderror--}}

                                @if(!empty($role))
                                    <button type="submit" id="submit-edit" class="btn btn-success mt-2">Update</button>
                                @else
                                    <button type="submit" id="submit-add" class="btn btn-success mt-2">Save</button>
                                @endif
                            </form>
                    @endsection
            </div>
        </div>
    </section>

@section('js')
    <script>
        $(document).ready(function () {
            let table = $('table');
            let checkboxChildren = table.find('.checkbox_children');

            $('.checkbox_wrapper').on('click', function (){
                $(this).closest('table').find('.checkbox_children').prop('checked',$(this).prop('checked'))
                $(this).closest('table').find('.check_all').prop('checked',$(this).prop('checked'))
            });

            $('.check_all').on('click', function (){
                $(this).closest('tr').find('.checkbox_children').prop('checked',$(this).prop('checked'));

                table.find('.checkbox_wrapper').prop('checked', filterCheckbox());
            });

            $('.checkbox_children').on('click', function (){
                let allCheckBoxes = $(this).closest('tr').find('.checkbox_children');
                let allCheck = allCheckBoxes.filter(':checked').length === allCheckBoxes.length;
                $(this).closest('tr').find('.check_all').prop('checked', allCheck);

                table.find('.checkbox_wrapper').prop('checked', filterCheckbox());
            });

            function filterCheckbox()
            {
                return checkboxChildren.filter(':checked').length === checkboxChildren.length;
            }
        })

        $(document).ready(function () {
            let checkAlls = $('.check_all');
            checkAlls.each(function() {
                let checkAll = $(this);
                let checkChildren = checkAll.closest('tr').find('.checkbox_children');

                checkAll.prop('checked', checkChildren.length > 0 && checkChildren.filter(':checked').length === checkChildren.length);
            });

            $('.checkbox_wrapper').prop('checked', checkAlls.filter(':checked').length > 0 && checkAlls.filter(':checked').length === checkAlls.length)
        })
    </script>
@endsection
