<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ifscaid'])==0) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {

$ifscaid=$_SESSION['ifscaid'];
 $bankname=$_POST['bankname'];
 $shortname=$_POST['shortname'];
$sql="insert into tblbank(BankName,ShortName)values(:bankname,:shortname)";
$query=$dbh->prepare($sql);
$query->bindParam(':bankname',$bankname,PDO::PARAM_STR);
$query->bindParam(':shortname',$shortname,PDO::PARAM_STR);
 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: 'Success!',
                text: 'Bank has been added successfully.',
                icon: 'success',
                confirmButtonColor: '#0ea5e9',
                customClass: { popup: 'rounded-2xl glass' }
            }).then(() => {
                window.location.href = 'add-bank.php';
            });
        });
    </script>";
  }
  else
    {
         echo "<script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong. Please try again.',
                    icon: 'error',
                    confirmButtonColor: '#ef4444',
                    customClass: { popup: 'rounded-2xl glass' }
                });
            });
         </script>";
    }

  
}

?>
<?php
$pageTitle = "Add Bank";
include_once('includes/modern-layout-top.php');
?>

<div class="row">
    <div class="col-lg-8">
        <div class="glass-card p-10 rounded-[3rem] relative overflow-hidden group">
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-primary-500/10 rounded-full blur-3xl group-hover:bg-primary-500/20 transition-premium"></div>
            
            <div class="relative z-10">
                <div class="flex items-center gap-6 mb-10">
                    <div class="p-4 bg-primary-600 text-white rounded-3xl shadow-xl shadow-primary-500/30">
                        <i data-lucide="plus-circle" class="w-8 h-8"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-black tracking-tighter mb-1">Register New Bank</h2>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Add a new financial entity to the registry</p>
                    </div>
                </div>
                
                <form action="#" method="post" class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">Official Bank Name</label>
                            <div class="relative group/input">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400 group-focus-within/input:text-primary-500 transition-colors">
                                    <i data-lucide="landmark" class="w-5 h-5"></i>
                                </div>
                                <input type="text" name="bankname" placeholder="e.g. State Bank of India" required
                                       class="bg-slate-50 dark:bg-slate-900/50 border-none text-slate-900 dark:text-white text-sm rounded-[1.5rem] focus:ring-2 focus:ring-primary-500 block w-full pl-14 p-5 transition-premium shadow-inner">
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">Acronym / Short Name</label>
                            <div class="relative group/input">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400 group-focus-within/input:text-primary-500 transition-colors">
                                    <i data-lucide="hash" class="w-5 h-5"></i>
                                </div>
                                <input type="text" name="shortname" placeholder="e.g. SBI" required
                                       class="bg-slate-50 dark:bg-slate-900/50 border-none text-slate-900 dark:text-white text-sm rounded-[1.5rem] focus:ring-2 focus:ring-primary-500 block w-full pl-14 p-5 transition-premium shadow-inner">
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" name="submit" 
                                class="w-full sm:w-auto px-12 py-5 bg-primary-600 text-white rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-primary-700 transition-premium shadow-2xl shadow-primary-500/40 active:scale-95 flex items-center justify-center gap-3">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            Finalize Registration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mt-8 lg:mt-0">
        <div class="glass-card p-10 rounded-[3rem] h-full flex flex-col">
            <h3 class="text-xl font-black tracking-tight mb-8">Registration Guide</h3>
            <div class="space-y-8 flex-1">
                <div class="flex gap-4">
                    <div class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 flex items-center justify-center font-black text-xs shadow-inner shrink-0">1</div>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Ensure the bank name is spelled exactly as per RBI records to maintain data integrity.</p>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 rounded-xl bg-blue-50 dark:bg-blue-900/30 text-blue-600 flex items-center justify-center font-black text-xs shadow-inner shrink-0">2</div>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Short names are used in compact views and mobile application search filters.</p>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 rounded-xl bg-purple-50 dark:bg-purple-900/30 text-purple-600 flex items-center justify-center font-black text-xs shadow-inner shrink-0">3</div>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">After adding a bank, you can proceed to link branches in the "Manage Details" section.</p>
                </div>
            </div>
            
            <div class="mt-10 p-6 bg-slate-50 dark:bg-slate-900/50 rounded-3xl border border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-3 mb-3">
                    <i data-lucide="info" class="w-5 h-5 text-primary-500"></i>
                    <span class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-wider">Note</span>
                </div>
                <p class="text-[10px] font-bold text-slate-400 leading-relaxed">System automatically generates unique IDs and timestamps for every new entry.</p>
            </div>
        </div>
    </div>
</div>

<?php include_once('includes/modern-layout-bottom.php'); ?>
<?php } ?>