@php use App\Helpers\ConstantsHelper; @endphp
@extends('admin.layouts.auth')

@section('content')
    <div class="">
        <div class="flex-between flex-wrap-reverse mb-5">
            <h5 class="mb-0">Sửa chương học</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item font-semibold"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item font-semibold"><a
                            href="{{route('sections.index', ['course_id' => $section->course->id])}}">Danh sách
                            chương</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Sửa chương học</li>
                </ol>
            </nav>
        </div>
        @if(session('success') || session('error'))
            <div class="alert alert-{{ session('success') ? 'success' : 'danger' }} mb-3">
                {{ session('success') ?: session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <form action="{{route('sections.update', $section->id)}}" method="POST" class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên chương học</label>
                            <input name="name" type="text"
                                   class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                                   id="name" value="{{old("name", $section->name)}}">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <input name="description" type="text" class="form-control" id="description"
                                   value="{{old("description", $section->description)}}">
                        </div>
                        <div class="mb-3">
                            <label for="parents" class="form-label">Khóa học</label>
                            <select disabled value="{{old("course_id")}}" name="course_id"
                                    class="form-select {{$errors->has('course_id') ? 'is-invalid' : ''}}"
                                    style="width: 100%">
                                <option value="">
                                    Chọn khóa học
                                </option>
                                @foreach($courses as $course )
                                    <option
                                        {{ old('course_id', $section->course_id) == $course->id ? 'selected' : '' }} value="{{$course->id}}">
                                        {{$course->name}}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select value="<?php echo e(old('status', 'active')); ?>" id="status" class="form-select"
                                    name="status"
                                    style="width: 100%"
                            >
                                <option value="">Chọn trạng thái</option>
                                @foreach(ConstantsHelper::LIST_STATUS as $key => $value)
                                    <option
                                        {{ old('status', $section->status) == $key ? 'selected' : '' }} value="{{$key}}">
                                        {{$value['text']}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary" type="submit">
                                Sửa chương học
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-6">
                <div class="flex-between mb-3">
                    <h4>Danh sách bài học</h4>
                    <div class="btn btn-primary icon-left btn-add-lesson">
                        Tạo bài học
                    </div>
                </div>
                <form class="card form-add-lesson" action="{{route('lessons.store')}}" method="POST"
                      style="display: none">
                    @csrf
                    <div class="mt-3 card-body">
                        <div class="form-group">
                            <label for="chapter_name" class="mb-1">Tên bài học</label>
                            <input type="text" id="chapter_name" class="form-control" name="name"
                                   placeholder="Tên bài học">
                            <input type="hidden" class="form-control" name="section_id" value="{{$section->id}}">
                        </div>
                        <button class="btn btn-primary" type="submit">
                            Tạo bài học
                        </button>
                    </div>
                </form>
                <div>
                    @foreach($section->lessons as $index => $lession)
                        <div
                            class="bg-white py-3 px-4 rounded-2 d-flex align-items-center justify-content-between mb-2">
                            <span class="mb-0"> {{$lession->name}}</span>
                            <div class="d-flex align-items-center gap-3">
                                <a href="{{route('lessons.edit', $lession->id)}}">
                                    <i class="far fa-pen-to-square me-1 icon-font"></i>
                                </a>
                                <div class="pointer"
                                     onclick="handleDelete([{{$lession->id}}], `{{route('lessons.destroyMany')}}`)">
                                    <i class="far fa-trash-can icon-font"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.btn-add-lesson').click(function () {
                const button = $(this)
                const form = $('.form-add-lesson')
                console.log(button)
                if (form.css('display') === 'none') {
                    form.slideDown()
                    button.text("Đóng")
                } else {
                    form.slideUp()
                    button.text("Tạo bài học")
                }
            })
        });
    </script>
@endsection
