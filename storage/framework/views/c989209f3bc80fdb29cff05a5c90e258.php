<?php use App\Helpers\ConstantsHelper; ?>


<?php $__env->startSection('content'); ?>
    <div>
        <div class="flex-between flex-wrap-reverse  mb-5">
            <h5 class="mb-0">
                Nội dung khóa học
            </h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 ">
                    <li class="breadcrumb-item font-semibold"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item font-semibold"><a href="<?php echo e(route('courses.index')); ?>">Khóa học</a></li>
                    <li class="breadcrumb-item font-semibold"><a href="<?php echo e(route('courses.edit', $course->id)); ?>">
                            <?php echo e($course->name); ?>

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
                <form action="<?php echo e(route('sections.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" class="form-control" name="course_id" value="<?php echo e($id); ?>">
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
            <?php $__currentLoopData = $course->sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=> $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mt-3 rounded-3" style="background:rgba(227, 227, 227, 0.8); padding: 16px">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Chương <?php echo e($index + 1); ?>: <?php echo e($section->name); ?></h4>
                        <button data-id="<?php echo e($section->id); ?>" class="btn btn-outline-primary buttonAddLesson">
                            Thêm bài học
                        </button>
                    </div>
                    <div class="bg-white mt-3 py-3 px-4 rounded-2 formAddLesson<?php echo e($section->id); ?>"
                         style="display: none">
                        <form action="<?php echo e(route('lessons.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="chapter_name" class="mb-1">Tên bài học</label>
                                <input type="text" id="chapter_name" class="form-control" name="name"
                                       placeholder="Tên bài học">
                                <input type="hidden" class="form-control" name="section_id" value="<?php echo e($section->id); ?>">
                            </div>
                            <button class="btn btn-primary" type="submit">
                                Tạo bài học
                            </button>
                        </form>
                    </div>
                    <div class="mt-3 " id="lessonList<?php echo e($index); ?>">
                        <div class="accordion" id="accordion<?php echo e($index); ?>">
                            <?php $__currentLoopData = $section->lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $indexLession => $lession): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading<?php echo e($indexLession); ?><?php echo e($index); ?>">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapse<?php echo e($indexLession); ?><?php echo e($index); ?>"
                                                aria-expanded="false"
                                                aria-controls="collapse<?php echo e($indexLession); ?><?php echo e($index); ?>"
                                                style="width: 100%; border: none; outline: none; box-shadow: none; background: none; padding: 0"
                                        >
                                            <div
                                                data-id="<?php echo e($lession->id); ?>"
                                                data-order="<?php echo e($lession->order); ?>"
                                                class="bg-white py-3 px-4 rounded-2 d-flex align-items-center justify-content-between mb-2">
                                                <p class="mb-0" style="font-size: 16px"> <?php echo e($lession->name); ?></p>
                                                <div class="d-flex align-items-center gap-3">
                                                    <a href="<?php echo e(route('lessons.edit', $lession->id)); ?>">
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
                                    <div id="collapse<?php echo e($indexLession); ?><?php echo e($index); ?>" class="accordion-collapse collapse"
                                         aria-labelledby="heading<?php echo e($indexLession); ?><?php echo e($index); ?>"
                                         data-bs-parent="#accordion<?php echo e($index); ?>">
                                        <div class="accordion-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form action="<?php echo e(route('lessons.update', $lession->id)); ?>"
                                                          method="POST"
                                                          class="card-body"
                                                          enctype="multipart/form-data"
                                                    >
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
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PUT'); ?>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label">Tên bài
                                                                        học</label>
                                                                    <input readonly name="name" type="text"
                                                                           placeholder="Nhập tên bài học"
                                                                           class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                                                                           id="name"
                                                                           value="<?php echo e(old("name", $lession->name)); ?>">

                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="mb-3">
                                                                    <label for="description" class="form-label">Mô
                                                                        tả</label>
                                                                    <input readonly name="description" type="text"
                                                                           class="form-control"
                                                                           id="description"
                                                                           value="<?php echo e(old("description", $lession->description)); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="mb-3">
                                                                    <label for="status" class="form-label">Trạng
                                                                        thái</label>
                                                                    <select disabled id="status" class="form-select"
                                                                            name="status" style="width: 100%">
                                                                        <?php $__currentLoopData = ConstantsHelper::LIST_STATUS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option
                                                                                <?php echo e($lession->status == $key ? 'selected' : ''); ?> value="<?php echo e($key); ?>">
                                                                                <?php echo e($value['text']); ?>

                                                                            </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                                                        class="<?php echo e($lession->video ? '' : 'd-none'); ?> max-w-100"
                                                                        controls
                                                                        src="<?php echo e($lession->video ? asset('storage/'.$lession->video) : ''); ?>">
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
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/traiit/Desktop/kmahub.com/cms-kmahub/resources/views/admin/pages/courses/update-content.blade.php ENDPATH**/ ?>