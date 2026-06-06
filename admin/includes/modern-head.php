<!-- Modern Tech Stack & Architecture -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

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
                    },
                    slate: {
                        950: '#020617',
                    }
                },
                fontFamily: {
                    sans: ['Plus Jakarta Sans', 'sans-serif'],
                    mono: ['JetBrains Mono', 'monospace'],
                },
                animation: {
                    'gradient-x': 'gradient-x 15s ease infinite',
                    'float': 'float 6s ease-in-out infinite',
                    'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                },
                keyframes: {
                    'gradient-x': {
                        '0%, 100%': { 'background-size': '200% 200%', 'background-position': 'left center' },
                        '50%': { 'background-size': '200% 200%', 'background-position': 'right center' },
                    },
                    'float': {
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

<!-- Flowbite -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Driver.js (Onboarding) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css"/>
<script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<!-- Canvas Confetti -->
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js"></script>

<!-- NProgress -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css">

<!-- Toastify -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<style>
    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    ::-webkit-scrollbar-track {
        background: transparent;
    }
    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
        transition: all 0.3s;
    }
    .dark ::-webkit-scrollbar-thumb {
        background: #334155;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    .dark ::-webkit-scrollbar-thumb:hover {
        background: #475569;
    }

    /* Glassmorphism & Modern Shadows */
    .glass {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(12px) saturate(180%);
        -webkit-backdrop-filter: blur(12px) saturate(180%);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    .dark .glass {
        background: rgba(15, 23, 42, 0.65);
        backdrop-filter: blur(12px) saturate(180%);
        -webkit-backdrop-filter: blur(12px) saturate(180%);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }
    
    .glass-card {
        @apply glass shadow-2xl shadow-slate-200/50 dark:shadow-none;
    }

    /* Skeleton Loader */
    @keyframes shimmer {
        0% { background-position: -1000px 0; }
        100% { background-position: 1000px 0; }
    }
    .skeleton {
        background: #f1f5f9;
        background-image: linear-gradient(90deg, #f1f5f9 0px, #e2e8f0 40px, #f1f5f9 80px);
        background-size: 1000px 100%;
        animation: shimmer 2s infinite linear;
    }
    .dark .skeleton {
        background: #1e293b;
        background-image: linear-gradient(90deg, #1e293b 0px, #334155 40px, #1e293b 80px);
    }

    /* Accessibility & Transitions */
    :focus-visible {
        outline: 2px solid #0ea5e9;
        outline-offset: 2px;
    }
    
    .transition-premium {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* NProgress Styling */
    #nprogress .bar {
        background: #0ea5e9 !important;
        height: 3px !important;
    }
    #nprogress .peg {
        box-shadow: 0 0 10px #0ea5e9, 0 0 5px #0ea5e9 !important;
    }

    /* Custom Toastify Styles */
    .toastify {
        border-radius: 1rem !important;
        padding: 1rem 1.5rem !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        font-weight: 600 !important;
        box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1) !important;
    }
</style>

<script>
    // Theme logic
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark')
    } else {
        document.documentElement.classList.remove('dark')
    }

    function toggleTheme() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.theme = 'light';
        } else {
            document.documentElement.classList.add('dark');
            localStorage.theme = 'dark';
        }
    }

    // Initialize Lucide Icons after DOM load
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>
