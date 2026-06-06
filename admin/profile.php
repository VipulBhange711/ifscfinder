<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ifscaid'])==0) {
    header('location:logout.php');
} else {
    if(isset($_POST['submit'])) {
        $adminid=$_SESSION['ifscaid'];
        $AName=$_POST['adminname'];
        $mobno=$_POST['mobilenumber'];
        $address=$_POST['address'];
        $email=$_POST['email'];
        
        // Handle Image Upload
        $profileimg = $_FILES["profileimage"]["name"];
        if($profileimg != "") {
            $extension = substr($profileimg, strlen($profileimg)-4, strlen($profileimg));
            $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
            if(!in_array($extension, $allowed_extensions)) {
                echo "<script>alert('Invalid format. Only jpg / jpeg/ png / gif format allowed');</script>";
            } else {
                $imgnewfile = md5($profileimg).time().$extension;
                move_uploaded_file($_FILES["profileimage"]["tmp_name"], "assets/images/users/".$imgnewfile);
                $sql="update tbladmin set AdminName=:adminname,MobileNumber=:mobilenumber,Email=:email,Address=:address,ProfileImage=:profileimage where ID=:aid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':profileimage',$imgnewfile,PDO::PARAM_STR);
            }
        } else {
            $sql="update tbladmin set AdminName=:adminname,MobileNumber=:mobilenumber,Email=:email,Address=:address where ID=:aid";
            $query = $dbh->prepare($sql);
        }

        $query->bindParam(':adminname',$AName,PDO::PARAM_STR);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->bindParam(':mobilenumber',$mobno,PDO::PARAM_STR);
        $query->bindParam(':address',$address,PDO::PARAM_STR);
        $query->bindParam(':aid',$adminid,PDO::PARAM_STR);
        $query->execute();

        echo "<script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    title: 'Success!',
                    text: 'Your profile has been updated successfully.',
                    icon: 'success',
                    confirmButtonColor: '#0ea5e9',
                    customClass: { popup: 'rounded-2xl glass' }
                }).then(() => {
                    window.location.href = 'profile.php';
                });
            });
        </script>";
    }

    $pageTitle = "Admin Profile";
    include_once('includes/modern-layout-top.php');
?>

