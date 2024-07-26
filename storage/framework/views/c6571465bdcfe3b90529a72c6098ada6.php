<?php

use App\Helpers\AssetsHelper;

?>


<?php $__env->startSection('content'); ?>
    <div>
        <div class="flex-between mb-5">
            <h5 class="mb-0">
                Sửa danh mục
            </h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-left">
                    <li class="breadcrumb-item font-semibold"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item font-semibold"><a href="<?php echo e(route('course-categories.index')); ?>">Danh
                            mục</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Sửa danh mục</li>
                </ol>
            </nav>
        </div>
        <div class="card ">
            <div class=" card-body">

                <form action="<?php echo e(route('course-categories.update', $category->id)); ?>" method="POST">
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
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên danh mục</label>
                        <input name="name" type="text" class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                               id="name" value="<?php echo e(old("name", $category->name)); ?>">
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
                               value="<?php echo e(old("description", $category->description)); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="parents" class="form-label">Danh mục cha</label>
                        <select value="<?php echo e(old("parent_id", $category->parent_id)); ?>" name="parent_id"
                                class="form-select"
                                style="width: 100%"
                        >
                            <option value="">
                                Chọn danh mục cha
                            </option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    <?php echo e(old('parent_id', $category->parent_id) == $cate->id ? 'selected' : ''); ?> value="<?php echo e($cate->id); ?>">
                                    <?php echo e($cate->name); ?>

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

                    <div class="mt-5">
                        <button class="btn btn-primary" type="submit">
                            Sửa danh mục
                        </button>
                        <a class="btn btn-danger" type="submit" href="<?php echo e(route('course-categories.index')); ?>">
                            Hủy
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/traiit/Desktop/haodev.com/lms_dashboard/resources/views/admin/pages/categories/edit.blade.php ENDPATH**/ ?>