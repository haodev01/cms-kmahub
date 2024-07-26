<?php

use App\Helpers\ConstantsHelper;
use  App\Helpers\AssetsHelper;

?>

@extends('admin.layouts.auth')
@section('content')
    <div class="col-lg-12 d-flex align-items-center justify-content-between ">
        <h5 class="m-0">Danh sách khóa học</h5>
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb m-0 ">
                <li class="breadcrumb-item font-semibold"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Khóa học</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex align-items-center justify-content-between my-3 mt-5">
        <form id="form-search" action="{{route('courses.index')}}" method="GET">
            <input value="{{request()->get('keyword')}}" name="keyword" type="text" id="search" class="form-control"
                   placeholder="Tìm kiếm ...">
        </form>
        <a href="{{route('courses.create')}}" class="btn btn-primary icon icon-left ">
            <i class="fa fa-plus font-bold "></i>
            Tạo mới
        </a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="position-relative flex-end h-alert">
                <div
                    class="alert alert-secondary  flex-between position-absolute w-100 h-alert "
                    id="button-delete-all" style="display: none;">
                    <span class="title-checkbox-selected">13 row selected</span>
                    <div id="button-action-delete-all" data-action="{{route('courses.destroyMany')}}">
                        <i class="fa fa-trash text-danger pointer icon-font"></i>
                    </div>
                </div>
                <form action="{{ url()->full() }}" class="mb-3 flex-end gap-3" id="button-filter" method="GET">
                    <select class="form-select select-filter" name="level" style="min-width: 150px">
                        <option value="">
                            Tất cả mức độ
                        </option>
                        @foreach(ConstantsHelper::LIST_LEVEL as $key => $value)
                            <option
                                value="{{ $value['key'] }}" {{ request('level') == $value['key'] ? 'selected' : '' }}>
                                {{$value['text']}}
                            </option>
                        @endforeach
                    </select>
                    <select class="form-select select-filter" name="created_by_id"
                            style="min-width: 150px">
                        <option value="">Tất cả người tạo</option>
                        @foreach($admins as $admin)
                            <option
                                value="{{$admin->id}}" {{ request('created_by_id') == $admin->id ? 'selected' : '' }}>
                                {{$admin->username}}
                            </option>
                        @endforeach
                    </select>
                    <select class="form-select select-filter " style="min-width: 200px"
                            name="status">
                        <option value="">Tất cả trạng thái</option>
                        @foreach(ConstantsHelper::LIST_STATUS as $key => $value)
                            <option
                                {{ request('status') == $value['key'] ? 'selected' : '' }} value="{{ $value['key'] }}">
                                {{ $value['text'] }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-responsive-md table-bordered table-hover">
                    <thead>
                    <tr>
                        <th style="width:50px;">
                            <div class="custom-control custom-checkbox checkbox-danger check-lg mr-3">
                                <input type="checkbox" class="custom-control-input input-checkbox-all">
                            </div>
                        </th>
                        <th>@sortablelink('id', 'ID')</th>
                        <th>@sortablelink('name', 'Tên danh mục')</th>
                        <th> @sortablelink('description', 'Danh mục')</th>
                        <th> @sortablelink('level', 'Mức độ')</th>
                        <th>@sortablelink('status', 'Trạng thái')</th>
                        <th>@sortablelink('price_original', 'Giá')</th>
                        <th>@sortablelink('created_by_id', 'Người tạo')</th>
                        <th><strong>Hành động</strong></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($courses) === 0)
                        <tr>
                            <td colspan="7" class="text-center">
                                <h3 class="py-5">
                                    Không tìm thấy kết quả
                                </h3>
                            </td>
                        </tr>
                    @endif
                    @foreach($courses as $course)
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox checkbox-danger check-lg mr-3">
                                    <input type="checkbox" value="{{$course->id}}"
                                           class="custom-control-input input-checkbox"
                                    >
                                </div>
                            </td>
                            <td>{{$course->id}}</td>
                            <td style="max-width: 100px">
                                <div class="d-flex align-items-start">
                                    <span class="w-space-no t-ellipsis-1">
                                            {{$course->name}}
                                        </span></div>
                            </td>
                            <td>
                                <span class="t-ellipsis-1">
                                    @if(isset($course->category))
                                        {{$course->category->name}}
                                    @endif
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ConstantsHelper::LEVEL_COLOR[$course->level]}}">
                                    {{ConstantsHelper::LEVEL[$course->level]}}
                                </span>
                            </td>

                            <td>
                                <div class="d-flex align-items-center gap-1 ">
                                    <i class="fa fa-circle {{ConstantsHelper::STATUS_COLOR[$course->status]}}  mr-1"></i>
                                    <span>{{ConstantsHelper::STATUS[$course->status]}}</span>
                                </div>
                            </td>
                            <td>
                                <span>
                                    {{number_format((int)$course->price_original,0, '', '.')}}đ
                                </span>
                            </td>
                            <td>
                                <span>
                                    {{$course->createdBy->username}}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{route('courses.edit', $course->id)}}"
                                       class="btn btn-primary shadow btn-xs sharp "><i
                                            class="fa fa-pencil"></i></a>
                                    <a href="{{route('courses.update-content', $course->id)}}"
                                       class="btn btn-secondary shadow btn-xs sharp "><i
                                            class="fa-regular fa-file"></i></a>
                                    <button type="button" class="btn btn-danger shadow btn-xs sharp single-delete"
                                            data-action="{{route('courses.destroy', $course->id)}}"
                                    >
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            {!! $courses->appends(Request::except('page'))->render('vendor.pagination.bootstrap-5') !!}
            <div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{AssetsHelper::assetAdmin('js/single-table.js')}}"></script>
    <script>

        $(document).ready(function () {
            $('#form-search').submit(function (e) {
                e.preventDefault();
                const keyword = $('#search').val();
                replaceUrl('keyword', keyword)
            })
            $('#select-status').change(function () {
                let status = $(this).val();
                replaceUrl('status', status)
            })
            $('#select-level').change(function () {
                let level = $(this).val();
                replaceUrl('level', level)
            })
            $('#select-creator').change(function () {
                let level = $(this).val();
                replaceUrl('created_by_id', level)
            })
        });
    </script>
@endsection
