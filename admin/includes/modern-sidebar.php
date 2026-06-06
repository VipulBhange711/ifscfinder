<aside id="sidebar" class="fixed top-0 left-0 z-40 w-72 h-screen transition-premium -translate-x-full sm:translate-x-0 glass border-r border-slate-200 dark:border-slate-800">
    <div class="h-full px-4 py-6 overflow-y-auto flex flex-col custom-scrollbar">
        <!-- Brand Logo -->
        <div class="flex items-center ps-2.5 mb-10 group cursor-pointer" onclick="window.location.href='dashboard.php'">
            <div class="w-12 h-12 bg-gradient-to-tr from-primary-600 to-blue-500 rounded-2xl flex items-center justify-center mr-4 shadow-xl shadow-primary-500/30 group-hover:scale-110 transition-premium">
                <i data-lucide="building-2" class="text-white w-7 h-7"></i>
            </div>
            <div class="flex flex-col">
                <span class="text-xl font-black tracking-tighter dark:text-white leading-none">IFSC FINDER</span>
                <span class="text-[10px] font-bold text-primary-500 uppercase tracking-[0.2em] mt-1">Pro Admin v2.1</span>
            </div>
        </div>

        <!-- Navigation Categories -->
        <nav class="space-y-8 flex-1">
            <!-- Main Section -->
            <div class="space-y-2">
                <p class="px-4 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em]">Main Menu</p>
                <ul class="space-y-1">
                    <li>
                        <a href="dashboard.php" class="flex items-center p-3 text-slate-700 rounded-2xl dark:text-slate-300 hover:bg-primary-50 dark:hover:bg-primary-900/10 group transition-premium <?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'bg-primary-50 text-primary-600 dark:bg-primary-900/20 dark:text-primary-400 shadow-sm' : ''; ?>">
                            <div class="p-2 rounded-xl group-hover:bg-white dark:group-hover:bg-slate-800 transition-colors">
                                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                            </div>
                            <span class="ms-3 font-bold text-sm">Dashboard</span>
                            <?php if(basename($_SERVER['PHP_SELF']) == 'dashboard.php'): ?>
                                <span class="ml-auto w-1.5 h-1.5 rounded-full bg-primary-500 shadow-lg shadow-primary-500/50"></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li>
                        <a href="guide.php" class="flex items-center p-3 text-slate-700 rounded-2xl dark:text-slate-300 hover:bg-primary-50 dark:hover:bg-primary-900/10 group transition-premium <?php echo (basename($_SERVER['PHP_SELF']) == 'guide.php') ? 'bg-primary-50 text-primary-600 dark:bg-primary-900/20 dark:text-primary-400 shadow-sm' : ''; ?>">
                            <div class="p-2 rounded-xl group-hover:bg-white dark:group-hover:bg-slate-800 transition-colors">
                                <i data-lucide="book-open" class="w-5 h-5"></i>
                            </div>
                            <span class="ms-3 font-bold text-sm">User Guide</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Management Section -->
            <div class="space-y-2">
                <p class="px-4 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em]">Management</p>
                <ul class="space-y-1">
                    <!-- Dropdown: Add New -->
                    <li>
                        <button type="button" class="flex items-center w-full p-3 text-slate-700 dark:text-slate-300 rounded-2xl hover:bg-slate-50 dark:hover:bg-slate-800/50 group transition-premium" data-collapse-toggle="dropdown-add">
                            <div class="p-2 rounded-xl group-hover:bg-white dark:group-hover:bg-slate-800 transition-colors">
                                <i data-lucide="plus-circle" class="w-5 h-5 text-emerald-500"></i>
                            </div>
                            <span class="flex-1 ms-3 text-left font-bold text-sm">Add Records</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300"></i>
                        </button>
                        <ul id="dropdown-add" class="hidden py-2 space-y-1 ml-6 border-l-2 border-slate-100 dark:border-slate-800">
                            <li><a href="add-bank.php" class="flex items-center p-2 text-sm text-slate-500 dark:text-slate-400 hover:text-primary-600 pl-6 font-semibold transition-colors">Add Bank</a></li>
                            <li><a href="add-state.php" class="flex items-center p-2 text-sm text-slate-500 dark:text-slate-400 hover:text-primary-600 pl-6 font-semibold transition-colors">Add State</a></li>
                            <li><a href="add-city.php" class="flex items-center p-2 text-sm text-slate-500 dark:text-slate-400 hover:text-primary-600 pl-6 font-semibold transition-colors">Add City</a></li>
                            <li><a href="add-bank-detail.php" class="flex items-center p-2 text-sm text-slate-500 dark:text-slate-400 hover:text-primary-600 pl-6 font-semibold transition-colors">Bank Details</a></li>
                        </ul>
                    </li>

                    <!-- Dropdown: Manage -->
                    <li>
                        <button type="button" class="flex items-center w-full p-3 text-slate-700 dark:text-slate-300 rounded-2xl hover:bg-slate-50 dark:hover:bg-slate-800/50 group transition-premium" data-collapse-toggle="dropdown-manage">
                            <div class="p-2 rounded-xl group-hover:bg-white dark:group-hover:bg-slate-800 transition-colors">
                                <i data-lucide="list-checks" class="w-5 h-5 text-blue-500"></i>
                            </div>
                            <span class="flex-1 ms-3 text-left font-bold text-sm">Manage Data</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300"></i>
                        </button>
                        <ul id="dropdown-manage" class="hidden py-2 space-y-1 ml-6 border-l-2 border-slate-100 dark:border-slate-800">
                            <li><a href="manage-bank.php" class="flex items-center p-2 text-sm text-slate-500 dark:text-slate-400 hover:text-primary-600 pl-6 font-semibold transition-colors">Banks List</a></li>
                            <li><a href="manage-state.php" class="flex items-center p-2 text-sm text-slate-500 dark:text-slate-400 hover:text-primary-600 pl-6 font-semibold transition-colors">States List</a></li>
                            <li><a href="manage-city.php" class="flex items-center p-2 text-sm text-slate-500 dark:text-slate-400 hover:text-primary-600 pl-6 font-semibold transition-colors">Cities List</a></li>
                            <li><a href="manage-bank-detail.php" class="flex items-center p-2 text-sm text-slate-500 dark:text-slate-400 hover:text-primary-600 pl-6 font-semibold transition-colors">Full Details</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- System Section -->
            <div class="space-y-2">
                <p class="px-4 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em]">System</p>
                <ul class="space-y-1">
                    <li>
                        <a href="profile.php" class="flex items-center p-3 text-slate-700 rounded-2xl dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800/50 group transition-premium">
                            <div class="p-2 rounded-xl group-hover:bg-white dark:group-hover:bg-slate-800 transition-colors">
                                <i data-lucide="user-circle" class="w-5 h-5"></i>
                            </div>
                            <span class="ms-3 font-bold text-sm">Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="logout.php" class="flex items-center p-3 text-red-600 rounded-2xl hover:bg-red-50 dark:hover:bg-red-900/20 group transition-premium">
                            <div class="p-2 rounded-xl group-hover:bg-white dark:group-hover:bg-red-500/10 transition-colors">
                                <i data-lucide="log-out" class="w-5 h-5"></i>
                            </div>
                            <span class="ms-3 font-bold text-sm">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Sidebar Footer -->
        <div class="mt-auto pt-6 border-t border-slate-100 dark:border-slate-800">
            <div class="p-4 bg-slate-50 dark:bg-slate-900/50 rounded-2xl border border-slate-100 dark:border-slate-800">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-wider">System Status</span>
                    <span class="flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                </div>
                <div class="text-[10px] font-bold text-slate-500">Connected to ifscdb</div>
            </div>
        </div>
    </div>
