@extends('admin.layouts.auth')

@section('content')
    <div class="">
        <div class="flex-between mb-5">
            <h5 class="mb-0">Tạo danh mục</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item font-semibold"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item font-semibold"><a href="{{route('course-categories.index')}}">Danh
                            mục</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tạo danh mục</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="col-8">
                <form action="{{route('course-categories.store')}}" method="POST" class="card-body">
                    @error('message')
                    <div class="alert alert-danger mb-3">{{ $message }}</div>
                    @enderror
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên danh mục</label>
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
                        <label for="parents" class="form-label">Danh mục cha</label>
                        <select value="{{old("parent_id")}}" name="parent_id"
                                class="form-select"
                                style="width: 100%"
                        >
                            <option value="">
                                Chọn danh mục cha
                            </option>
                            @foreach($categories as $category )
                                <option
                                    {{ old('parent_id') == $category->id ? 'selected' : '' }} value="{{$category->id}}">
                                    {{$category->name}}
                                </option>
                            @endforeach


                        </select>
                    </div>
                    <div class="mb-3">
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
                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit">
                            Tạo danh mục
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection
