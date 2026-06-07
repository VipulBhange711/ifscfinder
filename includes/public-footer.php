<footer class="bg-slate-950 text-white pt-24 pb-12 overflow-hidden relative">
    <!-- Decorative Elements -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full pointer-events-none z-0">
        <div class="absolute top-[-20%] left-[-10%] w-[40%] h-[60%] bg-primary-500/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-20%] right-[-10%] w-[40%] h-[60%] bg-blue-500/10 rounded-full blur-[120px]"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-20">
            <!-- Brand -->
            <div class="space-y-6">
                <a href="index.php" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center shadow-lg shadow-primary-500/30">
                        <i data-lucide="building-2" class="text-white w-6 h-6"></i>
                    </div>
                    <span class="text-xl font-black tracking-tighter">IFSC FINDER</span>
                </a>
                <p class="text-slate-400 text-sm leading-relaxed font-medium">
                    The most comprehensive and updated database for finding IFSC and MICR codes across India. Reliable data for all your banking needs.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center hover:bg-primary-600 transition-premium"><i data-lucide="twitter" class="w-4 h-4"></i></a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center hover:bg-primary-600 transition-premium"><i data-lucide="linkedin" class="w-4 h-4"></i></a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center hover:bg-primary-600 transition-premium"><i data-lucide="github" class="w-4 h-4"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-black mb-8 tracking-tight">Quick Navigation</h4>
                <ul class="space-y-4 text-sm font-bold text-slate-400">
                    <li><a href="index.php" class="hover:text-primary-500 transition-colors">Home</a></li>
                    <li><a href="about.php" class="hover:text-primary-500 transition-colors">About Us</a></li>
                    <li><a href="services.php" class="hover:text-primary-500 transition-colors">Services</a></li>
                    <li><a href="admin/login.php" class="hover:text-primary-500 transition-colors">Admin Portal</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div>
                <h4 class="text-lg font-black mb-8 tracking-tight">Our Services</h4>
                <ul class="space-y-4 text-sm font-bold text-slate-400">
                    <li><a href="#" class="hover:text-primary-500 transition-colors">IFSC Code Search</a></li>
                    <li><a href="#" class="hover:text-primary-500 transition-colors">MICR Information</a></li>
                    <li><a href="#" class="hover:text-primary-500 transition-colors">Branch Locating</a></li>
                    <li><a href="#" class="hover:text-primary-500 transition-colors">Bank Data Export</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-lg font-black mb-8 tracking-tight">Get in Touch</h4>
                <ul class="space-y-4 text-sm font-bold text-slate-400">
                    <li class="flex items-center gap-3">
                        <i data-lucide="mail" class="w-4 h-4 text-primary-500"></i>
                        support@ifscfinder.com
                    </li>
                    <li class="flex items-center gap-3">
                        <i data-lucide="phone" class="w-4 h-4 text-primary-500"></i>
                        +91 1800-IFSC-001
                    </li>
                    <li class="flex items-center gap-3">
                        <i data-lucide="map-pin" class="w-4 h-4 text-primary-500"></i>
                        New Delhi, India
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-12 border-t border-slate-900 flex flex-col md:flex-row items-center justify-between gap-6">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">© <?php echo date('Y');?> IFSC FINDER PORTAL. ALL RIGHTS RESERVED.</p>
            <div class="flex gap-8 text-xs font-bold text-slate-500 uppercase tracking-widest">
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
