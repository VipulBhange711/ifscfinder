<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['ifscaid'])==0) {
    header('location:logout.php');
} else {
    // Code for deleting bank detail
    if(isset($_GET['delid'])) {
        $rid=intval($_GET['delid']);
        $sql="delete from tblbankdetail where ID=:rid";
        $query=$dbh->prepare($sql);
        $query->bindParam(':rid',$rid,PDO::PARAM_STR);
        $query->execute();
        echo "<script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    title: 'Deleted!',
                    text: 'Bank details have been removed successfully.',
                    icon: 'success',
                    confirmButtonColor: '#0ea5e9',
                    customClass: { popup: 'rounded-2xl glass' }
                }).then(() => {
                    window.location.href = 'manage-bank-detail.php';
                });
            });
        </script>"; 
    }

    $pageTitle = "Manage Bank Details";
    include_once('includes/modern-layout-top.php');
?>

<div class="row">
    <div class="col-12">
        <div class="glass-card p-10 rounded-[3rem]">
            <div class="flex flex-col md:flex-row items-center justify-between mb-10 gap-6">
                <div>
                    <h2 class="text-3xl font-black tracking-tighter mb-1">Bank Branch Registry</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Detailed IFSC and Branch management</p>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <a href="add-bank-detail.php" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest flex items-center transition-premium hover:scale-105 shadow-xl shadow-primary-500/25">
                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Register Branch
                    </a>
                </div>
            </div>

            <div class="relative overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 border-b border-slate-100 dark:border-slate-800">
                            <tr>
                                <th class="px-6 py-6">#</th>
                                <th class="px-6 py-6">Bank & Branch</th>
                                <th class="px-6 py-6">Region (State/City)</th>
                                <th class="px-6 py-6">IFSC Code</th>
                                <th class="px-6 py-6">Created On</th>
                                <th class="px-6 py-6 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800/50">
                            <?php
                            if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                                $page_no = $_GET['page_no'];
                            } else {
                                $page_no = 1;
                            }
                            $no_of_records_per_page = 15;
                            $offset = ($page_no-1) * $no_of_records_per_page;
                            
                            // Total rows for pagination
                            $ret = "SELECT tblbankdetail.ID FROM tblbankdetail";
                            $query1 = $dbh->prepare($ret);
                            $query1->execute();
                            $total_rows=$query1->rowCount();
                            $total_no_of_pages = ceil($total_rows / $no_of_records_per_page);

                            // Fetch records
                            $sql="SELECT tblbank.BankName as bn, tblbank.ShortName, tblstate.State, tblcity.City, tblbankdetail.IFSCCode, tblbankdetail.Branch, tblbankdetail.ID as bdid, tblbankdetail.CreationDate 
                                  FROM tblbankdetail 
                                  INNER JOIN tblstate ON tblbankdetail.StateID=tblstate.ID 
                                  JOIN tblcity ON tblbankdetail.CityID=tblcity.ID 
                                  JOIN tblbank ON tblbankdetail.BankName=tblbank.ID 
                                  ORDER BY tblbankdetail.CreationDate DESC
                                  LIMIT $offset, $no_of_records_per_page";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);

                            $cnt=1 + $offset;
                            if($query->rowCount() > 0) {
                                foreach($results as $row) { ?>
                                <tr class="group hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-premium">
                                    <td class="px-6 py-6">
                                        <span class="font-mono text-xs text-slate-400">#<?php echo $cnt; ?></span>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex flex-col">
                                            <span class="font-black text-slate-900 dark:text-white"><?php echo htmlentities($row->bn);?></span>
                                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider"><?php echo htmlentities($row->Branch); ?> Branch</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="map-pin" class="w-3 h-3 text-primary-500"></i>
                                            <span class="text-slate-600 dark:text-slate-400 font-medium"><?php echo htmlentities($row->State); ?>, <?php echo htmlentities($row->City); ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <span class="px-3 py-1 bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 rounded-lg font-mono font-bold text-xs"><?php echo htmlentities($row->IFSCCode); ?></span>
                                    </td>
                                    <td class="px-6 py-6 text-slate-500 text-xs font-medium">
                                        <?php echo date('M d, Y', strtotime($row->CreationDate)); ?>
                                    </td>
                                    <td class="px-6 py-6 text-right">
                                        <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-premium translate-x-4 group-hover:translate-x-0">
                                            <a href="edit-bank-detail.php?editid=<?php echo htmlentities ($row->bdid);?>" class="p-3 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-400 rounded-xl hover:text-primary-600 hover:shadow-lg transition-premium border border-slate-100 dark:border-slate-700">
                                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                                            </a>
                                            <button onclick="confirmDelete(<?php echo $row->bdid; ?>)" class="p-3 bg-white dark:bg-slate-800 text-red-400 rounded-xl hover:text-red-600 hover:shadow-lg transition-premium border border-slate-100 dark:border-slate-700">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php $cnt++; } } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex items-center justify-between bg-slate-50/50 dark:bg-slate-900/50 p-6 rounded-[2rem] border border-slate-100 dark:border-slate-800">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    Records <span class="text-slate-900 dark:text-white"><?php echo $offset + 1; ?>-<?php echo min($offset + $no_of_records_per_page, $total_rows); ?></span> of <?php echo $total_rows; ?>
                </p>
                <nav class="flex gap-2">
                    <?php if($page_no > 1): ?>
                        <a href="?page_no=<?php echo $page_no-1; ?>" class="p-3 rounded-xl bg-white dark:bg-slate-800 text-slate-600 border border-slate-100 dark:border-slate-700 hover:bg-primary-600 hover:text-white transition-premium"><i data-lucide="chevron-left" class="w-4 h-4"></i></a>
                    <?php endif; ?>
                    
                    <?php if($page_no < $total_no_of_pages): ?>
                        <a href="?page_no=<?php echo $page_no+1; ?>" class="p-3 rounded-xl bg-white dark:bg-slate-800 text-slate-600 border border-slate-100 dark:border-slate-700 hover:bg-primary-600 hover:text-white transition-premium"><i data-lucide="chevron-right" class="w-4 h-4"></i></a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Delete Branch?',
        text: "This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Yes, remove it!',
        customClass: { popup: 'rounded-[2rem] glass border-none' }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'manage-bank-detail.php?delid=' + id;
        }
    })
}
</script>

<?php include_once('includes/modern-layout-bottom.php'); ?>
<?php } ?>
