<?php
session_start();
include('admin/includes/dbconnection.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results | IFSC Code Finder Portal</title>
    <?php include_once('includes/public-header.php'); ?>
</head>

<body class="bg-slate-50 font-sans text-slate-900 antialiased selection:bg-primary-500/30">

    <!-- Page Header / Search Again -->
    <section class="pt-40 pb-20 relative overflow-hidden bg-white">
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
            <div class="absolute top-[-10%] right-[-5%] w-[40%] h-[40%] bg-primary-500/5 rounded-full blur-[100px]"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center space-y-8">
            <h1 class="text-4xl lg:text-5xl font-black tracking-tighter">Search <span class="text-primary-600">Results</span></h1>
            
            <!-- Mini Search Bar -->
            <div class="max-w-2xl mx-auto">
                <form action="search.php" method="post" class="relative group">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-6 pointer-events-none text-slate-400 group-focus-within:text-primary-600 transition-colors">
                        <i data-lucide="search" class="w-5 h-5"></i>
                    </div>
                    <input type="text" name="searchifsccode" value="<?php echo isset($_POST['searchifsccode']) ? htmlentities($_POST['searchifsccode']) : ''; ?>" required
                           class="w-full bg-slate-50 border-none text-slate-900 text-base rounded-3xl pl-14 pr-32 py-5 shadow-inner focus:ring-4 focus:ring-primary-100 transition-premium"
                           placeholder="Search again...">
                    <button type="submit" name="search"
                            class="absolute right-2 top-2 bottom-2 px-6 bg-primary-600 text-white rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-primary-700 transition-premium">
                        Find
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Results Section -->
    <section class="py-24 relative min-h-[400px]">
        <div class="container mx-auto px-6">
            <?php
            if (isset($_POST['search'])) {
                $searchifsccode = $_POST['searchifsccode'];
            ?>
                <div class="mb-12 flex items-center justify-between">
                    <p class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Showing results for: <span class="text-slate-900"><?php echo htmlentities($searchifsccode); ?></span></p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    $sql = "SELECT tblbank.BankName as bn, tblbank.ShortName, tblstate.State, tblcity.City, tblbankdetail.IFSCCode, tblbankdetail.Branch, tblbankdetail.Address, tblbankdetail.MICRCode, tblbankdetail.PhoneNumber 
                            FROM tblbankdetail 
                            INNER JOIN tblstate ON tblbankdetail.StateID=tblstate.ID 
                            JOIN tblcity ON tblbankdetail.CityID=tblcity.ID 
                            JOIN tblbank ON tblbankdetail.BankName=tblbank.ID 
                            WHERE tblbank.BankName LIKE :s OR tblbankdetail.IFSCCode LIKE :s OR tblbankdetail.ZipCode LIKE :s OR tblbankdetail.Branch LIKE :s";
                    $query = $dbh->prepare($sql);
                    $s = "%$searchifsccode%";
                    $query->bindParam(':s', $s, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    if ($query->rowCount() > 0) {
                        foreach ($results as $row) {
                    ?>
                            <div class="glass-card p-8 rounded-[2.5rem] group hover:bg-white transition-premium animate__animated animate__fadeInUp">
                                <div class="flex items-start justify-between mb-8">
                                    <div class="p-4 bg-primary-50 dark:bg-primary-900/30 text-primary-600 rounded-2xl group-hover:bg-primary-600 group-hover:text-white transition-premium">
                                        <i data-lucide="landmark" class="w-6 h-6"></i>
                                    </div>
                                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest">Verified</span>
                                </div>
                                
                                <div class="space-y-4">
                                    <h3 class="text-xl font-black text-slate-900 tracking-tight leading-tight group-hover:text-primary-600 transition-colors">
                                        <?php echo htmlentities($row->bn); ?>
                                    </h3>
                                    <div class="space-y-2">
                                        <div class="flex items-center gap-3 text-sm font-bold text-slate-500">
                                            <i data-lucide="git-branch" class="w-4 h-4 text-slate-400"></i>
                                            <?php echo htmlentities($row->Branch); ?> Branch
                                        </div>
                                        <div class="flex items-center gap-3 text-sm font-bold text-slate-500">
                                            <i data-lucide="map-pin" class="w-4 h-4 text-slate-400"></i>
                                            <?php echo htmlentities($row->State); ?>, <?php echo htmlentities($row->City); ?>
                                        </div>
                                    </div>

                                    <div class="pt-6 grid grid-cols-2 gap-4">
                                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 group-hover:bg-white transition-premium">
                                            <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">IFSC Code</p>
                                            <p class="text-xs font-black text-primary-600 font-mono"><?php echo htmlentities($row->IFSCCode); ?></p>
                                        </div>
                                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 group-hover:bg-white transition-premium">
                                            <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">MICR Code</p>
                                            <p class="text-xs font-black text-slate-900 font-mono"><?php echo htmlentities($row->MICRCode); ?></p>
                                        </div>
                                    </div>

                                    <div class="pt-4 border-t border-slate-100 mt-6 hidden group-hover:block animate__animated animate__fadeIn">
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Full Address</p>
                                        <p class="text-xs text-slate-600 leading-relaxed font-medium"><?php echo htmlentities($row->Address); ?></p>
                                        <div class="flex items-center gap-2 mt-4 text-primary-600">
                                            <i data-lucide="phone" class="w-3 h-3"></i>
                                            <span class="text-xs font-bold"><?php echo htmlentities($row->PhoneNumber); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                    ?>
                        <div class="col-span-full py-20 text-center space-y-6">
                            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-slate-300">
                                <i data-lucide="search-x" class="w-10 h-10"></i>
                            </div>
                            <h3 class="text-2xl font-black text-slate-900">No results found</h3>
                            <p class="text-slate-500 font-medium">We couldn't find any bank details matching "<?php echo htmlentities($searchifsccode); ?>". Please check the spelling or try a different term.</p>
                            <a href="index.php" class="inline-flex px-8 py-4 bg-primary-600 text-white rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-primary-700 transition-premium shadow-xl shadow-primary-500/20">Return Home</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            <?php } ?>
        </div>
    </section>

    <?php include_once('includes/public-footer.php'); ?>

</body>

</html>
