<?php

use App\Helpers\AssetsHelper;

?>

@extends('admin.layouts.auth')

@section('content')
    <div class="col-lg-12 ">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb breadcrumb-left">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Bài học</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex align-items-center justify-content-between my-3 mt-5">
        <h3>Danh sách bài học</h3>
        <a href="{{route('lessons.create')}}" class="btn btn-primary ">
            Tạo mới
        </a>
    </div>
    <div class="card">
        <form id="formDeleteAll" action="{{route('destroyMany')}}" method="POST" class="card-body">
            <div style="height: 40px">
                <button class="btn btn-danger btn-delete-all col-2 mb-2" style="display: none" type="button"
                        data-bs-target="#modalDeleteAll"
                        data-bs-toggle="modal">
                    Xóa tất cả
                </button>
            </div>
            @csrf
            @method('DELETE')
            <div class="table-responsive">
                <table class="table table-responsive-md">
                    <thead>
                    <tr>
                        <th style="width:50px;">
                            <div class="custom-control custom-checkbox checkbox-danger check-lg mr-3">
                                <input type="checkbox" class="custom-control-input" id="checkAll">
                                <label class="custom-control-label" for="checkAll"></label>
                            </div>
                        </th>
                        <th>
                            <strong>ID</strong>
                        </th>
                        <th>
                            <strong>Tên danh mục</strong>
                        </th>
                        <th><strong>Mô tả</strong></th>
                        <th><strong>Ngày tạo</strong></th>
                        <th><strong>Trạng thái</strong></th>
                        <th>
                            <strong>Hành động</strong>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($lessons) === 0)
                        <tr>
                            <td colspan="7" class="text-center">
                                <h3 class="py-5">
                                    Không tìm thấy kết quả
                                </h3>
                            </td>
                        </tr>
                    @endif
                    @foreach($lessons as $section)
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox checkbox-danger check-lg mr-3">
                                    <input name="ids[]" type="checkbox" value="{{$section->id}}"
                                           class="custom-control-input custom-control-input-categories"
                                           id="customCheckBox{{$section->id}}"
                                    >
                                    <label class="custom-control-label"
                                           for="customCheckBox{{$section->id}}"></label>
                                </div>
                            </td>
                            <td>{{$section->id}}</td>
                            <td>
                                <div class="d-flex align-items-center"><img
                                        src="{{$section->image ?? AssetsHelper::assetKiaalap('images/avatar/3.jpg')}}"
                                        class="rounded-lg mr-2" width="24" alt="">
                                    <span class="w-space-no">
                                                {{$section->name}}
                                            </span></div>
                            </td>
                            <td>
                                <span>{{$section->description}}</span>
                            </td>
                            <td>
                                <span>{{date('d-m-y', strtotime($section->created_at))}}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-1 ">
                                    <i class="fa fa-circle {{$section->status ? 'text-success' : 'text-warning'}} mr-1"></i>
                                    <span>{{$section->status ? 'Đang hoạt động' : 'Khóa'}}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{route('course-categories.edit', $section->id)}}"
                                       class="btn btn-primary shadow btn-xs sharp "><i
                                            class="fa fa-pencil"></i></a>
                                    <button data-bs-target="#modalDelete" data-bs-toggle="modal" type="button"
                                            data-id="{{$section->id}}"
                                            class="btn btn-danger shadow btn-xs sharp"><i
                                            class="fa fa-trash"></i></button>

                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <div>
                {{$lessons->withQueryString()->links('vendor.pagination.bootstrap-5')}}
            </div>
        </form>
    </div>
@endsection
