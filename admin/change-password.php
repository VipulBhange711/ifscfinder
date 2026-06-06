<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ifscaid'])==0) {
    header('location:logout.php');
} else {
    if(isset($_POST['change'])) {
        $adminid=$_SESSION['ifscaid'];
        $cpassword=md5($_POST['currentpassword']);
        $newpassword=md5($_POST['newpassword']);
        
        $sql ="SELECT ID FROM tbladmin WHERE ID=:adminid and Password=:cpassword";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':adminid', $adminid, PDO::PARAM_STR);
        $query-> bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
        $query-> execute();
        
        if($query -> rowCount() > 0) {
            $con="update tbladmin set Password=:newpassword where ID=:adminid";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1-> bindParam(':adminid', $adminid, PDO::PARAM_STR);
            $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            $success = true;
        } else {
            $error = true;
        }
    }

    $pageTitle = "Security Settings";
    include_once('includes/modern-layout-top.php');
?>

<?php if(isset($success)): ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        Swal.fire({
            title: 'Password Updated!',
            text: 'Your security credentials have been successfully updated.',
            icon: 'success',
            confirmButtonColor: '#0ea5e9',
            customClass: { popup: 'rounded-[2.5rem] glass' }
        }).then(() => celebrate());
    });
</script>
<?php endif; ?>

<?php if(isset($error)): ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        Swal.fire({
            title: 'Verification Failed',
            text: 'The current password you entered is incorrect.',
            icon: 'error',
            confirmButtonColor: '#ef4444',
            customClass: { popup: 'rounded-[2.5rem] glass' }
        });
    });
</script>
<?php endif; ?>

<div class="row">
    <div class="col-lg-7">
        <div class="glass-card p-10 rounded-[3rem] relative overflow-hidden group">
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-primary-500/10 rounded-full blur-3xl group-hover:bg-primary-500/20 transition-premium"></div>
            
            <div class="relative z-10">
                <div class="flex items-center gap-6 mb-10">
                    <div class="p-4 bg-primary-600 text-white rounded-3xl shadow-xl shadow-primary-500/30">
                        <i data-lucide="shield-check" class="w-8 h-8"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-black tracking-tighter mb-1">Update Password</h2>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Enhance your account security</p>
                    </div>
                </div>
                
                <form action="#" method="post" name="changepassword" onsubmit="return checkpass();" class="space-y-8">
                    <div class="space-y-6">
                        <div class="space-y-3">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">Current Password</label>
                            <div class="relative group/input">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400 group-focus-within/input:text-primary-500 transition-colors">
                                    <i data-lucide="key" class="w-5 h-5"></i>
                                </div>
                                <input type="password" name="currentpassword" id="currentpassword" required
                                       class="bg-slate-50 dark:bg-slate-900/50 border-none text-slate-900 dark:text-white text-sm rounded-[1.5rem] focus:ring-2 focus:ring-primary-500 block w-full pl-14 p-5 transition-premium shadow-inner">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">New Password</label>
                                <div class="relative group/input">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400 group-focus-within/input:text-primary-500 transition-colors">
                                        <i data-lucide="lock" class="w-5 h-5"></i>
                                    </div>
                                    <input type="password" name="newpassword" id="newpassword" required
                                           class="bg-slate-50 dark:bg-slate-900/50 border-none text-slate-900 dark:text-white text-sm rounded-[1.5rem] focus:ring-2 focus:ring-primary-500 block w-full pl-14 p-5 transition-premium shadow-inner">
                                </div>
                            </div>

                            <div class="space-y-3">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">Confirm New Password</label>
                                <div class="relative group/input">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400 group-focus-within/input:text-primary-500 transition-colors">
                                        <i data-lucide="lock-check" class="w-5 h-5"></i>
                                    </div>
                                    <input type="password" name="confirmpassword" id="confirmpassword" required
                                           class="bg-slate-50 dark:bg-slate-900/50 border-none text-slate-900 dark:text-white text-sm rounded-[1.5rem] focus:ring-2 focus:ring-primary-500 block w-full pl-14 p-5 transition-premium shadow-inner">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" name="change" 
                                class="w-full sm:w-auto px-12 py-5 bg-primary-600 text-white rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-primary-700 transition-premium shadow-2xl shadow-primary-500/40 active:scale-95 flex items-center justify-center gap-3">
                            <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                            Update Credentials
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-5 mt-8 lg:mt-0">
        <div class="glass-card p-10 rounded-[3rem] h-full">
            <h3 class="text-xl font-black tracking-tight mb-8">Security Best Practices</h3>
            <div class="space-y-6">
                <div class="p-6 bg-slate-50 dark:bg-slate-900/50 rounded-3xl border border-slate-100 dark:border-slate-800">
                    <h4 class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-wider mb-2">Complexity Requirement</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">Use at least 12 characters with a mix of letters, numbers, and symbols to ensure maximum protection.</p>
                </div>
                <div class="p-6 bg-slate-50 dark:bg-slate-900/50 rounded-3xl border border-slate-100 dark:border-slate-800">
                    <h4 class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-wider mb-2">Regular Rotation</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">We recommend changing your password every 90 days to comply with enterprise security standards.</p>
                </div>
                <div class="pt-6">
                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-amber-50 dark:bg-amber-900/20 border border-amber-100 dark:border-amber-800/50">
                        <i data-lucide="alert-triangle" class="w-6 h-6 text-amber-600 shrink-0"></i>
                        <p class="text-[10px] font-bold text-amber-700 dark:text-amber-400">Never share your administrative credentials with anyone. Our team will never ask for your password.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function checkpass() {
    const newPass = document.getElementById('newpassword').value;
    const confirmPass = document.getElementById('confirmpassword').value;
    
    if(newPass !== confirmPass) {
        showToast('Passwords do not match!', 'error');
        document.getElementById('confirmpassword').focus();
        return false;
    }
    return true;
}
</script>

<?php include_once('includes/modern-layout-bottom.php'); ?>
<?php } ?>
