<?php

use App\Helpers\AssetsHelper;
use App\Helpers\ConstantsHelper;

?>

@extends('admin.layouts.auth')

@section('content')
    <div class="flex-between">
        <h5 class="m-0">Danh sách chương học</h5>
        <nav aria-label="breadcrumb  ">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item font-semibold"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chương học</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex align-items-center justify-content-between my-3 mt-5">
        <form id="form-search" action="{{route('sections.index')}}" method="GET">
            <input value="{{request()->get('keyword')}}" name="keyword" type="text" id="search" class="form-control"
                   placeholder="Tìm kiếm ...">
        </form>
        <a href="{{route('sections.create')}}" class="btn btn-primary icon-left ">
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
                    <div id="button-action-delete-all" data-action="{{route('sections.destroyMany')}}">
                        <i class="fa fa-trash text-danger pointer icon-font"></i>
                    </div>
                </div>
                <div class="mr-2">
                    <select class="form-select select-filter" style="min-width: 200px" name="course_id">
                        <option value="">Tất cả khóa học</option>
                        @foreach($courses as $course)
                            <option
                                {{ request('course_id') == $course->id ? 'selected' : '' }} value="{{ $course->id }}">
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class=" ml-2">
                    <select class="form-select select-filter" style="min-width: 200px" name="status">
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
                        <th>
                            <div class="custom-control custom-checkbox checkbox-danger check-lg mr-3">
                                <input type="checkbox" class="input-checkbox-all">
                                <label class="custom-control-label" for="checkAll"></label>
                            </div>
                        </th>
                        <th>@sortablelink('id', 'ID')</th>
                        <th>@sortablelink('name', 'Tên chương học')</th>
                        <th>
                            @sortablelink('course_id', 'Tên khoá học ')
                        </th>

                        <th>@sortablelink('created_at', 'Ngày tạo')</th>
                        <th>@sortablelink('status', 'Trạng thái')</th>
                        <th>
                            @sortablelink('created_by_id', 'Người tạo')
                        </th>
                        <th>
                            <strong>Hành động</strong>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($sections) === 0)
                        <tr>
                            <td colspan="7" class="text-center">
                                <h3 class="py-5">
                                    Không tìm thấy kết quả
                                </h3>
                            </td>
                        </tr>
                    @endif
                    @foreach($sections as $section)
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox checkbox-danger check-lg mr-3">
                                    <input type="checkbox" value="{{$section->id}}" class="input-checkbox">
                                </div>
                            </td>
                            <td>{{$section->id}}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="w-space-no">{{$section->name}}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="w-space-no">{{$section->course->name}}</span>
                                </div>
                            </td>
                            <td>
                                <span>{{date('d-m-y', strtotime($section->created_at))}}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-1 ">
                                    <i class="fa fa-circle {{ConstantsHelper::STATUS_COLOR[$section->status]}} mr-1"></i>
                                    <span>{{ConstantsHelper::STATUS[$section->status]}}</span>
                                </div>
                            </td>
                            <td>
                                <span>
                                    @if($section->createdBy)
                                        {{$section->createdBy->name}}
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{route('sections.edit', $section->id)}}"
                                       class="btn btn-primary shadow btn-xs sharp "><i
                                            class="fa fa-pencil"></i></a>
                                    <button type="button"
                                            data-action="{{route('sections.destroy', $section->id)}}"
                                            class="btn btn-danger shadow btn-xs sharp single-delete">
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
                {!! $sections->appends(Request::except('page'))->render('vendor.pagination.bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{AssetsHelper::assetAdmin('js/single-table.js')}}"></script>
@endsection('scripts')
