@php use App\Helpers\AssetsHelper;@endphp
@extends('admin.layouts.auth')


@section('content')
    <div class="">
        <div class="flex-between mb-5">
            <h5 class="mb-0">Tạo khóa học</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item font-semibold"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item font-semibold"><a href="{{route('courses.index')}}">Khóa học</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tạo khóa học</li>
                </ol>
            </nav>
        </div>
        <div class="col-12">
            <form method="POST" enctype="multipart/form-data" id="formSubmit">
                @error('message')
                <div class="alert alert-danger mb-3">{{ $message }}</div>
                @enderror
                @csrf
                <div class="row">
                    <div class="col-9 card">
                        <div class="row card-body">
                            <div class="col-6 mb-3">
                                <label for="name" class="form-label">Tên khóa học</label>
                                <input name="name" type="text" class="form-control " id="name">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="slug" class="form-label">Đường dẫn khóa học</label>
                                <input name="slug" type="text" class="form-control " id="slug">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="description" class="form-label">Mô tả</label>
                                <input name="description" type="text" class="form-control" id="description"
                                       value="">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="price_original" class="form-label">Giá gốc</label>
                                <input type="text" name="price_original" id="price_original" class="form-control"
                                       pattern="\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency"
                                       placeholder="1,000,000">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="price_sale" class="form-label">Giá Khuyến mãi</label>
                                <input type="text" name="price_sale" id="price_sale" class="form-control"
                                       pattern="\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency"
                                       placeholder="1,000,000">
                            </div>
                        </div>

                        <div class="row card-body">
                            <div class="col-6 mb-3">
                                <label for="thumbnail" class="form-label">Thumbnail</label>
                                <div id="thumbnail-wrapper"
                                     class="thumbnail-wrapper">
                                    <div class="select-thumb">
                                        <button class="btn btn-primary icon-left" type="button" id="selectThumb">
                                            <i class="fa fa-upload"></i>
                                            Tải lên hình ảnh
                                        </button>
                                    </div>
                                    <img id="image-thumbnail" src="" alt="" style="display: none">
                                </div>
                                <input name="thumbnail"
                                       id="thumbnail" type="file"
                                       class="basic-filepond d-none form-control"
                                       accept="image/jpeg, image/png, image/gif, image/webp">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="video" class="form-label">Video Preview</label>
                                <div id="video-wrapper" class="thumbnail-wrapper">
                                    <div class="select-thumb">
                                        <button class="btn btn-primary icon-left" type="button" id="selectVideo">
                                            <i class="fa fa-upload"></i>
                                            Tải lên video
                                        </button>
                                    </div>
                                    <video

                                        style="display: none"
                                        id="videoDisplay"
                                        autoplay
                                        controls
                                        src="">
                                    </video>
                                </div>
                                <input name="video" id="inputVideo" type="file"
                                       class="basic-filepond d-none"
                                       accept="video/mp4, video/mp3">
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-primary" type="submit">
                                    Tạo khóa học
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card mb-3">
                            <div class="row  card-body">
                                <div class="col-12 mb-4">
                                    <label for="category" class="form-label">Danh mục</label>
                                    <select value="" id="category_id" class="form-select"
                                            name="category_id"
                                            id="single-select"
                                            class="js-example-basic-multiple"
                                            style="width: 100%"
                                    >
                                        <option value="">
                                            Chọn danh mục
                                        </option>
                                        @foreach($categories as $category )
                                            <option value="{{$category->id}}">
                                                {{$category->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="level" class="form-label">Mức độ</label>
                                    <select value="{{old('level', 'beginner')}}" id="level" class="form-select"
                                            name="level"
                                            style="width: 100%"
                                    >
                                        <option value="">
                                            Chọn mức độ
                                        </option>
                                        <option value="beginner">
                                            Cơ bản
                                        </option>
                                        <option value="intermediate">
                                            Trung bình
                                        </option>
                                        <option value="anvanced">
                                            Nâng cao
                                        </option>
                                        <option value="expert">
                                            Chuyên sâu
                                        </option>
                                    </select>
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select value="active" id="status" class="form-select"
                                            name="status"
                                            style="width: 100%"
                                    >
                                        <option value="active">
                                            Hoạt động
                                        </option>
                                        <option value="pending">
                                            Tạm dừng
                                        </option>
                                        <option value="draft">
                                            Nháp
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="flex-between">
                                        <h5 class="m-0">Yêu cầu</h5>
                                        <button id="add-requiment" class="btn btn-primary btn-sm" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="requiment-list mt-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <input name="requirments[]" type="text"
                                                   placeholder="Nhập yêu cầu cho khóa học..."
                                                   class="form-control mr-2 ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="flex-between">
                                        <h5 class="m-0">Lợi ích </h5>
                                        <button id="add-benefit" class="btn btn-primary btn-sm" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>

                                    <div class="benefit-list mt-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <input name="benefits[]" type="text"
                                                   placeholder="Nhập lợi ích cho khóa học..."
                                                   class="form-control mr-2 ">
                                        </div>
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
    <script src="{{AssetsHelper::assetAdmin('js/course/create-course.js')}}"></script>
    <script src="{{AssetsHelper::assetAdmin('js/inputs/curency-format.js')}}"></script>
@endsection
