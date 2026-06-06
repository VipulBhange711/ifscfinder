<?php
// Modern Layout Top Helper
?>
<html lang="en" class="scroll-smooth">
<head>
    <title><?php echo $pageTitle; ?> || IFSC Finder</title>
    <?php include_once('includes/modern-head.php');?>
</head>

<body class="bg-slate-50 dark:bg-slate-950 font-sans text-slate-900 dark:text-slate-100 antialiased selection:bg-primary-500/30 selection:text-primary-900">
    <!-- Global Decorative Elements -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none z-[-1] overflow-hidden opacity-20 dark:opacity-10">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-primary-500 rounded-full blur-[120px]"></div>
        <div class="absolute top-[40%] -right-[10%] w-[30%] h-[30%] bg-blue-500 rounded-full blur-[100px]"></div>
        <div class="absolute -bottom-[10%] left-[20%] w-[35%] h-[35%] bg-purple-500 rounded-full blur-[110px]"></div>
    </div>

    <?php include_once('includes/modern-sidebar.php');?>
    <?php include_once('includes/modern-topbar.php');?>

    <div class="p-4 sm:ml-72 mt-20 transition-premium">
        <div class="p-4 rounded-3xl animate__animated animate__fadeIn">
            <!-- Breadcrumbs -->
            <nav class="flex mb-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="dashboard.php" class="text-sm font-medium text-slate-700 hover:text-primary-600 dark:text-slate-400 dark:hover:text-white flex items-center">
                            <i data-lucide="home" class="w-4 h-4 mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                            <span class="ml-1 text-sm font-medium text-slate-500 md:ml-2 dark:text-slate-500"><?php echo $pageTitle; ?></span>
                        </div>
                    </li>
                </ol>
            </nav>

            <h1 class="text-3xl font-extrabold mb-8 tracking-tight"><?php echo $pageTitle; ?></h1>
