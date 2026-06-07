<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit'])) {
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $newpassword=md5($_POST['newpassword']);
    
    $sql ="SELECT Email FROM tbladmin WHERE Email=:email and MobileNumber=:mobile";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query-> execute();
    
    if($query -> rowCount() > 0) {
        $con="update tbladmin set Password=:newpassword where Email=:email and MobileNumber=:mobile";
        $chngpwd1 = $dbh->prepare($con);
        $chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
        $chngpwd1-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
        $chngpwd1->execute();
        $success = "Your Password has been successfully changed.";
    } else {
        $error = "Email ID or Mobile Number is invalid.";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recover Password | IFSC Finder Pro</title>
    
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
    
    <script type="text/javascript">
        function valid() {
            if(document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                Swal.fire({
                    title: 'Error!',
                    text: 'New Password and Confirm Password fields do not match!',
                    icon: 'error',
                    confirmButtonColor: '#0ea5e9',
                    customClass: { popup: 'rounded-[2.5rem] glass' }
                });
                document.chngpwd.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</head>

<body class="bg-slate-50 font-sans text-slate-900 antialiased overflow-hidden">
    
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute top-[-10%] right-[-10%] w-[50%] h-[50%] bg-primary-500/10 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-500/10 rounded-full blur-[120px] animate-pulse" style="animation-delay: 2s"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center p-6 relative z-10">
        <div class="w-full max-w-lg animate__animated animate__fadeInUp">
            
            <!-- Logo & Back Link -->
            <div class="flex flex-col items-center mb-10 text-center">
                <a href="../index.php" class="flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-primary-600 transition-colors mb-8 group">
                    <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                    Back to Portal
                </a>
                <div class="w-16 h-16 bg-primary-600 rounded-[2rem] flex items-center justify-center shadow-2xl shadow-primary-500/30 mb-6 animate-float">
                    <i data-lucide="shield-off" class="text-white w-8 h-8"></i>
                </div>
                <h1 class="text-3xl font-black tracking-tighter text-slate-900">Recover Password</h1>
                <p class="text-slate-500 font-medium text-sm mt-2 max-w-xs">Enter your details to reset your administrative credentials</p>
            </div>

            <!-- Recovery Card -->
            <div class="glass p-10 rounded-[3rem] shadow-3xl shadow-slate-200/50 relative overflow-hidden">
                <form action="" method="post" name="chngpwd" onSubmit="return valid();" class="space-y-6 relative z-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Email -->
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Email Address</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400 group-focus-within:text-primary-600 transition-colors">
                                    <i data-lucide="mail" class="w-5 h-5"></i>
                                </div>
                                <input type="email" name="email" required
                                       class="w-full bg-slate-50 border-none text-slate-900 text-sm rounded-[1.5rem] pl-14 p-5 focus:ring-4 focus:ring-primary-100 transition-premium shadow-inner"
                                       placeholder="admin@example.com">
                            </div>
                        </div>

                        <!-- Mobile -->
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Mobile Number</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400 group-focus-within:text-primary-600 transition-colors">
                                    <i data-lucide="phone" class="w-5 h-5"></i>
                                </div>
                                <input type="text" name="mobile" required maxlength="10" pattern="[0-9]+"
                                       class="w-full bg-slate-50 border-none text-slate-900 text-sm rounded-[1.5rem] pl-14 p-5 focus:ring-4 focus:ring-primary-100 transition-premium shadow-inner"
                                       placeholder="10-digit number">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                        <!-- New Password -->
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">New Password</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400 group-focus-within:text-primary-600 transition-colors">
                                    <i data-lucide="lock" class="w-5 h-5"></i>
                                </div>
                                <input type="password" name="newpassword" required
                                       class="w-full bg-slate-50 border-none text-slate-900 text-sm rounded-[1.5rem] pl-14 p-5 focus:ring-4 focus:ring-primary-100 transition-premium shadow-inner"
                                       placeholder="••••••••">
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Confirm Password</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400 group-focus-within:text-primary-600 transition-colors">
                                    <i data-lucide="shield-check" class="w-5 h-5"></i>
                                </div>
                                <input type="password" name="confirmpassword" required
                                       class="w-full bg-slate-50 border-none text-slate-900 text-sm rounded-[1.5rem] pl-14 p-5 focus:ring-4 focus:ring-primary-100 transition-premium shadow-inner"
                                       placeholder="••••••••">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" name="submit"
                            class="w-full py-5 bg-primary-600 text-white rounded-[1.5rem] font-black uppercase tracking-widest text-sm hover:bg-primary-700 transition-premium shadow-xl shadow-primary-500/25 active:scale-95 flex items-center justify-center gap-3">
                        <i data-lucide="refresh-cw" class="w-5 h-5"></i>
                        Reset Credentials
                    </button>

                    <div class="text-center pt-4">
                        <p class="text-sm font-bold text-slate-400">
                            Remembered your password? 
                            <a href="login.php" class="text-primary-600 hover:text-primary-700 ml-1 transition-colors">Sign In Here</a>
                        </p>
                    </div>
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

            <?php if(isset($success)): ?>
            Swal.fire({
                title: 'Success!',
                text: '<?php echo $success; ?>',
                icon: 'success',
                confirmButtonColor: '#0ea5e9',
                customClass: { popup: 'rounded-[2.5rem] glass border-none' }
            }).then(() => {
                window.location.href = 'login.php';
            });
            <?php endif; ?>

            <?php if(isset($error)): ?>
            Swal.fire({
                title: 'Reset Failed',
                text: '<?php echo $error; ?>',
                icon: 'error',
                confirmButtonColor: '#ef4444',
                customClass: { popup: 'rounded-[2.5rem] glass border-none' }
            });
            <?php endif; ?>
        });
    </script>
</body>
</html>
