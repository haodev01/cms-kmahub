<?php

use App\Helpers\AssetsHelper;

?>



<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 ">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb breadcrumb-left">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Bài học</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex align-items-center justify-content-between my-3 mt-5">
        <h3>Danh sách bài học</h3>
        <a href="<?php echo e(route('lessons.create')); ?>" class="btn btn-primary ">
            Tạo mới
        </a>
    </div>
    <div class="card">
        <form id="formDeleteAll" action="<?php echo e(route('destroyMany')); ?>" method="POST" class="card-body">
            <div style="height: 40px">
                <button class="btn btn-danger btn-delete-all col-2 mb-2" style="display: none" type="button"
                        data-bs-target="#modalDeleteAll"
                        data-bs-toggle="modal">
                    Xóa tất cả
                </button>
            </div>
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <div class="table-responsive">
                <table class="table table-responsive-md">
                    <thead>
                    <tr>
                        <th style="width:50px;">
                            <div class="custom-control custom-checkbox checkbox-danger check-lg mr-3">
                                <input type="checkbox" class="custom-control-input" id="checkAll">
                                <label class="custom-control-label" for="checkAll"></label>
                            </div>
                        </th>
                        <th>
                            <strong>ID</strong>
                        </th>
                        <th>
                            <strong>Tên danh mục</strong>
                        </th>
                        <th><strong>Mô tả</strong></th>
                        <th><strong>Ngày tạo</strong></th>
                        <th><strong>Trạng thái</strong></th>
                        <th>
                            <strong>Hành động</strong>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(count($lessons) === 0): ?>
                        <tr>
                            <td colspan="7" class="text-center">
                                <h3 class="py-5">
                                    Không tìm thấy kết quả
                                </h3>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox checkbox-danger check-lg mr-3">
                                    <input name="ids[]" type="checkbox" value="<?php echo e($section->id); ?>"
                                           class="custom-control-input custom-control-input-categories"
                                           id="customCheckBox<?php echo e($section->id); ?>"
                                    >
                                    <label class="custom-control-label"
                                           for="customCheckBox<?php echo e($section->id); ?>"></label>
                                </div>
                            </td>
                            <td><?php echo e($section->id); ?></td>
                            <td>
                                <div class="d-flex align-items-center"><img
                                        src="<?php echo e($section->image ?? AssetsHelper::assetKiaalap('images/avatar/3.jpg')); ?>"
                                        class="rounded-lg mr-2" width="24" alt="">
                                    <span class="w-space-no">
                                                <?php echo e($section->name); ?>

                                            </span></div>
                            </td>
                            <td>
                                <span><?php echo e($section->description); ?></span>
                            </td>
                            <td>
                                <span><?php echo e(date('d-m-y', strtotime($section->created_at))); ?></span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-1 ">
                                    <i class="fa fa-circle <?php echo e($section->status ? 'text-success' : 'text-warning'); ?> mr-1"></i>
                                    <span><?php echo e($section->status ? 'Đang hoạt động' : 'Khóa'); ?></span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="<?php echo e(route('course-categories.edit', $section->id)); ?>"
                                       class="btn btn-primary shadow btn-xs sharp "><i
                                            class="fa fa-pencil"></i></a>
                                    <button data-bs-target="#modalDelete" data-bs-toggle="modal" type="button"
                                            data-id="<?php echo e($section->id); ?>"
                                            class="btn btn-danger shadow btn-xs sharp"><i
                                            class="fa fa-trash"></i></button>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
            </div>
            <div>
                <?php echo e($lessons->withQueryString()->links('vendor.pagination.bootstrap-5')); ?>

            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/traiit/Desktop/haodev.com/lms_dashboard/resources/views/admin/pages/lessons/index.blade.php ENDPATH**/ ?>