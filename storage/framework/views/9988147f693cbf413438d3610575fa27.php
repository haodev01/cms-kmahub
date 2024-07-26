<?php use App\Helpers\AssetsHelper;use App\Helpers\NavigationHelper; ?>
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="<?php echo e(route('admin.dashboard')); ?>"><img
                            src="<?php echo e(AssetsHelper::assetKiaalap('images/logo/logo.png')); ?>"
                            alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block">
                        <i class="bi bi-x bi-middle text-white" style="font-size: 20px"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item <?php echo e(NavigationHelper::isActive(['/'])); ?> ">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item  <?php echo e(NavigationHelper::isActive(['course-categories*'])); ?> ">
                    <a href="<?php echo e(route('course-categories.index')); ?>" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Quản lý danh mục</span>
                    </a>
                </li>
                <li class="sidebar-item  <?php echo e(NavigationHelper::isActive(['courses*'])); ?>  ">
                    <a href="<?php echo e(route('courses.index')); ?>" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span> Quản lý khóa học</span>
                    </a>
                </li>
                <li class="sidebar-item  <?php echo e(NavigationHelper::isActive(['sections*'])); ?>  ">
                    <a href="<?php echo e(route('sections.index')); ?>" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Quản lý chương</span>
                    </a>
                </li>
                <li class="sidebar-item  <?php echo e(NavigationHelper::isActive(['lessons*'])); ?>  ">
                    <a href="<?php echo e(route('lessons.index')); ?>" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Quản lý bài học</span>
                    </a>
                </li>
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                

                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                

                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                


            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
<?php /**PATH /Users/traiit/Desktop/kmahub.com/cms-kmahub/resources/views/admin/blocks/sidebar.blade.php ENDPATH**/ ?>