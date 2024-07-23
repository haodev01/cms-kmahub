@php use App\Helpers\ConstantsHelper; @endphp
@extends('admin.layouts.auth')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-left">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item">
                    <a
                        href="{{route('courses.update-content', $lesson->section->course->id)}}">
                        {{$lesson->section->course->name}}
                    </a>
                </li>
                <li class="breadcrumb-item"><a
                        href="{{route('sections.index', ['course_id' => $lesson->section->course->id])}}">Danh sách
                        chương</a></li>
                <li class="breadcrumb-item">
                    <a href="{{route('sections.edit', $lesson->section->id)}}">
                        {{$lesson->section->name}}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Sửa bài học</li>
            </ol>
        </nav>
        @error('message')
        <div class="alert alert-danger mb-3">{{ $message }}</div>
        @enderror
        <form id="formSubmit" data-id="{{$lesson->id}}" method="POST" class="row" enctype="multipart/form-data">
            <div class="col-9">
                <div class="card">
                    <div class="row card-body">
                        <div class="mb-3 col-6">
                            <label for="name" class="form-label">Tên chương học</label>
                            <input value="{{old("name", $lesson->name)}}" name="name" type="text"
                                   class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                                   id="name">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-6">
                            <label for="description" class="form-label">Mô tả</label>
                            <input name="description" type="text" class="form-control" id="description"
                                   value="{{old("description", $lesson->description)}}">
                        </div>
                        <div class="mb-3 d-none">
                            <label for="parents" class="form-label">Khóa học</label>
                            <select value="{{old("lesson_id")}}" name="lesson_id" class="form-select"
                            >
                                <option value="">
                                    Chọn chương học
                                </option>
                                @foreach($sections as $section )
                                    <option
                                        {{ old('parent_id') == $section->id ? 'selected' : '' }} value="{{$section->id}}">
                                        {{$section->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="video" class="form-label">Video Preview</label>
                            <div id="video" class="thumbnail-wrapper">
                                <div class="select-thumb">
                                    <button class="btn btn-primary icon-left" type="button" id="selectVideo">
                                        <i class="fa fa-upload"></i>
                                        Tải lên video
                                    </button>
                                </div>
                                <video
                                    id="videoDisplay"
                                    class="{{$lesson->video ? '' : 'd-none'}}"
                                    controls
                                    src="{{$lesson->video ? asset('storage/'.$lesson->video) : ''}}">
                                </video>
                            </div>
                            <input name="video" id="inputVideo" type="file"
                                   class="basic-filepond d-none"
                                   accept="video/mp4, video/mp3">
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary" type="submit">
                                Sửa khóa học
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 ">
                <div class="row card">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="status" class="form-label">Trạng thái</label>
                                <select id="status" class="form-select" name="status" style="width: 100%">
                                    @foreach(ConstantsHelper::LIST_STATUS as $key => $value)
                                        <option
                                            {{ $lesson->status == $key ? 'selected' : '' }} value="{{$key}}">
                                            {{$value['text']}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        const formSubmit = $('#formSubmit')
        formSubmit.submit(function (event) {
            event.preventDefault();
            const form = $(this);
            const id = form.data('id');
            const formData = new FormData(this);
            fetcher.post(`/admin/lessons/updateContent/${id}`, formData, {
                processData: false,
                contentType: false,
                success: function (response) {
                    alertSuccess(response.message, () => {
                        window.location.reload()
                    })
                },
                error: function (error) {
                    const errors = error.responseJSON.errors;
                    displayErrors(errors)
                }
            })
        })
    </script>
    <script>
        const selectVideo = $('#selectVideo')
        const inputVideo = $('#inputVideo')
        const videoDisplay = $('#videoDisplay')
        selectVideo.click(() => {
            inputVideo.click();
        })

        function displayVideoPreivew(src) {
            videoDisplay.attr('src', src)
            videoDisplay.show();
            videoDisplay.removeClass('d-none');
        }

        inputVideo.change((event) => {
            let file = event.target.files[0];
            let blobURL = URL.createObjectURL(file);
            displayVideoPreivew(blobURL)
        })
    </script>
@endsection
