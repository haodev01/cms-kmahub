<?php
    use App\Helpers\ConstantsHelper;
    use App\Helpers\AssetsHelper;
?>


<?php $__env->startSection('content'); ?>
    <div class="">
        <div class="flex-between mb-5">
            <h5 class="mb-0">
                Sửa khóa học
            </h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item font-semibold"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item font-semibold"><a href="<?php echo e(route('courses.index')); ?>">Khóa học</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sửa khóa học</li>
                </ol>
            </nav>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible mb-3  fade show"><?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="col-12">
            <form class="card-body" enctype="multipart/form-data" id="formSubmit"
                  data-id="<?php echo e($course->id); ?>">
                <?php if(!empty(session('message'))): ?>
                    <div class="alert alert-danger mb-3"><?php echo e(session('message')); ?></div>
                <?php endif; ?>
                <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="alert alert-danger mb-3"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="row">
                    <div class="col-9 card max-h-100">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="name" class="form-label">Tên khóa học</label>
                                    <input name="name" type="text" class="form-control " id="name"
                                           value="<?php echo e($course->name); ?>">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="slug" class="form-label">Đường dẫn khóa học</label>
                                    <input readonly name="slug" type="text" class="form-control " id="slug"
                                           value="<?php echo e($course->slug); ?>">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="description" class="form-label">Mô tả</label>
                                    <input name="description" type="text" class="form-control" id="description"
                                           value="<?php echo e($course->description); ?>">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="price_original" class="form-label">Giá gốc</label>
                                    <input type="text" name="price_original" id="price_original"
                                           class="form-control "
                                           pattern="\d{1,3}(,\d{3})*(\.\d+)?$" value="<?php echo e($course->price_original); ?>"
                                           data-type="currency"
                                           placeholder="$1,000,000">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="price_sale" class="form-label">Giá Khuyến mãi</label>
                                    <input type="text" name="price_sale" id="currency-field" class="form-control"
                                           pattern="\d{1,3}(,\d{3})*(\.\d+)?$" value="<?php echo e($course->price_sale); ?>"
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
                                            class=" <?php echo e($course->thumbnail ? '' : 'd-none'); ?>"
                                            src="<?php echo e(asset('storage/'.$course->thumbnail)); ?>"
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
                                            class="<?php echo e($course->video_preview ? '' : 'd-none'); ?>"
                                            controls
                                            src="<?php echo e($course->video_preview ? asset('storage/'.$course->video_preview) : ''); ?>">
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
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option
                                                    <?php echo e($course->category_id == $category->id ? 'selected' : ''); ?> value="<?php echo e($category->id); ?>">
                                                    <?php echo e($category->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                            <?php $__currentLoopData = ConstantsHelper::LIST_LEVEL; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option
                                                    <?php echo e($course->level == $value['key'] ? 'selected' : ''); ?> value="<?php echo e($value['key']); ?>">
                                                    <?php echo e($value['text']); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Trạng thái</label>
                                        <select id="status" class="form-select" name="status" style="width: 100%">
                                            <?php $__currentLoopData = ConstantsHelper::LIST_STATUS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option
                                                    <?php echo e($course->status == $key ? 'selected' : ''); ?> value="<?php echo e($key); ?>">
                                                    <?php echo e($value['text']); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                        <?php if(count($course->requirements) > 0): ?>
                                            <?php $__currentLoopData = $course->requirements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requirement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="d-flex align-items-center mb-3">
                                                    <input name="requirments[]" type="text"
                                                           value="<?php echo e($requirement->requirement); ?>"
                                                           class="form-control mr-2">
                                                    <button data-id="<?php echo e($requirement->id); ?>"
                                                            class="btn btn-danger btn-sm btn-remove-requirement "
                                                            type="button">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
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
                                        <?php $__currentLoopData = $course->benefits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="d-flex align-items-center mb-3">
                                                <input value="<?php echo e($benefit->name); ?>" name="benefits[]" type="text"
                                                       placeholder="Nhập lợi ích cho khóa học..."
                                                       class="form-control mr-2 ">
                                                <button
                                                    class="btn btn-danger btn-sm btn-remove-benefit " type="button">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(AssetsHelper::assetAdmin('js/course/edit-course.js')); ?>"></script>
    <script src="<?php echo e(AssetsHelper::assetAdmin('js/inputs/curency-format.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/traiit/Desktop/haodev.com/lms_dashboard/resources/views/admin/pages/courses/edit.blade.php ENDPATH**/ ?>