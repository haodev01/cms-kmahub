<?php use App\Helpers\ConstantsHelper; ?>


<?php $__env->startSection('content'); ?>
    <div class="">
        <div class="flex-between flex-wrap-reverse mb-5">
            <h5 class="mb-0">Sửa chương học</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item font-semibold"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item font-semibold"><a
                            href="<?php echo e(route('sections.index', ['course_id' => $section->course->id])); ?>">Danh sách
                            chương</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Sửa chương học</li>
                </ol>
            </nav>
        </div>
        <?php if(session('success') || session('error')): ?>
            <div class="alert alert-<?php echo e(session('success') ? 'success' : 'danger'); ?> mb-3">
                <?php echo e(session('success') ?: session('error')); ?>

            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <form action="<?php echo e(route('sections.update', $section->id)); ?>" method="POST" class="card-body">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên chương học</label>
                            <input name="name" type="text"
                                   class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                                   id="name" value="<?php echo e(old("name", $section->name)); ?>">
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
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <input name="description" type="text" class="form-control" id="description"
                                   value="<?php echo e(old("description", $section->description)); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="parents" class="form-label">Khóa học</label>
                            <select disabled value="<?php echo e(old("course_id")); ?>" name="course_id"
                                    class="form-select <?php echo e($errors->has('course_id') ? 'is-invalid' : ''); ?>"
                                    style="width: 100%">
                                <option value="">
                                    Chọn khóa học
                                </option>
                                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option
                                        <?php echo e(old('course_id', $section->course_id) == $course->id ? 'selected' : ''); ?> value="<?php echo e($course->id); ?>">
                                        <?php echo e($course->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['course_id'];
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
                        <div class="mb-3">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select value="<?php echo e(old('status', 'active')); ?>" id="status" class="form-select"
                                    name="status"
                                    style="width: 100%"
                            >
                                <option value="">Chọn trạng thái</option>
                                <?php $__currentLoopData = ConstantsHelper::LIST_STATUS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option
                                        <?php echo e(old('status', $section->status) == $key ? 'selected' : ''); ?> value="<?php echo e($key); ?>">
                                        <?php echo e($value['text']); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary" type="submit">
                                Sửa chương học
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-6">
                <div class="flex-between mb-3">
                    <h4>Danh sách bài học</h4>
                    <div class="btn btn-primary icon-left btn-add-lesson">
                        Tạo bài học
                    </div>
                </div>
                <form class="card form-add-lesson" action="<?php echo e(route('lessons.store')); ?>" method="POST"
                      style="display: none">
                    <?php echo csrf_field(); ?>
                    <div class="mt-3 card-body">
                        <div class="form-group">
                            <label for="chapter_name" class="mb-1">Tên bài học</label>
                            <input type="text" id="chapter_name" class="form-control" name="name"
                                   placeholder="Tên bài học">
                            <input type="hidden" class="form-control" name="section_id" value="<?php echo e($section->id); ?>">
                        </div>
                        <button class="btn btn-primary" type="submit">
                            Tạo bài học
                        </button>
                    </div>
                </form>
                <div>
                    <?php $__currentLoopData = $section->lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lession): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div
                            class="bg-white py-3 px-4 rounded-2 d-flex align-items-center justify-content-between mb-2">
                            <span class="mb-0"> <?php echo e($lession->name); ?></span>
                            <div class="d-flex align-items-center gap-3">
                                <a href="<?php echo e(route('lessons.edit', $lession->id)); ?>">
                                    <i class="far fa-pen-to-square me-1 icon-font"></i>
                                </a>
                                <div class="pointer"
                                     onclick="handleDelete([<?php echo e($lession->id); ?>], `<?php echo e(route('lessons.destroyMany')); ?>`)">
                                    <i class="far fa-trash-can icon-font"></i>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function () {
            $('.btn-add-lesson').click(function () {
                const button = $(this)
                const form = $('.form-add-lesson')
                console.log(button)
                if (form.css('display') === 'none') {
                    form.slideDown()
                    button.text("Đóng")
                } else {
                    form.slideUp()
                    button.text("Tạo bài học")
                }
            })
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/traiit/Desktop/haodev.com/lms_dashboard/resources/views/admin/pages/sections/edit.blade.php ENDPATH**/ ?>