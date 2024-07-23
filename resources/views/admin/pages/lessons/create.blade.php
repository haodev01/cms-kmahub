@extends('admin.layouts.auth')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-left">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('lessons.index')}}">Bài học</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tạo bài học</li>
            </ol>
        </nav>
        <div class="card">
            <div class="col-8">
                <form action="{{route('lessons.store')}}" method="POST" class="card-body">
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
                        <select value="{{old("lesson_id")}}" name="lesson_id" id="single-select"
                                class="js-example-basic-multiple"
                                style="width: 100%"
                        >
                            <option value="">
                                Chọn chương học
                            </option>
                            @foreach($lessons as $lesson )
                                <option
                                    {{ old('parent_id') == $lesson->id ? 'selected' : '' }} value="{{$lesson->id}}">
                                    {{$lesson->name}}
                                </option>
                            @endforeach


                        </select>
                    </div>
                    <div class="custom-control custom-checkbox checkbox-success check-sm mr-3">
                        <input type="checkbox" class="custom-control-input" id="status" name="status">
                        <label class="custom-control-label" for="status">Hoạt động</label>
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