</aside>

<script>
    // Advanced Sidebar Interactions
    document.querySelectorAll('[data-collapse-toggle]').forEach(button => {
        button.addEventListener('click', () => {
            const targetId = button.getAttribute('data-collapse-toggle');
            const target = document.getElementById(targetId);
            const icon = button.querySelector('[data-lucide="chevron-down"]');
            
            const isHidden = target.classList.contains('hidden');
            
            // Close other dropdowns first (Optional: for accordion style)
            // document.querySelectorAll('[id^="dropdown-"]').forEach(d => d.classList.add('hidden'));
            
            target.classList.toggle('hidden');
            if (icon) {
                icon.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';
            }
        });
    });

    // Auto-expand dropdown if current page is inside it
    document.addEventListener('DOMContentLoaded', () => {
        const currentPath = window.location.pathname.split('/').pop();
        document.querySelectorAll('[id^="dropdown-"] a').forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                const dropdown = link.closest('[id^="dropdown-"]');
                dropdown.classList.remove('hidden');
                const btn = document.querySelector(`[data-collapse-toggle="${dropdown.id}"]`);
                if (btn) {
                    const icon = btn.querySelector('[data-lucide="chevron-down"]');
                    if (icon) icon.style.transform = 'rotate(180deg)';
                    btn.classList.add('text-primary-600', 'bg-primary-50', 'dark:bg-primary-900/10');
                }
            }
        });
    });
</script>
