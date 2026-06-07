<?php
session_start();
include('admin/includes/dbconnection.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services | IFSC Code Finder Portal</title>
    <?php include_once('includes/public-header.php'); ?>
</head>

<body class="bg-slate-50 font-sans text-slate-900 antialiased selection:bg-primary-500/30">

    <!-- Page Header -->
    <section class="pt-40 pb-20 relative overflow-hidden bg-white">
        <div class="absolute top-0 right-0 w-full h-full pointer-events-none">
            <div class="absolute top-[-10%] left-[-5%] w-[40%] h-[40%] bg-blue-500/5 rounded-full blur-[100px]"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center space-y-6">
            <h1 class="text-5xl lg:text-6xl font-black tracking-tighter animate__animated animate__fadeInDown">Our <span class="text-primary-600">Services</span></h1>
            <p class="text-lg text-slate-500 font-medium max-w-2xl mx-auto animate__animated animate__fadeInUp">
                Powerful tools and accurate data to streamline your banking operations and personal transactions.
            </p>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-24 relative">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- Service 1 -->
                <div class="glass-card p-12 rounded-[3.5rem] relative overflow-hidden group hover:bg-white transition-premium">
                    <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-primary-500/5 rounded-full blur-3xl group-hover:bg-primary-500/10 transition-premium"></div>
                    <div class="relative z-10 space-y-8">
                        <div class="w-20 h-20 bg-primary-50 text-primary-600 rounded-3xl flex items-center justify-center shadow-inner group-hover:bg-primary-600 group-hover:text-white transition-premium">
                            <i data-lucide="search" class="w-10 h-10"></i>
                        </div>
                        <h3 class="text-3xl font-black tracking-tight">IFSC Code Lookup</h3>
                        <p class="text-slate-500 font-medium leading-relaxed">
                            Instantly find the Indian Financial System Code (IFSC) for any bank branch in India. Essential for NEFT, RTGS, and IMPS transactions.
                        </p>
                        <ul class="space-y-4 pt-4">
                            <li class="flex items-center gap-3 text-sm font-bold text-slate-700">
                                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-500"></i>
                                Real-time database updates
                            </li>
                            <li class="flex items-center gap-3 text-sm font-bold text-slate-700">
                                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-500"></i>
                                Accurate branch addresses
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="glass-card p-12 rounded-[3.5rem] relative overflow-hidden group hover:bg-white transition-premium">
                    <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-blue-500/5 rounded-full blur-3xl group-hover:bg-blue-500/10 transition-premium"></div>
                    <div class="relative z-10 space-y-8">
                        <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-3xl flex items-center justify-center shadow-inner group-hover:bg-blue-600 group-hover:text-white transition-premium">
                            <i data-lucide="barcode" class="w-10 h-10"></i>
                        </div>
                        <h3 class="text-3xl font-black tracking-tight">MICR Data Access</h3>
                        <p class="text-slate-500 font-medium leading-relaxed">
                            Retrieve Magnetic Ink Character Recognition (MICR) codes for cheque processing and automated clearing house operations.
                        </p>
                        <ul class="space-y-4 pt-4">
                            <li class="flex items-center gap-3 text-sm font-bold text-slate-700">
                                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-500"></i>
                                Validated for cheque printing
                            </li>
                            <li class="flex items-center gap-3 text-sm font-bold text-slate-700">
                                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-500"></i>
                                Comprehensive coverage
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="glass-card p-12 rounded-[3.5rem] relative overflow-hidden group hover:bg-white transition-premium">
                    <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl group-hover:bg-emerald-500/10 transition-premium"></div>
                    <div class="relative z-10 space-y-8">
                        <div class="w-20 h-20 bg-emerald-50 text-emerald-600 rounded-3xl flex items-center justify-center shadow-inner group-hover:bg-emerald-600 group-hover:text-white transition-premium">
                            <i data-lucide="map-pin" class="w-10 h-10"></i>
                        </div>
                        <h3 class="text-3xl font-black tracking-tight">Branch Locating</h3>
                        <p class="text-slate-500 font-medium leading-relaxed">
                            Discover bank branches in your vicinity or any specific city across India with detailed contact information and map pointers.
                        </p>
                        <ul class="space-y-4 pt-4">
                            <li class="flex items-center gap-3 text-sm font-bold text-slate-700">
                                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-500"></i>
                                Search by Pin Code
                            </li>
                            <li class="flex items-center gap-3 text-sm font-bold text-slate-700">
                                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-500"></i>
                                Detailed Contact Numbers
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Service 4 -->
                <div class="glass-card p-12 rounded-[3.5rem] relative overflow-hidden group hover:bg-white transition-premium">
                    <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-purple-500/5 rounded-full blur-3xl group-hover:bg-purple-500/10 transition-premium"></div>
                    <div class="relative z-10 space-y-8">
                        <div class="w-20 h-20 bg-purple-50 text-purple-600 rounded-3xl flex items-center justify-center shadow-inner group-hover:bg-purple-600 group-hover:text-white transition-premium">
                            <i data-lucide="database" class="w-10 h-10"></i>
                        </div>
                        <h3 class="text-3xl font-black tracking-tight">Bulk Data API</h3>
                        <p class="text-slate-500 font-medium leading-relaxed">
                            Developer-friendly access to our banking database. Integrate our reliable IFSC and MICR data directly into your applications.
                        </p>
                        <ul class="space-y-4 pt-4">
                            <li class="flex items-center gap-3 text-sm font-bold text-slate-700">
                                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-500"></i>
                                Enterprise-grade reliability
                            </li>
                            <li class="flex items-center gap-3 text-sm font-bold text-slate-700">
                                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-500"></i>
                                Easy JSON integration
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-32">
        <div class="container mx-auto px-6">
            <div class="bg-slate-900 rounded-[4rem] p-12 lg:p-24 text-center relative overflow-hidden group">
                <div class="absolute inset-0 bg-primary-600/10 opacity-0 group-hover:opacity-100 transition-premium"></div>
                <div class="relative z-10 space-y-10">
                    <h2 class="text-4xl lg:text-6xl font-black text-white tracking-tighter">Ready to experience <span class="text-primary-400">Smart Search?</span></h2>
                    <p class="text-slate-400 text-xl font-medium max-w-2xl mx-auto">
                        Join thousands of users who trust IFSC Finder for their daily banking information needs.
                    </p>
                    <div class="flex justify-center">
                        <a href="index.php" class="px-12 py-6 bg-primary-600 text-white rounded-[2rem] font-black uppercase tracking-widest text-sm hover:bg-primary-700 transition-premium shadow-2xl shadow-primary-500/20 active:scale-95">Start Searching Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include_once('includes/public-footer.php'); ?>

</body>

</html>
