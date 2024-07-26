<?php

use App\Helpers\ConstantsHelper;
use  App\Helpers\AssetsHelper;

?>


<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 d-flex align-items-center justify-content-between ">
        <h5 class="m-0">Danh sách khóa học</h5>
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb m-0 ">
                <li class="breadcrumb-item font-semibold"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Khóa học</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex align-items-center justify-content-between my-3 mt-5">
        <form id="form-search" action="<?php echo e(route('courses.index')); ?>" method="GET">
            <input value="<?php echo e(request()->get('keyword')); ?>" name="keyword" type="text" id="search" class="form-control"
                   placeholder="Tìm kiếm ...">
        </form>
        <a href="<?php echo e(route('courses.create')); ?>" class="btn btn-primary icon icon-left ">
            <i class="fa fa-plus font-bold "></i>
            Tạo mới
        </a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="position-relative flex-end h-alert">
                <div
                    class="alert alert-secondary  flex-between position-absolute w-100 h-alert "
                    id="button-delete-all" style="display: none;">
                    <span class="title-checkbox-selected">13 row selected</span>
                    <div id="button-action-delete-all" data-action="<?php echo e(route('courses.destroyMany')); ?>">
                        <i class="fa fa-trash text-danger pointer icon-font"></i>
                    </div>
                </div>
                <form action="<?php echo e(url()->full()); ?>" class="mb-3 flex-end gap-3" id="button-filter" method="GET">
                    <select class="form-select select-filter" name="level" style="min-width: 150px">
                        <option value="">
                            Tất cả mức độ
                        </option>
                        <?php $__currentLoopData = ConstantsHelper::LIST_LEVEL; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                value="<?php echo e($value['key']); ?>" <?php echo e(request('level') == $value['key'] ? 'selected' : ''); ?>>
                                <?php echo e($value['text']); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <select class="form-select select-filter" name="created_by_id"
                            style="min-width: 150px">
                        <option value="">Tất cả người tạo</option>
                        <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                value="<?php echo e($admin->id); ?>" <?php echo e(request('created_by_id') == $admin->id ? 'selected' : ''); ?>>
                                <?php echo e($admin->username); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <select class="form-select select-filter " style="min-width: 200px"
                            name="status">
                        <option value="">Tất cả trạng thái</option>
                        <?php $__currentLoopData = ConstantsHelper::LIST_STATUS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                <?php echo e(request('status') == $value['key'] ? 'selected' : ''); ?> value="<?php echo e($value['key']); ?>">
                                <?php echo e($value['text']); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-responsive-md table-bordered table-hover">
                    <thead>
                    <tr>
                        <th style="width:50px;">
                            <div class="custom-control custom-checkbox checkbox-danger check-lg mr-3">
                                <input type="checkbox" class="custom-control-input input-checkbox-all">
                            </div>
                        </th>
                        <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('id', 'ID'));?></th>
                        <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('name', 'Tên danh mục'));?></th>
                        <th> <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('description', 'Danh mục'));?></th>
                        <th> <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('level', 'Mức độ'));?></th>
                        <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('status', 'Trạng thái'));?></th>
                        <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('price_original', 'Giá'));?></th>
                        <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('created_by_id', 'Người tạo'));?></th>
                        <th><strong>Hành động</strong></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(count($courses) === 0): ?>
                        <tr>
                            <td colspan="7" class="text-center">
                                <h3 class="py-5">
                                    Không tìm thấy kết quả
                                </h3>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox checkbox-danger check-lg mr-3">
                                    <input type="checkbox" value="<?php echo e($course->id); ?>"
                                           class="custom-control-input input-checkbox"
                                    >
                                </div>
                            </td>
                            <td><?php echo e($course->id); ?></td>
                            <td style="max-width: 100px">
                                <div class="d-flex align-items-start">
                                    <span class="w-space-no t-ellipsis-1">
                                            <?php echo e($course->name); ?>

                                        </span></div>
                            </td>
                            <td>
                                <span class="t-ellipsis-1">
                                    <?php if(isset($course->category)): ?>
                                        <?php echo e($course->category->name); ?>

                                    <?php endif; ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge <?php echo e(ConstantsHelper::LEVEL_COLOR[$course->level]); ?>">
                                    <?php echo e(ConstantsHelper::LEVEL[$course->level]); ?>

                                </span>
                            </td>

                            <td>
                                <div class="d-flex align-items-center gap-1 ">
                                    <i class="fa fa-circle <?php echo e(ConstantsHelper::STATUS_COLOR[$course->status]); ?>  mr-1"></i>
                                    <span><?php echo e(ConstantsHelper::STATUS[$course->status]); ?></span>
                                </div>
                            </td>
                            <td>
                                <span>
                                    <?php echo e(number_format((int)$course->price_original,0, '', '.')); ?>đ
                                </span>
                            </td>
                            <td>
                                <span>
                                    <?php echo e($course->createdBy->username); ?>

                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="<?php echo e(route('courses.edit', $course->id)); ?>"
                                       class="btn btn-primary shadow btn-xs sharp "><i
                                            class="fa fa-pencil"></i></a>
                                    <a href="<?php echo e(route('courses.update-content', $course->id)); ?>"
                                       class="btn btn-secondary shadow btn-xs sharp "><i
                                            class="fa-regular fa-file"></i></a>
                                    <button type="button" class="btn btn-danger shadow btn-xs sharp single-delete"
                                            data-action="<?php echo e(route('courses.destroy', $course->id)); ?>"
                                    >
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
            </div>
            <?php echo $courses->appends(Request::except('page'))->render('vendor.pagination.bootstrap-5'); ?>

            <div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(AssetsHelper::assetAdmin('js/single-table.js')); ?>"></script>
    <script>

        $(document).ready(function () {
            $('#form-search').submit(function (e) {
                e.preventDefault();
                const keyword = $('#search').val();
                replaceUrl('keyword', keyword)
            })
            $('#select-status').change(function () {
                let status = $(this).val();
                replaceUrl('status', status)
            })
            $('#select-level').change(function () {
                let level = $(this).val();
                replaceUrl('level', level)
            })
            $('#select-creator').change(function () {
                let level = $(this).val();
                replaceUrl('created_by_id', level)
            })
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/traiit/Desktop/kmahub.com/cms-kmahub/resources/views/admin/pages/courses/index.blade.php ENDPATH**/ ?>