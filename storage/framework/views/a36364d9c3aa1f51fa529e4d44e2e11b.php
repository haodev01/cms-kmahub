<?php use App\Helpers\AssetsHelper; ?>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(AssetsHelper::assetKiaalap('css/bootstrap.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(AssetsHelper::assetKiaalap('vendors/iconly/bold.css')); ?>">

    <link rel="stylesheet"
          href="<?php echo e(AssetsHelper::assetKiaalap('vendors/perfect-scrollbar/perfect-scrollbar.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(AssetsHelper::assetKiaalap('vendors/bootstrap-icons/bootstrap-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(AssetsHelper::assetKiaalap('css/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(AssetsHelper::assetAdmin('css/custom.css')); ?>">
    <link rel="shortcut icon" href="<?php echo e(AssetsHelper::assetKiaalap('images/favicon.svg')); ?>" type="image/x-icon">
    <script src="<?php echo e(AssetsHelper::assetKiaalap('vendors/jquery/jquery.min.js')); ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
    <link type="text/css" rel="stylesheet" href="<?php echo e(AssetsHelper::assetAdmin('css/image-uploader.min.css')); ?>">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>


<body>
<div id="app">
    <?php echo $__env->make('admin.blocks.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div id="main">
        <?php echo $__env->make('admin.blocks.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="page-content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>

    </div>
</div>
<script src="<?php echo e(AssetsHelper::assetAdmin('js/check-all.js')); ?>"></script>
<script src="<?php echo e(AssetsHelper::assetKiaalap('vendors/perfect-scrollbar/perfect-scrollbar.min.js')); ?>"></script>
<script src="<?php echo e(AssetsHelper::assetKiaalap('js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(AssetsHelper::assetAdmin('js/fetcher.js')); ?>"></script>
<script src="<?php echo e(AssetsHelper::assetAdmin('js/main.js')); ?>"></script>
<script src="<?php echo e(AssetsHelper::assetKiaalap('js/main.js')); ?>"></script>
<script src="<?php echo e(AssetsHelper::assetAdmin('js/image-uploader.min.js')); ?>"></script>
<?php echo $__env->yieldContent('scripts'); ?>
</body>

</html>
<?php /**PATH /Users/traiit/Desktop/haodev.com/lms_dashboard/resources/views/admin/layouts/auth.blade.php ENDPATH**/ ?>