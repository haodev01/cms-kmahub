<?php use App\Helpers\ConstantsHelper; ?>


<?php $__env->startSection('content'); ?>
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-left">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('sections.index')); ?>">Chương học</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tạo chương học</li>
            </ol>
        </nav>
        <?php if(session('success') || session('error')): ?>
            <div class="alert alert-<?php echo e(session('success') ? 'success' : 'danger'); ?> mb-3">
                <?php echo e(session('success') ?: session('error')); ?>

            </div>
        <?php endif; ?>
        <div class="card">
            <div class="col-8">
                <form action="<?php echo e(route('sections.store')); ?>" method="POST" class="card-body">
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
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên chương học</label>
                        <input name="name" type="text" class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                               id="name" value="<?php echo e(old("name")); ?>">
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
                               value="<?php echo e(old("description")); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="parents" class="form-label">Khóa học</label>
                        <select value="<?php echo e(old("course_id")); ?>" name="course_id"
                                class="form-select <?php echo e($errors->has('course_id') ? 'is-invalid' : ''); ?>"
                                style="width: 100%">
                            <option value="">
                                Chọn khóa học
                            </option>
                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    <?php echo e(old('course_id') == $course->id ? 'selected' : ''); ?> value="<?php echo e($course->id); ?>">
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
                                    <?php echo e(old('status') == $key ? 'selected' : ''); ?> value="<?php echo e($key); ?>">
                                    <?php echo e($value['text']); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/traiit/Desktop/haodev.com/lms_dashboard/resources/views/admin/pages/sections/create.blade.php ENDPATH**/ ?>