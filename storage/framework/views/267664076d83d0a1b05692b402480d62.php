<?php

use App\Helpers\AssetsHelper;
use Illuminate\Support\Facades\Auth;

?>

<nav class=" bg-white shadow-md w-full mb-3 px-5" style="height: 60px">
    <div class="d-flex align-content-center justify-content-between justify-content-xl-end" style="height: 100%">
        <div href="#" class="burger-btn d-flex align-items-center d-xl-none">
            <i class="bi bi-justify fs-3 d-block"></i>
        </div>
        <div class="d-flex align-items-center">
            <div class="d-flex align-items-center pointer" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="avatar bg-warning me-2 avatar-md">
                    <img
                        src="<?php echo e(Auth::guard('admin')->user()->avatar ??AssetsHelper::assetKiaalap('images/faces/1.jpg')); ?>"
                        alt="" srcset="">
                </div>
                <p class="mb-0">
                    <?php echo e(Auth::guard('admin')->user()->username); ?>

                </p>
                <i class="bi bi-chevron-down ms-2"></i>
            </div>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item flex align-items-center" href="#">
                        <i class="bi bi-person me-2 icon-font"></i>
                        <span>
                            Trang cá nhân
                       </span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="<?php echo e(route('admin.logout')); ?>">
                        <i class=" bi bi-box-arrow-right me-2 icon-font"></i>
                        <span>
                            Logout
                      </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH /Users/traiit/Desktop/haodev.com/lms_dashboard/resources/views/admin/blocks/header.blade.php ENDPATH**/ ?>