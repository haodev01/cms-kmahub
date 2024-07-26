@php
    use App\Helpers\ConstantsHelper;
    use App\Helpers\AssetsHelper;
@endphp
@extends('admin.layouts.auth')

@section('content')
    <div class="">
        <div class="flex-between mb-5">
            <h5 class="mb-0">
                Sửa khóa học
            </h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item font-semibold"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item font-semibold"><a href="{{route('courses.index')}}">Khóa học</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sửa khóa học</li>
                </ol>
            </nav>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible mb-3  fade show">{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
        @endif
        <div class="col-12">
            <form class="card-body" enctype="multipart/form-data" id="formSubmit"
                  data-id="{{$course->id}}">
                @if(!empty(session('message')))
                    <div class="alert alert-danger mb-3">{{ session('message') }}</div>
                @endif
                @error('message')
                <div class="alert alert-danger mb-3">{{ $message }}</div>
                @enderror
                <div class="row">
                    <div class="col-9 card max-h-100">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="name" class="form-label">Tên khóa học</label>
                                    <input name="name" type="text" class="form-control " id="name"
                                           value="{{$course->name}}">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="slug" class="form-label">Đường dẫn khóa học</label>
                                    <input readonly name="slug" type="text" class="form-control " id="slug"
                                           value="{{$course->slug}}">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="description" class="form-label">Mô tả</label>
                                    <input name="description" type="text" class="form-control" id="description"
                                           value="{{$course->description}}">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="price_original" class="form-label">Giá gốc</label>
                                    <input type="text" name="price_original" id="price_original"
                                           class="form-control "
                                           pattern="\d{1,3}(,\d{3})*(\.\d+)?$" value="{{$course->price_original}}"
                                           data-type="currency"
                                           placeholder="$1,000,000">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="price_sale" class="form-label">Giá Khuyến mãi</label>
                                    <input type="text" name="price_sale" id="currency-field" class="form-control"
                                           pattern="\d{1,3}(,\d{3})*(\.\d+)?$" value="{{$course->price_sale}}"
                                           data-type="currency"
                                           placeholder="$1,000,000">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="thumbnail" class="form-label">Thumbnail</label>
                                    <div id="thumbnail-wrapper "
                                         class="thumbnail-wrapper"
                                    >
                                        <div class="select-thumb">
                                            <button class="btn btn-primary icon-left " type="button" id="selectThumb">
                                                <i class="fa fa-upload"></i>
                                                Tải lên hình ảnh
                                            </button>
                                        </div>
                                        <img
                                            id="image-thumbnail"
                                            class=" {{$course->thumbnail ? '' : 'd-none'}}"
                                            src="{{asset('storage/'.$course->thumbnail)}}"
                                            alt="">
                                    </div>
                                    <input name="thumbnail"
                                           id="thumbnail" type="file"
                                           class="basic-filepond d-none form-control"
                                           accept="image/jpeg, image/png, image/gif, image/webp">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="video" class="form-label">Video Preview</label>
                                    <div id="video-wrapper " class="thumbnail-wrapper">
                                        <div class="select-thumb">
                                            <button class="btn btn-primary icon-left" type="button" id="selectVideo">
                                                <i class="fa fa-upload"></i>
                                                Tải lên video
                                            </button>
                                        </div>
                                        <video
                                            id="videoDisplay"
                                            class="{{$course->video_preview ? '' : 'd-none'}}"
                                            controls
                                            src="{{$course->video_preview ? asset('storage/'.$course->video_preview) : ''}}">
                                        </video>
                                    </div>
                                    <input name="video" id="inputVideo" type="file"
                                           class="basic-filepond d-none"
                                           accept="video/mp4, video/mp3">
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 mb-3">
                            <button class="btn btn-primary" type="submit">
                                Sửa khóa học
                            </button>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Danh mục</label>
                                        <select id="category_id" class="form-select"
                                                name="category_id"
                                                id="single-select"
                                                class="js-example-basic-multiple"
                                                style="width: 100%"
                                        >
                                            <option value="">
                                                Chọn danh mục
                                            </option>
                                            @foreach($categories as $category )
                                                <option
                                                    {{ $course->category_id == $category->id ? 'selected' : '' }} value="{{$category->id}}">
                                                    {{$category->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="level" class="form-label">Mức độ</label>
                                        <select id="level" class="form-select"
                                                name="level"
                                                style="width: 100%"
                                        >
                                            <option value="">
                                                Chọn mức độ
                                            </option>
                                            @foreach(ConstantsHelper::LIST_LEVEL as $key => $value)
                                                <option
                                                    {{ $course->level == $value['key'] ? 'selected' : '' }} value="{{$value['key']}}">
                                                    {{$value['text']}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Trạng thái</label>
                                        <select id="status" class="form-select" name="status" style="width: 100%">
                                            @foreach(ConstantsHelper::LIST_STATUS as $key => $value)
                                                <option
                                                    {{ $course->status == $key ? 'selected' : '' }} value="{{$key}}">
                                                    {{$value['text']}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="col-12 mb-3">
                                    <div class="flex-between">
                                        <h5 class="m-0">Yêu cầu </h5>
                                        <button id="add-requiment" class="btn btn-primary btn-sm" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="requiment-list mt-3">
                                        @if(count($course->requirements) > 0)
                                            @foreach($course->requirements as $requirement)
                                                <div class="d-flex align-items-center mb-3">
                                                    <input name="requirments[]" type="text"
                                                           value="{{$requirement->requirement}}"
                                                           class="form-control mr-2">
                                                    <button data-id="{{$requirement->id}}"
                                                            class="btn btn-danger btn-sm btn-remove-requirement "
                                                            type="button">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="col-12 mb-3">
                                    <div class="flex-between">
                                        <h5 class="m-0">Lợi ích </h5>
                                        <button id="add-benefit" class="btn btn-primary btn-sm" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>

                                    <div class="benefit-list mt-3">
                                        @foreach($course->benefits as $benefit)
                                            <div class="d-flex align-items-center mb-3">
                                                <input value="{{$benefit->name}}" name="benefits[]" type="text"
                                                       placeholder="Nhập lợi ích cho khóa học..."
                                                       class="form-control mr-2 ">
                                                <button
                                                    class="btn btn-danger btn-sm btn-remove-benefit " type="button">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{AssetsHelper::assetAdmin('js/course/edit-course.js')}}"></script>
    <script src="{{AssetsHelper::assetAdmin('js/inputs/curency-format.js')}}"></script>
@endsection

