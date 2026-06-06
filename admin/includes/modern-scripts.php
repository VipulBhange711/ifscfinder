<!-- Core Scripts & UI Enhancements -->
<script>
    // Global State & Configuration
    const APP_CONFIG = {
        version: '2.1.0',
        name: 'IFSC Finder Pro',
        theme: localStorage.theme || 'light'
    };

    // Theme Toggle Logic
    const toggleTheme = () => {
        const isDark = document.documentElement.classList.contains('dark');
        if (isDark) {
            document.documentElement.classList.remove('dark');
            localStorage.theme = 'light';
        } else {
            document.documentElement.classList.add('dark');
            localStorage.theme = 'dark';
        }
    };

    // Apply saved theme on load
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    // Initialize Lucide Icons
    function initIcons() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }
    initIcons();

    // Premium Notifications (Toastify Wrapper)
    const showToast = (message, type = 'success') => {
        const colors = {
            success: 'linear-gradient(to right, #10b981, #059669)',
            error: 'linear-gradient(to right, #ef4444, #dc2626)',
            info: 'linear-gradient(to right, #3b82f6, #2563eb)',
            warning: 'linear-gradient(to right, #f59e0b, #d97706)'
        };
        
        Toastify({
            text: message,
            duration: 4000,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: { background: colors[type] },
            onClick: function(){} 
        }).showToast();
    };

    // Celebration Effect (Confetti)
    const celebrate = () => {
        const count = 200;
        const defaults = { origin: { y: 0.7 }, zIndex: 9999 };

        function fire(particleRatio, opts) {
            confetti({
                ...defaults,
                ...opts,
                particleCount: Math.floor(count * particleRatio)
            });
        }

        fire(0.25, { spread: 26, startVelocity: 55 });
        fire(0.2, { spread: 60 });
        fire(0.35, { spread: 100, decay: 0.91, scalar: 0.8 });
        fire(0.1, { spread: 120, startVelocity: 25, decay: 0.92, scalar: 1.2 });
        fire(0.1, { spread: 120, startVelocity: 45 });
    };

    // Progress Bar Logic
    window.addEventListener('beforeunload', () => NProgress.start());
    document.addEventListener('DOMContentLoaded', () => {
        NProgress.done();
        
        // Optimistic UI: Intercept link clicks for smooth transitions
        document.querySelectorAll('a').forEach(link => {
            if (link.hostname === window.location.hostname && !link.hash && !link.target) {
                link.addEventListener('click', () => NProgress.start());
            }
        });
    });

    // Advanced Command Palette
    const commands = [
        { id: 'dash', title: 'Dashboard', icon: 'layout-dashboard', action: () => window.location.href = 'dashboard.php' },
        { id: 'add-b', title: 'Add Bank', icon: 'plus-circle', action: () => window.location.href = 'add-bank.php' },
        { id: 'man-b', title: 'Manage Banks', icon: 'list', action: () => window.location.href = 'manage-bank.php' },
        { id: 'prof', title: 'My Profile', icon: 'user', action: () => window.location.href = 'profile.php' },
        { id: 'theme', title: 'Toggle Theme', icon: 'moon', action: () => toggleTheme() },
        { id: 'tour', title: 'Restart Tour', icon: 'play', action: () => startTour() },
        { id: 'help', title: 'Get Help', icon: 'help-circle', action: () => showHelp() }
    ];

    const openCommandPalette = () => {
        const commandHtml = commands.map(cmd => `
            <div onclick="window.cmdAction('${cmd.id}')" class="flex items-center p-3 mb-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 cursor-pointer transition-all group">
                <div class="p-2 bg-slate-50 dark:bg-slate-900 rounded-lg mr-3 group-hover:bg-primary-500 group-hover:text-white transition-colors">
                    <i data-lucide="${cmd.icon}" class="w-5 h-5"></i>
                </div>
                <span class="font-semibold text-slate-700 dark:text-slate-300 group-hover:text-primary-600">${cmd.title}</span>
                <span class="ml-auto text-xs text-slate-400 font-mono">⌘ Enter</span>
            </div>
        `).join('');

        Swal.fire({
            title: '<div class="flex items-center text-lg font-bold"><i data-lucide="terminal" class="mr-2 w-5 h-5 text-primary-600"></i> Command Palette</div>',
            html: `<div class="mt-4 max-h-96 overflow-y-auto pr-2 text-left">${commandHtml}</div>`,
            showConfirmButton: false,
            customClass: {
                popup: 'rounded-[2rem] glass border-none shadow-3xl animate__animated animate__zoomIn animate__faster',
                container: 'backdrop-blur-md'
            },
            didOpen: () => initIcons()
        });
    };

    window.cmdAction = (id) => {
        Swal.close();
        const cmd = commands.find(c => c.id === id);
        if (cmd) cmd.action();
    };

    // Keyboard Shortcuts
    document.addEventListener('keydown', (e) => {
        // Ctrl + K : Command Palette
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            openCommandPalette();
        }
        // ? : Help
        if (e.key === '?' && !['INPUT', 'TEXTAREA'].includes(document.activeElement.tagName)) {
            showHelp();
        }
        // Esc : Close Modals
        if (e.key === 'Escape') {
            // Logic handled by Swal and Flowbite
        }
    });

    // Onboarding Tour v2
    function startTour() {
        const driver = window.driver.js.driver;
        const driverObj = driver({
            showProgress: true,
            animate: true,
            steps: [
                { element: '#sidebar', popover: { title: 'Navigation Hub', description: 'Access all administrative modules from here. Collapsible for more space.', position: 'right' } },
                { element: '#command-palette-trigger', popover: { title: 'Global Search', description: 'The fastest way to navigate. Press Ctrl+K anywhere.', position: 'bottom' } },
                { element: '#theme-toggle', popover: { title: 'Theme Switcher', description: 'Switch between Light, Dark, and System modes seamlessly.', position: 'bottom' } },
                { element: '#help-widget', popover: { title: 'Need Assistance?', description: 'Your persistent companion for FAQs, shortcuts, and guides.', position: 'top' } }
            ]
        });
        driverObj.drive();
    }

    // Floating Help Widget & Side Panel
    const showHelp = () => {
        Swal.fire({
            title: 'How to Use This App',
            html: `
                <div class="text-left space-y-6">
                    <div class="space-y-4">
                        <div class="p-4 bg-slate-50 dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700">
                            <h4 class="font-bold text-primary-600 flex items-center mb-2"><i data-lucide="rocket" class="w-4 h-4 mr-2"></i> Getting Started</h4>
                            <ul class="text-sm text-slate-500 space-y-2">
                                <li class="flex items-center"><i data-lucide="check-circle-2" class="w-3 h-3 mr-2 text-emerald-500"></i> Register your bank first</li>
                                <li class="flex items-center"><i data-lucide="check-circle-2" class="w-3 h-3 mr-2 text-emerald-500"></i> Add states and cities</li>
                                <li class="flex items-center"><i data-lucide="check-circle-2" class="w-3 h-3 mr-2 text-emerald-500"></i> Link branch details with IFSC</li>
                            </ul>
                        </div>
                        
                        <div class="p-4 bg-slate-50 dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700">
                            <h4 class="font-bold text-primary-600 flex items-center mb-2"><i data-lucide="keyboard" class="w-4 h-4 mr-2"></i> Power Shortcuts</h4>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex flex-col">
                                    <span class="text-[10px] uppercase font-bold text-slate-400">Command Palette</span>
                                    <kbd class="px-2 py-1 bg-white dark:bg-slate-900 rounded border border-slate-200 dark:border-slate-700 text-xs font-mono w-fit mt-1">Ctrl + K</kbd>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[10px] uppercase font-bold text-slate-400">Quick Help</span>
                                    <kbd class="px-2 py-1 bg-white dark:bg-slate-900 rounded border border-slate-200 dark:border-slate-700 text-xs font-mono w-fit mt-1">Shift + ?</kbd>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex gap-3">
                        <button onclick="startTour()" class="flex-1 py-3 bg-primary-600 text-white rounded-xl font-bold hover:bg-primary-700 shadow-lg shadow-primary-500/30 transition-all flex items-center justify-center">
                            <i data-lucide="play" class="w-4 h-4 mr-2"></i> Restart Tour
                        </button>
                        <a href="guide.php" class="flex-1 py-3 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-xl font-bold hover:bg-slate-200 dark:hover:bg-slate-700 transition-all flex items-center justify-center text-sm">
                            <i data-lucide="book-open" class="w-4 h-4 mr-2"></i> Docs
                        </a>
                    </div>
                </div>
            `,
            showConfirmButton: false,
            customClass: {
                popup: 'rounded-[2rem] glass border-none max-w-md'
            },
            didOpen: () => initIcons()
        });
    };

    // Create Help Widget
    const helpBtn = document.createElement('button');
    helpBtn.id = 'help-widget';
    helpBtn.innerHTML = '<i data-lucide="help-circle"></i>';
    helpBtn.className = 'fixed bottom-8 right-8 p-5 bg-primary-600 text-white rounded-[1.5rem] shadow-3xl hover:bg-primary-700 transition-premium z-50 animate-float';
    helpBtn.onclick = showHelp;
    document.body.appendChild(helpBtn);

    // New Update Badge Logic
    const currentVersion = APP_CONFIG.version;
    if (localStorage.getItem('app_version') !== currentVersion) {
        setTimeout(() => {
            Swal.fire({
                title: '<div class="text-left text-2xl font-black">🚀 New Update v'+currentVersion+'</div>',
                html: `
                    <div class="text-left space-y-4 py-4">
                        <div class="p-4 bg-primary-50 dark:bg-primary-900/20 rounded-2xl border border-primary-100 dark:border-primary-800">
                            <h4 class="font-bold text-primary-700 dark:text-primary-400">What\'s New?</h4>
                            <ul class="text-sm text-slate-600 dark:text-slate-400 mt-2 space-y-1">
                                <li>✨ Premium Glassmorphism UI Components</li>
                                <li>⌨️ Advanced Command Palette (Ctrl+K)</li>
                                <li>📊 Interactive Data Visualizations</li>
                                <li>⚡ Optimized Performance & Smooth Transitions</li>
                            </ul>
                        </div>
                    </div>
                `,
                confirmButtonText: 'Let\'s Go!',
                confirmButtonColor: '#0ea5e9',
                customClass: {
                    popup: 'rounded-[2.5rem] glass border-none',
                    confirmButton: 'rounded-2xl px-10 py-4 font-bold'
                }
            }).then(() => {
                localStorage.setItem('app_version', currentVersion);
                celebrate();
            });
        }, 2000);
    }

    // Offline Detection
    window.addEventListener('offline', () => {
        showToast('System Offline - Changes may not be saved', 'error');
    });
    window.addEventListener('online', () => {
        showToast('System Online - Connection restored', 'success');
    });
</script>
