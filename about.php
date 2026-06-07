<?php
session_start();
include('admin/includes/dbconnection.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | IFSC Code Finder Portal</title>
    <?php include_once('includes/public-header.php'); ?>
</head>

<body class="bg-slate-50 font-sans text-slate-900 antialiased selection:bg-primary-500/30">

    <!-- Page Header -->
    <section class="pt-40 pb-20 relative overflow-hidden bg-white">
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
            <div class="absolute top-[-10%] right-[-5%] w-[40%] h-[40%] bg-primary-500/5 rounded-full blur-[100px]"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center space-y-6">
            <h1 class="text-5xl lg:text-6xl font-black tracking-tighter animate__animated animate__fadeInDown">Our <span class="text-primary-600">Mission</span></h1>
            <p class="text-lg text-slate-500 font-medium max-w-2xl mx-auto animate__animated animate__fadeInUp">
                We are dedicated to providing the most reliable and accessible banking information to millions of users across India.
            </p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-24 relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="relative">
                    <div class="absolute inset-0 bg-primary-500/10 rounded-[3rem] blur-3xl -rotate-6"></div>
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=800" 
                         class="rounded-[3rem] shadow-3xl relative z-10 animate-float" 
                         alt="Team Collaboration">
                </div>
                <div class="space-y-10">
                    <div class="space-y-6">
                        <h2 class="text-4xl font-black tracking-tight leading-tight">Bridging the gap between <span class="text-primary-600">People</span> and <span class="text-primary-600">Banking</span>.</h2>
                        <p class="text-slate-600 font-medium leading-relaxed">
                            Founded in 2024, IFSC Finder Portal started with a simple idea: making complex banking codes easy to find for everyone. Whether you're a business owner making bulk transfers or a student receiving their first scholarship, we ensure you have the right data at your fingertips.
                        </p>
                        <p class="text-slate-600 font-medium leading-relaxed">
                            Our team of developers and data analysts work around the clock to keep our database synchronized with the latest updates from financial institutions.
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-8 pt-6">
                        <div class="p-6 rounded-3xl bg-white shadow-xl shadow-slate-200/50 border border-slate-100">
                            <p class="text-4xl font-black text-primary-600 mb-2">10M+</p>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Monthly Searches</p>
                        </div>
                        <div class="p-6 rounded-3xl bg-white shadow-xl shadow-slate-200/50 border border-slate-100">
                            <p class="text-4xl font-black text-primary-600 mb-2">150K+</p>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Bank Branches</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision Section -->
    <section class="py-24 bg-slate-900 text-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none opacity-20">
            <div class="absolute top-[20%] left-[-10%] w-[40%] h-[60%] bg-primary-500 rounded-full blur-[120px]"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl mx-auto text-center space-y-12">
                <h2 class="text-4xl lg:text-5xl font-black tracking-tight">Our Vision for the <span class="text-primary-400">Future of Finance</span></h2>
                <p class="text-xl text-slate-400 font-medium leading-relaxed italic">
                    "We believe that information is the foundation of financial inclusion. By providing free, accurate banking data, we're helping build a more transparent and efficient financial ecosystem for all of India."
                </p>
                <div class="flex flex-col items-center gap-4">
                    <div class="w-16 h-16 rounded-full bg-primary-600 flex items-center justify-center shadow-xl shadow-primary-500/20">
                        <i data-lucide="quote" class="text-white"></i>
                    </div>
                    <p class="font-black tracking-widest uppercase text-xs">The IFSC Finder Leadership Team</p>
                </div>
            </div>
        </div>
    </section>

    <?php include_once('includes/public-footer.php'); ?>

</body>

</html>
