<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['ifscaid'])==0) {
    header('location:logout.php');
} else {
    if(isset($_POST['submit'])) {
        $ifscaid=$_SESSION['ifscaid'];
        $ifsccode=$_POST['ifsccode'];
        $micrcode=$_POST['micrcode'];
        $bankname=$_POST['bankname'];
        $address=$_POST['address'];
        $stateid=$_POST['stateid'];
        $city=$_POST['city'];
        $branch=$_POST['branch'];
        $phonenum=$_POST['phonenum'];
        $branchcode=$_POST['branchcode'];
        $zipcode=$_POST['zipcode'];

        $sql="insert into tblbankdetail(IFSCCode,MICRCode,BankName,Address,StateID,CityID,Branch,PhoneNumber,BranchCode,ZipCode)values(:ifsccode,:micrcode,:bankname,:address,:stateid,:city,:branch,:phonenum,:branchcode,:zipcode)";
        $query=$dbh->prepare($sql);
        $query->bindParam(':ifsccode',$ifsccode,PDO::PARAM_STR);
        $query->bindParam(':micrcode',$micrcode,PDO::PARAM_STR);
        $query->bindParam(':bankname',$bankname,PDO::PARAM_STR);
        $query->bindParam(':address',$address,PDO::PARAM_STR);
        $query->bindParam(':stateid',$stateid,PDO::PARAM_STR);
        $query->bindParam(':city',$city,PDO::PARAM_STR);
        $query->bindParam(':branch',$branch,PDO::PARAM_STR);
        $query->bindParam(':phonenum',$phonenum,PDO::PARAM_STR);
        $query->bindParam(':branchcode',$branchcode,PDO::PARAM_STR);
        $query->bindParam(':zipcode',$zipcode,PDO::PARAM_STR);
        $query->execute();

        $LastInsertId=$dbh->lastInsertId();
        if ($LastInsertId>0) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', () => {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Bank details have been added successfully.',
                        icon: 'success',
                        confirmButtonColor: '#0ea5e9',
                        customClass: { popup: 'rounded-2xl glass' }
                    }).then(() => {
                        window.location.href = 'add-bank-detail.php';
                    });
                });
            </script>";
        } else {
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

    $pageTitle = "Add Bank Detail";
    include_once('includes/modern-layout-top.php');
?>

<script>
function getcity(val) {
    $.ajax({
        type: "POST",
        url: "get-city.php",
        data: 'stateid=' + val,
        success: function(data) {
            $("#city").html(data);
        }
    });
}
</script>

<div class="row">
    <div class="col-lg-12">
        <div class="glass-card p-10 rounded-[3rem] relative overflow-hidden group">
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-primary-500/10 rounded-full blur-3xl group-hover:bg-primary-500/20 transition-premium"></div>
            
            <div class="relative z-10">
                <div class="flex items-center gap-6 mb-10">
                    <div class="p-4 bg-primary-600 text-white rounded-3xl shadow-xl shadow-primary-500/30">
                        <i data-lucide="plus-circle" class="w-8 h-8"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-black tracking-tighter mb-1">Add Bank Detail</h2>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Register specific branch and IFSC information</p>
                    </div>
                </div>
                
                <form action="#" method="post" class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Bank Select -->
                        <div class="space-y-3">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">Bank Entity</label>
                            <div class="relative group/input">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400 group-focus-within/input:text-primary-500 transition-colors">
                                    <i data-lucide="landmark" class="w-5 h-5"></i>
                                </div>
                                <select name="bankname" required class="bg-slate-50 dark:bg-slate-900/50 border-none text-slate-900 dark:text-white text-sm rounded-[1.5rem] focus:ring-2 focus:ring-primary-500 block w-full pl-14 p-5 transition-premium shadow-inner appearance-none">
                                    <option value="">Choose Bank</option>
                                    <?php 
                                    $sql2 = "SELECT * from tblbank";
                                    $query2 = $dbh->prepare($sql2);
                                    $query2->execute();
                                    $result2=$query2->fetchAll(PDO::FETCH_OBJ);
                                    foreach($result2 as $row) { ?>
                                        <option value="<?php echo htmlentities($row->ID);?>"><?php echo htmlentities($row->BankName);?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <!-- State Select -->
                        <div class="space-y-3">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">State Region</label>
                            <div class="relative group/input">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400 group-focus-within/input:text-primary-500 transition-colors">
                                    <i data-lucide="map" class="w-5 h-5"></i>
                                </div>
                                <select name="stateid" required onChange="getcity(this.value)" class="bg-slate-50 dark:bg-slate-900/50 border-none text-slate-900 dark:text-white text-sm rounded-[1.5rem] focus:ring-2 focus:ring-primary-500 block w-full pl-14 p-5 transition-premium shadow-inner appearance-none">
                                    <option value="">Select State</option>
                                    <?php 
                                    $sql2 = "SELECT * from tblstate";
                                    $query2 = $dbh->prepare($sql2);
                                    $query2->execute();
                                    $result2=$query2->fetchAll(PDO::FETCH_OBJ);
                                    foreach($result2 as $row1) { ?>
                                        <option value="<?php echo htmlentities($row1->ID);?>"><?php echo htmlentities($row1->State);?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <!-- City Select -->
                        <div class="space-y-3">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">City Node</label>
                            <div class="relative group/input">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400 group-focus-within/input:text-primary-500 transition-colors">
                                    <i data-lucide="navigation" class="w-5 h-5"></i>
                                </div>
                                <select name="city" id="city" required class="bg-slate-50 dark:bg-slate-900/50 border-none text-slate-900 dark:text-white text-sm rounded-[1.5rem] focus:ring-2 focus:ring-primary-500 block w-full pl-14 p-5 transition-premium shadow-inner appearance-none">
                                    <option value="">Select City</option>
                                </select>
                            </div>
                        </div>

                        <!-- IFSC Code -->
                        <div class="space-y-3">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">IFSC Code</label>
                            <div class="relative group/input">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400 group-focus-within/input:text-primary-500 transition-colors">
                                    <i data-lucide="hash" class="w-5 h-5"></i>
                                </div>
                                <input type="text" name="ifsccode" placeholder="Bank IFSC Code" required class="bg-slate-50 dark:bg-slate-900/50 border-none text-slate-900 dark:text-white text-sm rounded-[1.5rem] focus:ring-2 focus:ring-primary-500 block w-full pl-14 p-5 transition-premium shadow-inner">
                            </div>
                        </div>

                        <!-- MICR Code -->
                        <div class="space-y-3">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">MICR Code</label>
                            <div class="relative group/input">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400 group-focus-within/input:text-primary-500 transition-colors">
                                    <i data-lucide="cpu" class="w-5 h-5"></i>
                                </div>
                                <input type="text" name="micrcode" placeholder="MICR Code" required class="bg-slate-50 dark:bg-slate-900/50 border-none text-slate-900 dark:text-white text-sm rounded-[1.5rem] focus:ring-2 focus:ring-primary-500 block w-full pl-14 p-5 transition-premium shadow-inner">
                            </div>
                        </div>

                        <!-- Branch -->
                        <div class="space-y-3">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">Branch Name</label>
                            <div class="relative group/input">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400 group-focus-within/input:text-primary-500 transition-colors">
                                    <i data-lucide="git-branch" class="w-5 h-5"></i>
                                </div>
                                <input type="text" name="branch" placeholder="Branch Name" required class="bg-slate-50 dark:bg-slate-900/50 border-none text-slate-900 dark:text-white text-sm rounded-[1.5rem] focus:ring-2 focus:ring-primary-500 block w-full pl-14 p-5 transition-premium shadow-inner">
                            </div>
                        </div>

                        <!-- Branch Code -->
                        <div class="space-y-3">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">Branch Code</label>
                            <div class="relative group/input">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400 group-focus-within/input:text-primary-500 transition-colors">
                                    <i data-lucide="code" class="w-5 h-5"></i>
                                </div>
                                <input type="text" name="branchcode" placeholder="Branch Code" required class="bg-slate-50 dark:bg-slate-900/50 border-none text-slate-900 dark:text-white text-sm rounded-[1.5rem] focus:ring-2 focus:ring-primary-500 block w-full pl-14 p-5 transition-premium shadow-inner">
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="space-y-3">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">Contact Number</label>
                            <div class="relative group/input">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400 group-focus-within/input:text-primary-500 transition-colors">
                                    <i data-lucide="phone" class="w-5 h-5"></i>
                                </div>
                                <input type="text" name="phonenum" placeholder="Phone Number" pattern="[0-9]+" maxlength="10" class="bg-slate-50 dark:bg-slate-900/50 border-none text-slate-900 dark:text-white text-sm rounded-[1.5rem] focus:ring-2 focus:ring-primary-500 block w-full pl-14 p-5 transition-premium shadow-inner">
                            </div>
                        </div>

                        <!-- Zip Code -->
                        <div class="space-y-3">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">Zip Code</label>
                            <div class="relative group/input">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-slate-400 group-focus-within/input:text-primary-500 transition-colors">
                                    <i data-lucide="map-pin" class="w-5 h-5"></i>
                                </div>
                                <input type="text" name="zipcode" placeholder="Zip Code" required class="bg-slate-50 dark:bg-slate-900/50 border-none text-slate-900 dark:text-white text-sm rounded-[1.5rem] focus:ring-2 focus:ring-primary-500 block w-full pl-14 p-5 transition-premium shadow-inner">
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="space-y-3">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">Full Address</label>
                        <div class="relative group/input">
                            <div class="absolute top-5 left-5 pointer-events-none text-slate-400 group-focus-within/input:text-primary-500 transition-colors">
                                <i data-lucide="home" class="w-5 h-5"></i>
                            </div>
                            <textarea name="address" rows="3" placeholder="Full Branch Address" required class="bg-slate-50 dark:bg-slate-900/50 border-none text-slate-900 dark:text-white text-sm rounded-[1.5rem] focus:ring-2 focus:ring-primary-500 block w-full pl-14 p-5 transition-premium shadow-inner"></textarea>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" name="submit" 
                                class="w-full sm:w-auto px-12 py-5 bg-primary-600 text-white rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-primary-700 transition-premium shadow-2xl shadow-primary-500/40 active:scale-95 flex items-center justify-center gap-3">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            Register Branch Details
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once('includes/modern-layout-bottom.php'); ?>
<?php } ?>
