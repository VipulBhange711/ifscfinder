<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login'])) {
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $sql ="SELECT ID FROM tbladmin WHERE UserName=:username and Password=:password";
    $query=$dbh->prepare($sql);
    $query-> bindParam(':username', $username, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    
    if($query->rowCount() > 0) {
        foreach ($results as $result) {
            $_SESSION['ifscaid']=$result->ID;
        }

        if(!empty($_POST["remember"])) {
            setcookie ("user_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
            setcookie ("userpassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
        } else {
            if(isset($_COOKIE["user_login"])) {
                setcookie ("user_login","");
                if(isset($_COOKIE["userpassword"])) {
                    setcookie ("userpassword","");
                }
            }
        }
        $_SESSION['login']=$_POST['username'];
        echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | IFSC Finder Pro</title>
    
    <!-- Modern Tech Stack -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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
                    }
                }
            }
        }
    </script>
    
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .transition-premium {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-slate-50 font-sans text-slate-900 antialiased overflow-hidden">
    
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute top-[-10%] right-[-10%] w-[50%] h-[50%] bg-primary-500/10 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-500/10 rounded-full blur-[120px] animate-pulse" style="animation-delay: 2s"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center p-6 relative z-10">
        <div class="w-full max-w-md animate__animated animate__fadeInUp">
            
            <!-- Logo & Back Link -->
            <div class="flex flex-col items-center mb-10">
                <a href="../index.php" class="flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-primary-600 transition-colors mb-8 group">
                    <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                    Back to Portal
                </a>
                <div class="w-16 h-16 bg-primary-600 rounded-[2rem] flex items-center justify-center shadow-2xl shadow-primary-500/30 mb-6 animate-float">
                    <i data-lucide="building-2" class="text-white w-8 h-8"></i>
                </div>
                <h1 class="text-3xl font-black tracking-tighter text-slate-900">Admin Login</h1>
                <p class="text-slate-500 font-medium text-sm mt-2">Manage your banking registry</p>
            </div>

            <!-- Login Card -->
            <div class="glass p-10 rounded-[3rem] shadow-3xl shadow-slate-200/50 relative overflow-hidden">
                <!-- Abstract Decoration -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary-500/5 rounded-full blur-2xl"></div>
                
                <form action="" method="post" class="space-y-6 relative z-10">
                    <!-- Username -->
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Username</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400 group-focus-within:text-primary-600 transition-colors">
                                <i data-lucide="user" class="w-5 h-5"></i>
                            </div>
                            <input type="text" name="username" required
                                   class="w-full bg-slate-50 border-none text-slate-900 text-sm rounded-[1.5rem] pl-14 p-5 focus:ring-4 focus:ring-primary-100 transition-premium shadow-inner"
                                   placeholder="Enter your username"
                                   value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <div class="flex justify-between items-center ml-4">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">Password</label>
                            <a href="forgot-password.php" class="text-[10px] font-bold text-primary-600 hover:text-primary-700 uppercase tracking-widest">Forgot?</a>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400 group-focus-within:text-primary-600 transition-colors">
                                <i data-lucide="lock" class="w-5 h-5"></i>
                            </div>
                            <input type="password" name="password" required
                                   class="w-full bg-slate-50 border-none text-slate-900 text-sm rounded-[1.5rem] pl-14 p-5 focus:ring-4 focus:ring-primary-100 transition-premium shadow-inner"
                                   placeholder="••••••••"
                                   value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>">
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center gap-3 ml-2">
                        <input type="checkbox" id="remember" name="remember" <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?>
                               class="w-5 h-5 rounded-lg border-slate-200 text-primary-600 focus:ring-primary-500 transition-premium">
                        <label for="remember" class="text-sm font-bold text-slate-500 cursor-pointer">Remember this session</label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" name="login"
                            class="w-full py-5 bg-primary-600 text-white rounded-[1.5rem] font-black uppercase tracking-widest text-sm hover:bg-primary-700 transition-premium shadow-xl shadow-primary-500/25 active:scale-95 flex items-center justify-center gap-3">
                        <i data-lucide="log-in" class="w-5 h-5"></i>
                        Sign In to Dashboard
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <p class="text-center mt-10 text-xs font-bold text-slate-400 uppercase tracking-widest">
                © <?php echo date('Y'); ?> IFSC FINDER ADMIN PORTAL
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            <?php if(isset($error)): ?>
            Swal.fire({
                title: 'Access Denied',
                text: '<?php echo $error; ?>',
                icon: 'error',
                confirmButtonColor: '#0ea5e9',
                customClass: {
                    popup: 'rounded-[2.5rem] glass border-none'
                }
            });
            <?php endif; ?>
        });
    </script>
</body>
</html>
