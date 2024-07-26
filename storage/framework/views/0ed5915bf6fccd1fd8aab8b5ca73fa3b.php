<?php use App\Helpers\AssetsHelper; ?>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(AssetsHelper::assetKiaalap('css/bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(AssetsHelper::assetKiaalap('vendors/bootstrap-icons/bootstrap-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(AssetsHelper::assetKiaalap('css/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(AssetsHelper::assetKiaalap('css/pages/auth.css')); ?>">
</head>

<body>
<div id="auth">

    <div class=" h-100 d-flex justify-content-center align-items-center ">
        <div style="max-width: 480px; width: 100%" class="auth-bg">
            <div class="auth-logo">
                <a href="<?php echo e(route('admin.dashboard')); ?>"><img
                        src="<?php echo e(AssetsHelper::assetKiaalap('images/logo/logo.png')); ?>"
                        alt="Logo"></a>
            </div>
            <p class="auth-subtitle mb-5 mt-3 text-center">Trang quản trị hệ thống LMS</p>
            <form action="<?php echo e(route('admin.login')); ?>" method="POST">
                <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="alert alert-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <?php echo csrf_field(); ?>
                <div class="form-group position-relative mb-4">
                    <label for="email" class="mb-1">Email</label>
                    <input value="<?php echo e(old("email")); ?>" name="email" type="text" id="email"
                           class="form-control  <?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>"
                           placeholder="Email...">
                    <?php $__errorArgs = ['email'];
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
                <div class="form-group position-relative mb-3">
                    <label for="password" class="mb-1">Mật khẩu</label>
                    <input id="password" value="<?php echo e(old("password")); ?>" name="password" type="password"
                           class="form-control  <?php echo e($errors->has('password') ? 'is-invalid' : ''); ?>"
                           placeholder="**********">
                    <?php $__errorArgs = ['password'];
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
                <div class="form-check form-check-md d-flex align-items-end">
                    <input class="form-check-input me-2 mb-1" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label text-gray-600" for="flexCheckDefault">
                        Nhớ thiết bị
                    </label>
                </div>
                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-4">Đăng nhập</button>
            </form>
            <a href="<?php echo e($auth_gg_url); ?>" class="btn btn-secondary"> Đăng nhập bằng Google</a>
        </div>
    </div>
</div>
</body>

</html>
<?php /**PATH /Users/traiit/Desktop/haodev.com/lms_dashboard/resources/views/admin/pages/auth/login.blade.php ENDPATH**/ ?>