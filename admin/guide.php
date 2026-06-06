<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ifscaid']==0)) {
    header('location:logout.php');
} else {
    $pageTitle = "User Guide";
    include_once('includes/modern-layout-top.php');
?>

<!-- Interactive Guide Dashboard -->
<div class="row">
    <div class="col-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Main Content Area -->
            <div class="lg:col-span-2 space-y-10">
                <!-- Welcome Section -->
                <section class="glass-card p-10 rounded-[3rem] relative overflow-hidden group">
                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-primary-500/10 rounded-full blur-3xl group-hover:bg-primary-500/20 transition-premium"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-6 mb-8">
                            <div class="p-5 bg-primary-600 text-white rounded-3xl shadow-xl shadow-primary-500/30">
                                <i data-lucide="sparkles" class="w-8 h-8"></i>
                            </div>
                            <div>
                                <h2 class="text-3xl font-black tracking-tighter mb-1">Master the Portal</h2>
                                <p class="text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest text-[10px]">Your comprehensive administration guide</p>
                            </div>
                        </div>
                        <p class="text-slate-600 dark:text-slate-300 leading-relaxed mb-8">
                            Welcome to the next generation of IFSC Finder. This dashboard has been engineered for high-performance data management. Follow the structured steps below to populate your database with production-grade bank information.
                        </p>
                        
                        <!-- Interactive Checklist -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-5 rounded-3xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 flex items-center gap-4 group/item hover:bg-white dark:hover:bg-slate-800 transition-premium cursor-pointer">
                                <div class="w-10 h-10 rounded-2xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 flex items-center justify-center font-black shadow-inner">1</div>
                                <span class="font-bold text-sm text-slate-700 dark:text-slate-300">Register Base Banks</span>
                                <i data-lucide="arrow-right" class="w-4 h-4 ml-auto text-slate-300 group-hover/item:translate-x-1 transition-transform"></i>
                            </div>
                            <div class="p-5 rounded-3xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 flex items-center gap-4 group/item hover:bg-white dark:hover:bg-slate-800 transition-premium cursor-pointer">
                                <div class="w-10 h-10 rounded-2xl bg-blue-100 dark:bg-blue-900/30 text-blue-600 flex items-center justify-center font-black shadow-inner">2</div>
                                <span class="font-bold text-sm text-slate-700 dark:text-slate-300">Define Regions (States)</span>
                                <i data-lucide="arrow-right" class="w-4 h-4 ml-auto text-slate-300 group-hover/item:translate-x-1 transition-transform"></i>
                            </div>
                            <div class="p-5 rounded-3xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 flex items-center gap-4 group/item hover:bg-white dark:hover:bg-slate-800 transition-premium cursor-pointer">
                                <div class="w-10 h-10 rounded-2xl bg-purple-100 dark:bg-purple-900/30 text-purple-600 flex items-center justify-center font-black shadow-inner">3</div>
                                <span class="font-bold text-sm text-slate-700 dark:text-slate-300">Map Local Cities</span>
                                <i data-lucide="arrow-right" class="w-4 h-4 ml-auto text-slate-300 group-hover/item:translate-x-1 transition-transform"></i>
                            </div>
                            <div class="p-5 rounded-3xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 flex items-center gap-4 group/item hover:bg-white dark:hover:bg-slate-800 transition-premium cursor-pointer">
                                <div class="w-10 h-10 rounded-2xl bg-amber-100 dark:bg-amber-900/30 text-amber-600 flex items-center justify-center font-black shadow-inner">4</div>
                                <span class="font-bold text-sm text-slate-700 dark:text-slate-300">Sync IFSC Details</span>
                                <i data-lucide="arrow-right" class="w-4 h-4 ml-auto text-slate-300 group-hover/item:translate-x-1 transition-transform"></i>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Video Tutorials Section -->
                <section class="glass-card p-10 rounded-[3rem]">
                    <div class="flex items-center justify-between mb-10">
                        <h3 class="text-2xl font-black tracking-tight">Video Demonstrations</h3>
                        <span class="px-3 py-1 bg-primary-100 dark:bg-primary-900/30 text-primary-600 text-[10px] font-black rounded-full uppercase tracking-widest">New Content</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="group cursor-pointer">
                            <div class="aspect-video bg-slate-200 dark:bg-slate-800 rounded-[2rem] mb-4 relative overflow-hidden flex items-center justify-center">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent opacity-0 group-hover:opacity-100 transition-premium"></div>
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-2xl scale-90 group-hover:scale-100 transition-premium z-10">
                                    <i data-lucide="play" class="w-6 h-6 text-primary-600 fill-current"></i>
                                </div>
                                <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&q=80&w=400" class="absolute inset-0 w-full h-full object-cover opacity-50 mix-blend-overlay" alt="Tutorial">
                            </div>
                            <h4 class="font-black text-slate-900 dark:text-white mb-1 group-hover:text-primary-500 transition-colors">Interface Overview</h4>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">4 min • Admin Dashboard</p>
                        </div>
                        <div class="group cursor-pointer">
                            <div class="aspect-video bg-slate-200 dark:bg-slate-800 rounded-[2rem] mb-4 relative overflow-hidden flex items-center justify-center">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent opacity-0 group-hover:opacity-100 transition-premium"></div>
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-2xl scale-90 group-hover:scale-100 transition-premium z-10">
                                    <i data-lucide="play" class="w-6 h-6 text-primary-600 fill-current"></i>
                                </div>
                                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&q=80&w=400" class="absolute inset-0 w-full h-full object-cover opacity-50 mix-blend-overlay" alt="Tutorial">
                            </div>
                            <h4 class="font-black text-slate-900 dark:text-white mb-1 group-hover:text-primary-500 transition-colors">Data Management</h4>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">6 min • CRUD Operations</p>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Sidebar Info Panel -->
            <div class="space-y-10">
                <!-- Shortcuts Panel -->
                <div class="glass-card p-8 rounded-[2.5rem]">
                    <h3 class="text-lg font-black tracking-tight mb-8 flex items-center">
                        <i data-lucide="command" class="w-5 h-5 mr-3 text-primary-600"></i> Keyboard Ninja
                    </h3>
                    <div class="space-y-6">
                        <div class="flex justify-between items-center group">
                            <span class="text-sm font-bold text-slate-500 group-hover:text-slate-900 dark:group-hover:text-white transition-colors">Command Palette</span>
                            <kbd class="px-3 py-1.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-[10px] font-black shadow-sm">CTRL K</kbd>
                        </div>
                        <div class="flex justify-between items-center group">
                            <span class="text-sm font-bold text-slate-500 group-hover:text-slate-900 dark:group-hover:text-white transition-colors">Quick Help</span>
                            <kbd class="px-3 py-1.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-[10px] font-black shadow-sm">?</kbd>
                        </div>
                        <div class="flex justify-between items-center group">
                            <span class="text-sm font-bold text-slate-500 group-hover:text-slate-900 dark:group-hover:text-white transition-colors">Toggle Sidebar</span>
                            <kbd class="px-3 py-1.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-[10px] font-black shadow-sm">CTRL B</kbd>
                        </div>
                    </div>
                </div>

                <!-- Support Card -->
                <div class="p-8 rounded-[2.5rem] bg-gradient-to-br from-primary-600 to-blue-700 text-white shadow-3xl shadow-primary-500/20 relative overflow-hidden group">
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:scale-125 transition-premium"></div>
                    <div class="relative z-10">
                        <h3 class="text-xl font-black mb-2">Need a Hand?</h3>
                        <p class="text-primary-100 text-sm font-medium leading-relaxed mb-8 opacity-80">Our engineering support team is standing by to help you with data synchronization or system issues.</p>
                        <button class="w-full py-4 bg-white text-primary-600 rounded-2xl font-black text-sm hover:bg-primary-50 transition-premium shadow-xl">Contact Dev Team</button>
                    </div>
                </div>

                <!-- System Requirements -->
                <div class="glass-card p-8 rounded-[2.5rem]">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Compatibility</h3>
                    <div class="flex flex-wrap gap-4">
                        <div class="flex items-center gap-2 p-2 bg-slate-50 dark:bg-slate-800 rounded-xl">
                            <i data-lucide="chrome" class="w-4 h-4 text-slate-400"></i>
                            <span class="text-[10px] font-bold">Chrome 90+</span>
                        </div>
                        <div class="flex items-center gap-2 p-2 bg-slate-50 dark:bg-slate-800 rounded-xl">
                            <i data-lucide="layout" class="w-4 h-4 text-slate-400"></i>
                            <span class="text-[10px] font-bold">Safari 14+</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('includes/modern-layout-bottom.php'); ?>
<?php } ?>
