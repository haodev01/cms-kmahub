<?php

use App\Helpers\AssetsHelper;
use App\Helpers\ConstantsHelper;

?>



<?php $__env->startSection('content'); ?>
    <div class="flex-between">
        <h5 class="m-0">Danh sách chương học</h5>
        <nav aria-label="breadcrumb  ">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item font-semibold"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chương học</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex align-items-center justify-content-between my-3 mt-5">
        <form id="form-search" action="<?php echo e(route('sections.index')); ?>" method="GET">
            <input value="<?php echo e(request()->get('keyword')); ?>" name="keyword" type="text" id="search" class="form-control"
                   placeholder="Tìm kiếm ...">
        </form>
        <a href="<?php echo e(route('sections.create')); ?>" class="btn btn-primary icon-left ">
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
                    <div id="button-action-delete-all" data-action="<?php echo e(route('sections.destroyMany')); ?>">
                        <i class="fa fa-trash text-danger pointer icon-font"></i>
                    </div>
                </div>
                <div class="mr-2">
                    <select class="form-select select-filter" style="min-width: 200px" name="course_id">
                        <option value="">Tất cả khóa học</option>
                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                <?php echo e(request('course_id') == $course->id ? 'selected' : ''); ?> value="<?php echo e($course->id); ?>">
                                <?php echo e($course->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class=" ml-2">
                    <select class="form-select select-filter" style="min-width: 200px" name="status">
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
                        <th>
                            <div class="custom-control custom-checkbox checkbox-danger check-lg mr-3">
                                <input type="checkbox" class="input-checkbox-all">
                                <label class="custom-control-label" for="checkAll"></label>
                            </div>
                        </th>
                        <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('id', 'ID'));?></th>
                        <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('name', 'Tên chương học'));?></th>
                        <th>
                            <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('course_id', 'Tên khoá học '));?>
                        </th>

                        <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('created_at', 'Ngày tạo'));?></th>
                        <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('status', 'Trạng thái'));?></th>
                        <th>
                            <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('created_by_id', 'Người tạo'));?>
                        </th>
                        <th>
                            <strong>Hành động</strong>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(count($sections) === 0): ?>
                        <tr>
                            <td colspan="7" class="text-center">
                                <h3 class="py-5">
                                    Không tìm thấy kết quả
                                </h3>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox checkbox-danger check-lg mr-3">
                                    <input type="checkbox" value="<?php echo e($section->id); ?>" class="input-checkbox">
                                </div>
                            </td>
                            <td><?php echo e($section->id); ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="w-space-no"><?php echo e($section->name); ?></span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="w-space-no"><?php echo e($section->course->name); ?></span>
                                </div>
                            </td>
                            <td>
                                <span><?php echo e(date('d-m-y', strtotime($section->created_at))); ?></span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-1 ">
                                    <i class="fa fa-circle <?php echo e(ConstantsHelper::STATUS_COLOR[$section->status]); ?> mr-1"></i>
                                    <span><?php echo e(ConstantsHelper::STATUS[$section->status]); ?></span>
                                </div>
                            </td>
                            <td>
                                <span>
                                    <?php if($section->createdBy): ?>
                                        <?php echo e($section->createdBy->name); ?>

                                    <?php endif; ?>
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="<?php echo e(route('sections.edit', $section->id)); ?>"
                                       class="btn btn-primary shadow btn-xs sharp "><i
                                            class="fa fa-pencil"></i></a>
                                    <button type="button"
                                            data-action="<?php echo e(route('sections.destroy', $section->id)); ?>"
                                            class="btn btn-danger shadow btn-xs sharp single-delete">
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
                <?php echo $sections->appends(Request::except('page'))->render('vendor.pagination.bootstrap-5'); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(AssetsHelper::assetAdmin('js/single-table.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/traiit/Desktop/haodev.com/lms_dashboard/resources/views/admin/pages/sections/index.blade.php ENDPATH**/ ?>