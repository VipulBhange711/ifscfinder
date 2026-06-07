<!-- Modern Tech Stack -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                colors: {
                    primary: {
                        50: '#f0f9ff',
                        100: '#e0f2fe',
                        200: '#bae6fd',
                        300: '#7dd3fc',
                        400: '#38bdf8',
                        500: '#0ea5e9',
                        600: '#0284c7',
                        700: '#0369a1',
                        800: '#075985',
                        900: '#0c4a6e',
                    }
                },
                fontFamily: {
                    sans: ['Plus Jakarta Sans', 'sans-serif'],
                },
                animation: {
                    'float': 'float 6s ease-in-out infinite',
                },
                keyframes: {
                    float: {
                        '0%, 100%': { transform: 'translateY(0)' },
                        '50%': { transform: 'translateY(-20px)' },
                    }
                }
            }
        }
    }
</script>

<!-- Lucide Icons -->
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

<!-- Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    .glass {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(12px) saturate(180%);
        -webkit-backdrop-filter: blur(12px) saturate(180%);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    .dark .glass {
        background: rgba(15, 23, 42, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }
    .transition-premium {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>

<header class="fixed top-0 left-0 w-full z-50 transition-premium" id="main-header">
    <div class="container mx-auto px-6 py-4">
        <nav class="glass rounded-[2rem] px-8 py-4 flex items-center justify-between shadow-xl shadow-slate-200/50 dark:shadow-none border border-white/40">
            <!-- Logo -->
            <a href="index.php" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center shadow-lg shadow-primary-500/30 group-hover:scale-110 transition-premium">
                    <i data-lucide="building-2" class="text-white w-6 h-6"></i>
                </div>
                <span class="text-xl font-black tracking-tighter text-slate-900 dark:text-white">IFSC FINDER</span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center gap-8">
                <a href="index.php" class="text-sm font-bold text-slate-600 hover:text-primary-600 transition-colors <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'text-primary-600' : ''; ?>">Home</a>
                <a href="about.php" class="text-sm font-bold text-slate-600 hover:text-primary-600 transition-colors <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'text-primary-600' : ''; ?>">About Us</a>
                <a href="services.php" class="text-sm font-bold text-slate-600 hover:text-primary-600 transition-colors <?php echo basename($_SERVER['PHP_SELF']) == 'services.php' ? 'text-primary-600' : ''; ?>">Services</a>
                <div class="h-6 w-[1px] bg-slate-200 mx-2"></div>
                <a href="admin/login.php" class="px-6 py-2.5 bg-primary-600 text-white rounded-xl text-sm font-black hover:bg-primary-700 transition-premium shadow-lg shadow-primary-500/25">Admin Portal</a>
            </div>

            <!-- Mobile Toggle -->
            <button class="lg:hidden p-2 text-slate-600" onclick="toggleMobileMenu()">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </nav>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden fixed inset-0 z-[60] bg-white/95 backdrop-blur-xl lg:hidden animate__animated animate__fadeIn">
        <div class="flex flex-col h-full p-10">
            <div class="flex items-center justify-between mb-12">
                <span class="text-xl font-black tracking-tighter">IFSC FINDER</span>
                <button onclick="toggleMobileMenu()" class="p-2 bg-slate-100 rounded-xl">
                    <i data-lucide="x" class="w-6 h-6 text-slate-600"></i>
                </button>
            </div>
            <div class="flex flex-col gap-6">
                <a href="index.php" class="text-2xl font-black text-slate-900">Home</a>
                <a href="about.php" class="text-2xl font-black text-slate-900">About Us</a>
                <a href="services.php" class="text-2xl font-black text-slate-900">Services</a>
                <hr class="border-slate-100">
                <a href="admin/login.php" class="text-2xl font-black text-primary-600">Admin Portal</a>
            </div>
        </div>
    </div>
</header>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }

    window.addEventListener('scroll', () => {
        const header = document.getElementById('main-header');
        if (window.scrollY > 20) {
            header.classList.add('translate-y-[-5px]');
        } else {
            header.classList.remove('translate-y-[-5px]');
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
