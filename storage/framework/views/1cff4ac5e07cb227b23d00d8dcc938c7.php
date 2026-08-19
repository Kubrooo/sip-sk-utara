<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> - SIP-SK Pekalongan Utara</title>

    <!-- Tailwind CSS CDN & Alpine.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar Component -->
        <?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Main Content Area -->
        <main class="flex-1 p-6 md:p-8 lg:p-10 overflow-y-auto">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</body>
</html>
<?php /**PATH D:\sip-sk-utara\resources\views/layouts/app.blade.php ENDPATH**/ ?>