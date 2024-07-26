<?php

use App\Helpers\AssetsHelper;
use App\Helpers\ConstantsHelper;

?>



<?php $__env->startSection('content'); ?>
    <div class="col-lg-12  ">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="m-0">Danh sách danh mục</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item font-semibold"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Danh mục</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex align-items-center justify-content-between my-3 mt-5">
            <form id="form-search" action="<?php echo e(route('course-categories.index')); ?>" method="GET">
                <input value="<?php echo e(request()->get('keyword')); ?>" name="keyword" type="text" id="search" class="form-control"
                       placeholder="Tìm kiếm ...">
            </form>
            <a href="<?php echo e(route('course-categories.create')); ?>" class="btn btn-primary icon icon-left">
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
                        <div id="button-action-delete-all" data-action="<?php echo e(route('categories.destroyMany')); ?>">
                            <i class="fa fa-trash text-danger pointer icon-font"></i>
                        </div>
                    </div>
                    <div class="flex-end gap-2">
                        <select class="form-select select-filter" name="created_by_id" style="min-width: 200px">
                            <option value="">Người tạo</option>
                            <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    value="<?php echo e($admin->id); ?>" <?php echo e(request('created_by_id') == $admin->id ? 'selected' : ''); ?>>
                                    <?php echo e($admin->username); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <select class="form-select select-filter" name="status" style="min-width: 200px">
                            <option value="">Tất cả trạng thái</option>
                            <?php $__currentLoopData = ConstantsHelper::LIST_STATUS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    <?php echo e(request('status') == $value['key'] ? 'selected' : ''); ?> value="<?php echo e($value['key']); ?>">
                                    <?php echo e($value['text']); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-responsive-md table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width:50px;">
                                <div class="custom-control custom-checkbox checkbox-primary check-lg mr-3">
                                    <input type="checkbox" class="custom-control-input input-checkbox-all"
                                           id="checkAll">
                                    <label class="custom-control-label" for="checkAll"></label>
                                </div>
                            </th>
                            <th>
                                <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('id', 'ID'));?>
                            </th>
                            <th>
                                <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('name', 'Tên danh mục'));?>
                            </th>
                            <th>
                                <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('description', 'Mô tả'));?>
                            </th>
                            <th>
                                <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('created_at', 'Ngày tạo'));?>
                            </th>
                            <th>
                                <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('status', 'Trạng thái'));?>
                            </th>
                            <th>
                                <strong>Hành động</strong>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(count($categories) === 0): ?>
                            <tr>
                                <td colspan="7" class="text-center">
                                    <h3 class="py-5">
                                        Không tìm thấy kết quả
                                    </h3>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox checkbox-primary check-lg mr-3">
                                        <input name="ids[]" type="checkbox" value="<?php echo e($category->id); ?>"
                                               class="custom-control-input input-checkbox"
                                               id="customCheckBox<?php echo e($category->id); ?>"
                                        >
                                        <label class="custom-control-label"
                                               for="customCheckBox<?php echo e($category->id); ?>"></label>
                                    </div>
                                </td>
                                <td><?php echo e($category->id); ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="w-space-no">
                                            <?php echo e($category->name); ?>

                                        </span></div>
                                </td>
                                <td>
                                    <span><?php echo e($category->description); ?></span>
                                </td>
                                <td>
                                    <span><?php echo e(date('d-m-y', strtotime($category->created_at))); ?></span>
                                </td>
                                <td>
                                    <span class=" gap-1 badge <?php echo e(ConstantsHelper::STATUS_COLOR_BG[$category->status]); ?> ">
                                      <?php echo e(ConstantsHelper::STATUS[$category->status]); ?>

                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="<?php echo e(route('course-categories.edit', $category->id)); ?>"
                                           class="btn btn-primary shadow btn-xs sharp "><i
                                                class="fa fa-pencil"></i></a>
                                        <button data-action="<?php echo e(route('course-categories.destroy', $category->id)); ?>"
                                                type="button" class="btn btn-danger shadow btn-xs sharp single-delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div>
                    <?php echo $categories->appends(Request::except('page'))->render('vendor.pagination.bootstrap-5'); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(AssetsHelper::assetAdmin('js/single-table.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/traiit/Desktop/haodev.com/lms_dashboard/resources/views/admin/pages/categories/index.blade.php ENDPATH**/ ?>