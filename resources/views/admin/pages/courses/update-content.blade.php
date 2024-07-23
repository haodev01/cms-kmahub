@php use App\Helpers\ConstantsHelper; @endphp
@extends('admin.layouts.auth')

@section('content')
    <div>
        <div class="flex-between flex-wrap-reverse  mb-5">
            <h5 class="mb-0">
                Nội dung khóa học
            </h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 ">
                    <li class="breadcrumb-item font-semibold"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item font-semibold"><a href="{{route('courses.index')}}">Khóa học</a></li>
                    <li class="breadcrumb-item font-semibold"><a href="{{route('courses.edit', $course->id)}}">
                            {{$course->name}}
                        </a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nội dung</li>
                </ol>
            </nav>
        </div>
        <div class="btn  btn-outline-secondary" id="buttonAddSection">
            Thêm chương mới
        </div>
        <div class="mt-3 rounded-3" style="background:rgba(227, 227, 227, 0.8); padding: 16px; display: none"
             id="formAddSection">
            <div class="bg-white mt-3 py-3 px-4 rounded-2">
                <form action="{{route('sections.store')}}" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" name="course_id" value="{{$id}}">
                    <div class="form-group">
                        <label for="lesson_name" class="mb-1">Tên chương học</label>
                        <input type="text" id="lesson_name" class="form-control" name="name"
                               placeholder="Tên chương học">
                    </div>
                    <button class="btn btn-primary" type="submit">
                        Tạo bài học
                    </button>
                </form>
            </div>
        </div>
        <div id="sectionList">
            @foreach($sections as $index=> $section)
                <div class="mt-3 rounded-3" style="background:rgba(227, 227, 227, 0.8); padding: 16px">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Chương {{ $index + 1 }}: {{$section->name}}</h4>
                        <button data-id="{{$section->id}}" class="btn btn-outline-primary buttonAddLesson">
                            Thêm bài học
                        </button>
                    </div>
                    <div class="bg-white mt-3 py-3 px-4 rounded-2 formAddLesson{{$section->id}}"
                         style="display: none">
                        <form action="{{route('lessons.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="chapter_name" class="mb-1">Tên bài học</label>
                                <input type="text" id="chapter_name" class="form-control" name="name"
                                       placeholder="Tên bài học">
                                <input type="hidden" class="form-control" name="section_id" value="{{$section->id}}">
                            </div>
                            <button class="btn btn-primary" type="submit">
                                Tạo bài học
                            </button>
                        </form>
                    </div>
                    <div class="mt-3 " id="lessonList{{$index}}">
                        <div class="accordion" id="accordion{{$index}}">
                            @foreach($section->lessons as $indexLession => $lession)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{$indexLession}}{{$index}}">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{$indexLession}}{{$index}}"
                                                aria-expanded="false"
                                                aria-controls="collapse{{$indexLession}}{{$index}}"
                                                style="width: 100%; border: none; outline: none; box-shadow: none; background: none; padding: 0"
                                        >
                                            <div
                                                data-id="{{$lession->id}}"
                                                data-order="{{$lession->order}}"
                                                class="bg-white py-3 px-4 rounded-2 d-flex align-items-center justify-content-between mb-2">
                                                <p class="mb-0" style="font-size: 16px"> {{$lession->name}}</p>
                                                <div class="d-flex align-items-center gap-3">
                                                    <a href="{{route('lessons.edit', $lession->id)}}">
                                                        <i class="far fa-pen-to-square me-1"
                                                           style="font-size: 20px"></i>
                                                    </a>
                                                    <a href="">
                                                        <i class="far fa-trash-can" style="font-size: 20px"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapse{{$indexLession}}{{$index}}" class="accordion-collapse collapse"
                                         aria-labelledby="heading{{$indexLession}}{{$index}}"
                                         data-bs-parent="#accordion{{$index}}">
                                        <div class="accordion-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form action="{{route('lessons.update', $lession->id)}}"
                                                          method="POST"
                                                          class="card-body"
                                                          enctype="multipart/form-data"
                                                    >
                                                        @error('message')
                                                        <div class="alert alert-danger mb-3">{{ $message }}</div>
                                                        @enderror
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label">Tên bài
                                                                        học</label>
                                                                    <input readonly name="name" type="text"
                                                                           placeholder="Nhập tên bài học"
                                                                           class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                                                                           id="name"
                                                                           value="{{old("name", $lession->name)}}">

                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="mb-3">
                                                                    <label for="description" class="form-label">Mô
                                                                        tả</label>
                                                                    <input readonly name="description" type="text"
                                                                           class="form-control"
                                                                           id="description"
                                                                           value="{{old("description", $lession->description)}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="mb-3">
                                                                    <label for="status" class="form-label">Trạng
                                                                        thái</label>
                                                                    <select disabled id="status" class="form-select"
                                                                            name="status" style="width: 100%">
                                                                        @foreach(ConstantsHelper::LIST_STATUS as $key => $value)
                                                                            <option
                                                                                {{ $lession->status == $key ? 'selected' : '' }} value="{{$key}}">
                                                                                {{$value['text']}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="mb-3">
                                                                    <label for="status"
                                                                           class="form-label d-block">Video </label>
                                                                    <video
                                                                        style="max-width: 100%"
                                                                        id="videoDisplay"
                                                                        class="{{$lession->video ? '' : 'd-none'}} max-w-100"
                                                                        controls
                                                                        src="{{$lession->video ? asset('storage/'.$lession->video) : ''}}">
                                                                    </video>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#buttonAddSection').click(() => {
                $('#formAddSection').slideDown()
            })
            $('.buttonAddLesson').click(function () {
                let id = $(this).data('id')
                $('.formAddLesson' + id).slideDown()
            })
        });
    </script>

@endsection
