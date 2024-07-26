<?php use App\Helpers\ConstantsHelper; ?>


<?php $__env->startSection('content'); ?>
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-left">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item">
                    <a
                        href="<?php echo e(route('courses.update-content', $lesson->section->course->id)); ?>">
                        <?php echo e($lesson->section->course->name); ?>

                    </a>
                </li>
                <li class="breadcrumb-item"><a
                        href="<?php echo e(route('sections.index', ['course_id' => $lesson->section->course->id])); ?>">Danh sách
                        chương</a></li>
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('sections.edit', $lesson->section->id)); ?>">
                        <?php echo e($lesson->section->name); ?>

                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Sửa bài học</li>
            </ol>
        </nav>
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
        <form id="formSubmit" data-id="<?php echo e($lesson->id); ?>" method="POST" class="row" enctype="multipart/form-data">
            <div class="col-9">
                <div class="card">
                    <div class="row card-body">
                        <div class="mb-3 col-6">
                            <label for="name" class="form-label">Tên chương học</label>
                            <input value="<?php echo e(old("name", $lesson->name)); ?>" name="name" type="text"
                                   class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                                   id="name">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="description" class="form-label">Mô tả</label>
                            <input name="description" type="text" class="form-control" id="description"
                                   value="<?php echo e(old("description", $lesson->description)); ?>">
                        </div>
                        <div class="mb-3 d-none">
                            <label for="parents" class="form-label">Khóa học</label>
                            <select value="<?php echo e(old("lesson_id")); ?>" name="lesson_id" class="form-select"
                            >
                                <option value="">
                                    Chọn chương học
                                </option>
                                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option
                                        <?php echo e(old('parent_id') == $section->id ? 'selected' : ''); ?> value="<?php echo e($section->id); ?>">
                                        <?php echo e($section->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                    class="<?php echo e($lesson->video ? '' : 'd-none'); ?>"
                                    controls
                                    src="<?php echo e($lesson->video ? asset('storage/'.$lesson->video) : ''); ?>">
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
                                    <?php $__currentLoopData = ConstantsHelper::LIST_STATUS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            <?php echo e($lesson->status == $key ? 'selected' : ''); ?> value="<?php echo e($key); ?>">
                                            <?php echo e($value['text']); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/traiit/Desktop/haodev.com/lms_dashboard/resources/views/admin/pages/lessons/edit.blade.php ENDPATH**/ ?>