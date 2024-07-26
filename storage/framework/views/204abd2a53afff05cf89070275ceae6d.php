<?php $__env->startSection('content'); ?>
    <div class="">
        <div class="flex-between mb-5">
            <h5 class="mb-0">Tạo danh mục</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item font-semibold"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item font-semibold"><a href="<?php echo e(route('course-categories.index')); ?>">Danh
                            mục</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tạo danh mục</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="col-8">
                <form action="<?php echo e(route('course-categories.store')); ?>" method="POST" class="card-body">
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
                        <label for="name" class="form-label">Tên danh mục</label>
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
                        <label for="parents" class="form-label">Danh mục cha</label>
                        <select value="<?php echo e(old("parent_id")); ?>" name="parent_id"
                                class="form-select"
                                style="width: 100%"
                        >
                            <option value="">
                                Chọn danh mục cha
                            </option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    <?php echo e(old('parent_id') == $category->id ? 'selected' : ''); ?> value="<?php echo e($category->id); ?>">
                                    <?php echo e($category->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/traiit/Desktop/haodev.com/lms_dashboard/resources/views/admin/pages/categories/create.blade.php ENDPATH**/ ?>