@php use App\Helpers\ConstantsHelper; @endphp
@extends('admin.layouts.auth')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-left">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('sections.index')}}">Chương học</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tạo chương học</li>
            </ol>
        </nav>
        @if(session('success') || session('error'))
            <div class="alert alert-{{ session('success') ? 'success' : 'danger' }} mb-3">
                {{ session('success') ?: session('error') }}
            </div>
        @endif
        <div class="card">
            <div class="col-8">
                <form action="{{route('sections.store')}}" method="POST" class="card-body">
                    @error('message')
                    <div class="alert alert-danger mb-3">{{ $message }}</div>
                    @enderror
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên chương học</label>
                        <input name="name" type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                               id="name" value="{{old("name")}}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <input name="description" type="text" class="form-control" id="description"
                               value="{{old("description")}}">
                    </div>
                    <div class="mb-3">
                        <label for="parents" class="form-label">Khóa học</label>
                        <select value="{{old("course_id")}}" name="course_id"
                                class="form-select {{$errors->has('course_id') ? 'is-invalid' : ''}}"
                                style="width: 100%">
                            <option value="">
                                Chọn khóa học
                            </option>
                            @foreach($courses as $course )
                                <option
                                    {{ old('course_id') == $course->id ? 'selected' : '' }} value="{{$course->id}}">
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
                                    {{ old('status') == $key ? 'selected' : '' }} value="{{$key}}">
                                    {{$value['text']}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit">
                            Tạo khóa học
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection
