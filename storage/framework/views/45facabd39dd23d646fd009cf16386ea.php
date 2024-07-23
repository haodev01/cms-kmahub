<?php $__env->startSection('content'); ?>
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-left">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('lessons.index')); ?>">Bài học</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tạo bài học</li>
            </ol>
        </nav>
        <div class="card">
            <div class="col-8">
                <form action="<?php echo e(route('lessons.store')); ?>" method="POST" class="card-body">
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
                        <select value="<?php echo e(old("lesson_id")); ?>" name="lesson_id" id="single-select"
                                class="js-example-basic-multiple"
                                style="width: 100%"
                        >
                            <option value="">
                                Chọn chương học
                            </option>
                            <?php $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    <?php echo e(old('parent_id') == $lesson->id ? 'selected' : ''); ?> value="<?php echo e($lesson->id); ?>">
                                    <?php echo e($lesson->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                        </select>
                    </div>
                    <div class="custom-control custom-checkbox checkbox-success check-sm mr-3">
                        <input type="checkbox" class="custom-control-input" id="status" name="status">
                        <label class="custom-control-label" for="status">Hoạt động</label>
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

<?php echo $__env->make('admin.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/traiit/Desktop/haodev.com/lms_dashboard/resources/views/admin/pages/lessons/create.blade.php ENDPATH**/ ?>