<div class="row">
    <div class="col-lg-8">
        <div class="glass p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group">
            <div class="absolute -top-24 -right-24 w-48 h-48 bg-primary-500/10 rounded-full blur-3xl group-hover:bg-primary-500/20 transition-all duration-500"></div>
            
            <div class="relative z-10">
                <h2 class="text-2xl font-bold mb-8 flex items-center">
                    <div class="p-3 bg-primary-100 dark:bg-primary-900/30 rounded-2xl mr-4">
                        <i data-lucide="user" class="text-primary-600"></i>
                    </div>
                    Profile Settings
                </h2>
                
                <form action="#" method="post" enctype="multipart/form-data" class="space-y-6">
                    <?php
                    $sql="SELECT * from tbladmin where ID=:aid";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':aid', $_SESSION['ifscaid'], PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount() > 0) {
                        foreach($results as $row) {
                    ?>
                    <div class="flex flex-col md:flex-row gap-8 items-start mb-8">
                        <div class="relative group/avatar">
                            <div class="w-32 h-32 rounded-3xl overflow-hidden border-4 border-white dark:border-slate-800 shadow-xl">
                                <img id="profile-preview" src="<?php echo $row->ProfileImage ? 'assets/images/users/'.$row->ProfileImage : 'assets/images/users/avatar-1.jpg'; ?>" 
                                     class="w-full h-full object-cover" alt="Profile">
                            </div>
                            <label for="profileimage" class="absolute -bottom-2 -right-2 p-2 bg-primary-600 text-white rounded-xl shadow-lg cursor-pointer hover:bg-primary-700 transition-all hover:scale-110">
                                <i data-lucide="camera" class="w-5 h-5"></i>
                                <input type="file" name="profileimage" id="profileimage" class="hidden" accept="image/*" onchange="previewImage(this)">
                            </label>
                        </div>
                        <div class="flex-1 space-y-1">
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white"><?php echo $row->AdminName; ?></h3>
                            <p class="text-slate-500 dark:text-slate-400">@<?php echo $row->UserName; ?></p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 mt-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2"></span>
                                Administrator
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1">Admin Name</label>
                            <div class="relative group/input">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within/input:text-primary-500 transition-colors">
                                    <i data-lucide="user" class="w-5 h-5"></i>
                                </div>
                                <input type="text" name="adminname" value="<?php echo $row->AdminName; ?>" required
                                       class="bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-2xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full pl-12 p-4 transition-all duration-300">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1">Username</label>
                            <div class="relative group/input">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                                    <i data-lucide="at-sign" class="w-5 h-5"></i>
                                </div>
                                <input type="text" value="<?php echo $row->UserName; ?>" readonly
                                       class="bg-slate-100 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-500 text-sm rounded-2xl block w-full pl-12 p-4 cursor-not-allowed">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1">Contact Number</label>
                            <div class="relative group/input">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within/input:text-primary-500 transition-colors">
                                    <i data-lucide="phone" class="w-5 h-5"></i>
                                </div>
                                <input type="text" name="mobilenumber" value="<?php echo $row->MobileNumber; ?>" required maxlength="10" pattern="[0-9]+"
                                       class="bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-2xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full pl-12 p-4 transition-all duration-300">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1">Email Address</label>
                            <div class="relative group/input">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within/input:text-primary-500 transition-colors">
                                    <i data-lucide="mail" class="w-5 h-5"></i>
                                </div>
                                <input type="email" name="email" value="<?php echo $row->Email; ?>" required
                                       class="bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-2xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full pl-12 p-4 transition-all duration-300">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1">Address</label>
                        <div class="relative group/input">
                            <div class="absolute top-4 left-4 pointer-events-none text-slate-400 group-focus-within/input:text-primary-500 transition-colors">
                                <i data-lucide="map-pin" class="w-5 h-5"></i>
                            </div>
                            <textarea name="address" rows="3"
                                      class="bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white text-sm rounded-2xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full pl-12 p-4 transition-all duration-300"><?php echo $row->Address; ?></textarea>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" name="submit" 
                                class="group relative inline-flex items-center justify-center w-full sm:w-auto px-10 py-4 font-bold text-white transition-all duration-200 bg-primary-600 font-pj rounded-2xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-600 hover:bg-primary-700 shadow-xl shadow-primary-500/20 active:scale-95">
                            <span class="flex items-center">
                                <i data-lucide="save" class="w-5 h-5 mr-2"></i>
                                Update Profile
                            </span>
                        </button>
                    </div>
                    <?php }} ?>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mt-6 lg:mt-0">
        <div class="glass p-8 rounded-3xl border border-slate-200 dark:border-slate-800 h-full">
            <h4 class="text-lg font-bold mb-6 flex items-center">
                <i data-lucide="shield-check" class="w-5 h-5 mr-2 text-primary-600"></i>
                Security Information
            </h4>
            <div class="space-y-4">
                <div class="p-4 bg-slate-50 dark:bg-slate-900/50 rounded-2xl border border-slate-100 dark:border-slate-800">
                    <p class="text-xs text-slate-500 uppercase tracking-widest font-bold mb-1">Last Updated</p>
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Just now</p>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-900/50 rounded-2xl border border-slate-100 dark:border-slate-800">
                    <p class="text-xs text-slate-500 uppercase tracking-widest font-bold mb-1">Registration Date</p>
                    <p class="text-sm font-semibold text-slate-900 dark:text-white"><?php echo $row->AdminRegdate; ?></p>
                </div>
                <div class="pt-4">
                    <a href="change-password.php" class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-900/50 rounded-2xl border border-slate-100 dark:border-slate-800 hover:border-primary-500 transition-all group">
                        <div class="flex items-center">
                            <i data-lucide="key" class="w-5 h-5 mr-3 text-slate-400 group-hover:text-primary-600"></i>
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Change Password</span>
                        </div>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?php include_once('includes/modern-layout-bottom.php'); ?>
<?php } ?>
