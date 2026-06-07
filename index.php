<?php
session_start();
include('admin/includes/dbconnection.php');
?>
<!doctype html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IFSC Code Finder Portal | Smart Banking Solutions</title>
    <?php include_once('includes/public-header.php'); ?>
</head>

<body class="bg-slate-50 font-sans text-slate-900 antialiased selection:bg-primary-500/30">

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center pt-20 overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none z-0">
            <div class="absolute top-[-10%] right-[-5%] w-[50%] h-[50%] bg-primary-500/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[-10%] left-[-5%] w-[40%] h-[40%] bg-blue-500/10 rounded-full blur-[120px]"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-10">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-50 text-primary-600 rounded-full text-xs font-black uppercase tracking-widest animate__animated animate__fadeInDown">
                        <i data-lucide="sparkles" class="w-4 h-4"></i>
                        Next Gen Banking Registry
                    </div>
                    <h1 class="text-6xl lg:text-7xl font-black tracking-tighter leading-[1.1] animate__animated animate__fadeInLeft">
                        Find any <span class="text-primary-600">Bank Detail</span> in seconds.
                    </h1>
                    <p class="text-lg text-slate-500 font-medium leading-relaxed max-w-xl animate__animated animate__fadeInLeft" style="animation-delay: 0.2s">
                        Access the most comprehensive database of IFSC and MICR codes. Fast, accurate, and completely free for all your transaction needs.
                    </p>
                    
                    <!-- Modern Search Box -->
                    <div class="max-w-2xl animate__animated animate__fadeInUp" style="animation-delay: 0.4s">
                        <form action="search.php" method="post" class="relative group">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-6 pointer-events-none text-slate-400 group-focus-within:text-primary-600 transition-colors">
                                <i data-lucide="search" class="w-6 h-6"></i>
                            </div>
                            <input type="text" name="searchifsccode" required
                                   class="w-full bg-white border-none text-slate-900 text-lg rounded-[2.5rem] pl-16 pr-44 py-7 shadow-2xl shadow-slate-200 focus:ring-4 focus:ring-primary-100 transition-premium placeholder:text-slate-400"
                                   placeholder="Bank Name, Zipcode, or Branch...">
                            <button type="submit" name="search"
                                    class="absolute right-3 top-3 bottom-3 px-10 bg-primary-600 text-white rounded-[2rem] font-black uppercase tracking-widest text-sm hover:bg-primary-700 transition-premium shadow-xl shadow-primary-500/25 active:scale-95">
                                Search
                            </button>
                        </form>
                        <div class="flex gap-4 mt-6 ml-6">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Popular:</span>
                            <a href="#" class="text-[10px] font-bold text-slate-500 hover:text-primary-600 transition-colors uppercase tracking-widest">SBI</a>
                            <a href="#" class="text-[10px] font-bold text-slate-500 hover:text-primary-600 transition-colors uppercase tracking-widest">HDFC</a>
                            <a href="#" class="text-[10px] font-bold text-slate-500 hover:text-primary-600 transition-colors uppercase tracking-widest">ICICI</a>
                        </div>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="relative lg:block animate__animated animate__fadeInRight">
                    <div class="absolute inset-0 bg-gradient-to-tr from-primary-500/20 to-transparent rounded-[3rem] blur-3xl -rotate-6"></div>
                    <div class="relative glass p-6 rounded-[3.5rem] shadow-3xl">
                        <img src="https://images.unsplash.com/photo-1501167786227-4cba60f6d58f?auto=format&fit=crop&q=80&w=800" 
                             class="rounded-[3rem] w-full h-[600px] object-cover shadow-2xl animate-float" 
                             alt="Modern Banking">
                    </div>
                    <!-- Stats Card Overlays -->
                    <div class="absolute -left-10 top-1/4 glass p-6 rounded-3xl shadow-2xl animate__animated animate__bounceIn" style="animation-delay: 0.8s">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-500/20">
                                <i data-lucide="check-circle-2"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-black">100%</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Data Accuracy</p>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -right-10 bottom-1/4 glass p-6 rounded-3xl shadow-2xl animate__animated animate__bounceIn" style="animation-delay: 1s">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                                <i data-lucide="zap"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-black">Instant</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Search Results</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Grid -->
    <section class="py-32 bg-white relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-20 space-y-6">
                <h2 class="text-4xl lg:text-5xl font-black tracking-tight">Everything you need for <span class="text-primary-600">Secure Transactions</span></h2>
                <p class="text-lg text-slate-500 font-medium leading-relaxed">
                    Our platform provides a seamless experience for finding critical banking information across all Indian states and cities.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="group p-10 rounded-[3rem] bg-slate-50 border border-transparent hover:border-primary-100 hover:bg-white hover:shadow-2xl hover:shadow-primary-500/5 transition-premium">
                    <div class="w-16 h-16 bg-white rounded-[2rem] flex items-center justify-center text-primary-600 shadow-xl shadow-slate-200 mb-8 group-hover:bg-primary-600 group-hover:text-white transition-premium">
                        <i data-lucide="search" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-2xl font-black mb-4 tracking-tight">Universal Search</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">
                        Search by bank name, branch, city, or zip code. Our intelligent search engine understands your needs.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="group p-10 rounded-[3rem] bg-slate-50 border border-transparent hover:border-primary-100 hover:bg-white hover:shadow-2xl hover:shadow-primary-500/5 transition-premium">
                    <div class="w-16 h-16 bg-white rounded-[2rem] flex items-center justify-center text-primary-600 shadow-xl shadow-slate-200 mb-8 group-hover:bg-primary-600 group-hover:text-white transition-premium">
                        <i data-lucide="shield-check" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-2xl font-black mb-4 tracking-tight">Verified Data</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">
                        All IFSC and MICR codes are verified and synchronized with the latest central bank registries.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="group p-10 rounded-[3rem] bg-slate-50 border border-transparent hover:border-primary-100 hover:bg-white hover:shadow-2xl hover:shadow-primary-500/5 transition-premium">
                    <div class="w-16 h-16 bg-white rounded-[2rem] flex items-center justify-center text-primary-600 shadow-xl shadow-slate-200 mb-8 group-hover:bg-primary-600 group-hover:text-white transition-premium">
                        <i data-lucide="smartphone" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-2xl font-black mb-4 tracking-tight">Mobile Ready</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">
                        Find bank details on the go. Our platform is fully optimized for mobile devices and tablets.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- App Preview / Image Section -->
    <section class="py-32 relative overflow-hidden bg-slate-50">
        <div class="container mx-auto px-6">
            <div class="bg-primary-600 rounded-[4rem] p-12 lg:p-24 relative overflow-hidden group">
                <!-- Abstract Decorations -->
                <div class="absolute top-0 right-0 w-full h-full pointer-events-none">
                    <div class="absolute top-[-20%] right-[-10%] w-[50%] h-[80%] bg-white/10 rounded-full blur-[120px]"></div>
                    <div class="absolute bottom-[-20%] left-[-10%] w-[50%] h-[80%] bg-blue-400/20 rounded-full blur-[120px]"></div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center relative z-10">
                    <div class="space-y-8 text-white">
                        <h2 class="text-4xl lg:text-5xl font-black tracking-tight leading-tight">Simplify your <span class="text-blue-200">Financial Workflow</span> today.</h2>
                        <p class="text-lg text-primary-100 font-medium leading-relaxed opacity-90">
                            Stop wasting time searching through outdated PDFs. Use our modern interface to find exactly what you need in milliseconds.
                        </p>
                        <div class="flex flex-wrap gap-6 pt-4">
                            <a href="about.php" class="px-10 py-5 bg-white text-primary-600 rounded-[2rem] font-black uppercase tracking-widest text-sm hover:bg-primary-50 transition-premium shadow-2xl active:scale-95">Learn More</a>
                            <a href="admin/login.php" class="px-10 py-5 bg-primary-700 text-white border border-white/20 rounded-[2rem] font-black uppercase tracking-widest text-sm hover:bg-primary-800 transition-premium active:scale-95">Admin Access</a>
                        </div>
                    </div>
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&q=80&w=800" 
                             class="rounded-[3rem] shadow-3xl scale-110 group-hover:scale-105 transition-premium duration-700" 
                             alt="Digital Banking">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include_once('includes/public-footer.php'); ?>

</body>

</html>
