<?php

use App\Helpers\AssetsHelper;
use App\Helpers\ConstantsHelper;

?>

@extends('admin.layouts.auth')

@section('content')
    <div class="col-lg-12  ">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="m-0">Danh sách danh mục</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item font-semibold"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Danh mục</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex align-items-center justify-content-between my-3 mt-5">
            <form id="form-search" action="{{route('course-categories.index')}}" method="GET">
                <input value="{{request()->get('keyword')}}" name="keyword" type="text" id="search" class="form-control"
                       placeholder="Tìm kiếm ...">
            </form>
            <a href="{{route('course-categories.create')}}" class="btn btn-primary icon icon-left">
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
                        <div id="button-action-delete-all" data-action="{{route('categories.destroyMany')}}">
                            <i class="fa fa-trash text-danger pointer icon-font"></i>
                        </div>
                    </div>
                    <div class="flex-end gap-2">
                        <select class="form-select select-filter" name="created_by_id" style="min-width: 200px">
                            <option value="">Người tạo</option>
                            @foreach($admins as $admin)
                                <option
                                    value="{{$admin->id}}" {{ request('created_by_id') == $admin->id ? 'selected' : '' }}>
                                    {{$admin->username}}
                                </option>
                            @endforeach
                        </select>
                        <select class="form-select select-filter" name="status" style="min-width: 200px">
                            <option value="">Tất cả trạng thái</option>
                            @foreach(ConstantsHelper::LIST_STATUS as $key => $value)
                                <option
                                    {{ request('status') == $value['key'] ? 'selected' : '' }} value="{{ $value['key'] }}">
                                    {{ $value['text'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-responsive-md table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width:50px;">
                                <div class="custom-control custom-checkbox checkbox-primary check-lg mr-3">
                                    <input type="checkbox" class="custom-control-input input-checkbox-all"
                                           id="checkAll">
                                    <label class="custom-control-label" for="checkAll"></label>
                                </div>
                            </th>
                            <th>
                                @sortablelink('id', 'ID')
                            </th>
                            <th>
                                @sortablelink('name', 'Tên danh mục')
                            </th>
                            <th>
                                @sortablelink('description', 'Mô tả')
                            </th>
                            <th>
                                @sortablelink('created_at', 'Ngày tạo')
                            </th>
                            <th>
                                @sortablelink('status', 'Trạng thái')
                            </th>
                            <th>
                                <strong>Hành động</strong>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($categories) === 0)
                            <tr>
                                <td colspan="7" class="text-center">
                                    <h3 class="py-5">
                                        Không tìm thấy kết quả
                                    </h3>
                                </td>
                            </tr>
                        @endif
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox checkbox-primary check-lg mr-3">
                                        <input name="ids[]" type="checkbox" value="{{$category->id}}"
                                               class="custom-control-input input-checkbox"
                                               id="customCheckBox{{$category->id}}"
                                        >
                                        <label class="custom-control-label"
                                               for="customCheckBox{{$category->id}}"></label>
                                    </div>
                                </td>
                                <td>{{$category->id}}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="w-space-no">
                                            {{$category->name}}
                                        </span></div>
                                </td>
                                <td>
                                    <span>{{$category->description}}</span>
                                </td>
                                <td>
                                    <span>{{date('d-m-y', strtotime($category->created_at))}}</span>
                                </td>
                                <td>
                                    <span class=" gap-1 badge {{ConstantsHelper::STATUS_COLOR_BG[$category->status]}} ">
                                      {{ConstantsHelper::STATUS[$category->status]}}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{route('course-categories.edit', $category->id)}}"
                                           class="btn btn-primary shadow btn-xs sharp "><i
                                                class="fa fa-pencil"></i></a>
                                        <button data-action="{{route('course-categories.destroy', $category->id)}}"
                                                type="button" class="btn btn-danger shadow btn-xs sharp single-delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    {!! $categories->appends(Request::except('page'))->render('vendor.pagination.bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{AssetsHelper::assetAdmin('js/single-table.js')}}"></script>

@endsection
