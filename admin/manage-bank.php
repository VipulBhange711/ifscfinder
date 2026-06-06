<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ifscaid'])==0) {
  header('location:logout.php');
} else {

// Code for deleting product from cart
if(isset($_GET['delid']))
{
$rid=intval($_GET['delid']);
$sql="delete from tblbank where ID=:rid";
$query=$dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->execute();
 echo "<script>
    document.addEventListener('DOMContentLoaded', () => {
        Swal.fire({
            title: 'Deleted!',
            text: 'Bank has been deleted successfully.',
            icon: 'success',
            confirmButtonColor: '#0ea5e9',
            customClass: { popup: 'rounded-2xl glass' }
        }).then(() => {
            window.location.href = 'manage-bank.php';
        });
    });
 </script>"; 
}

$pageTitle = "Manage Bank";
include_once('includes/modern-layout-top.php');
?>

<div class="row">
    <div class="col-12">
        <div class="glass-card p-10 rounded-[3rem]">
            <div class="flex flex-col md:flex-row items-center justify-between mb-10 gap-6">
                <div>
                    <h2 class="text-3xl font-black tracking-tighter mb-1">Manage Banks</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Global financial entities registry</p>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <div class="flex bg-slate-100 dark:bg-slate-800 p-1.5 rounded-2xl mr-2">
                        <a href="export-bank.php?format=csv" class="px-4 py-2 text-[10px] font-black uppercase tracking-wider hover:bg-white dark:hover:bg-slate-700 rounded-xl transition-premium flex items-center">
                            <i data-lucide="file-spreadsheet" class="w-3.5 h-3.5 mr-2 text-emerald-500"></i> CSV
                        </a>
                        <a href="export-bank.php?format=json" class="px-4 py-2 text-[10px] font-black uppercase tracking-wider hover:bg-white dark:hover:bg-slate-700 rounded-xl transition-premium flex items-center">
                            <i data-lucide="file-json" class="w-3.5 h-3.5 mr-2 text-amber-500"></i> JSON
                        </a>
                    </div>
                    <a href="add-bank.php" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest flex items-center transition-premium hover:scale-105 shadow-xl shadow-primary-500/25">
                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Register Bank
                    </a>
                </div>
            </div>

            <div class="relative overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 border-b border-slate-100 dark:border-slate-800">
                            <tr>
                                <th class="px-6 py-6">ID Reference</th>
                                <th class="px-6 py-6">Bank Entity</th>
                                <th class="px-6 py-6">System Entry Date</th>
                                <th class="px-6 py-6 text-right">Administrative Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800/50">
                            <?php
                            // ... existing pagination logic ...
                            $no_of_records_per_page = 15;
                            $offset = ($page_no-1) * $no_of_records_per_page;
                            $sql="SELECT * from tblbank LIMIT $offset, $no_of_records_per_page";
                            $query = $dbh -> prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1 + $offset;
                            if($query->rowCount() > 0) {
                                foreach($results as $row) { ?>
                                <tr class="group hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-premium">
                                    <td class="px-6 py-6">
                                        <span class="font-mono text-xs text-slate-400">#<?php echo str_pad($row->ID, 4, '0', STR_PAD_LEFT); ?></span>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center group-hover:bg-primary-500 group-hover:text-white transition-premium shadow-inner">
                                                <i data-lucide="landmark" class="w-5 h-5"></i>
                                            </div>
                                            <span class="font-black text-slate-900 dark:text-white"><?php echo htmlentities($row->BankName);?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 text-slate-500 font-medium">
                                        <?php echo date('M d, Y', strtotime($row->CreationDate)); ?>
                                    </td>
                                    <td class="px-6 py-6 text-right">
                                        <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-premium translate-x-4 group-hover:translate-x-0">
                                            <a href="edit-bank.php?editid=<?php echo htmlentities ($row->ID);?>" class="p-3 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-400 rounded-xl hover:text-primary-600 hover:shadow-lg transition-premium border border-slate-100 dark:border-slate-700">
                                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                                            </a>
                                            <button onclick="confirmDelete(<?php echo $row->ID; ?>)" class="p-3 bg-white dark:bg-slate-800 text-red-400 rounded-xl hover:text-red-600 hover:shadow-lg transition-premium border border-slate-100 dark:border-slate-700">
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

            <!-- Enhanced Pagination -->
            <div class="mt-12 flex items-center justify-between bg-slate-50/50 dark:bg-slate-900/50 p-6 rounded-[2rem] border border-slate-100 dark:border-slate-800">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    Showing <span class="text-slate-900 dark:text-white"><?php echo $offset + 1; ?></span> to <span class="text-slate-900 dark:text-white"><?php echo min($offset + $no_of_records_per_page, $total_rows); ?></span> of <?php echo $total_rows; ?> entries
                </p>
                <nav class="flex gap-2">
                    <?php if($page_no > 1): ?>
                        <a href="?page_no=<?php echo $page_no-1; ?>" class="p-3 rounded-xl bg-white dark:bg-slate-800 text-slate-600 border border-slate-100 dark:border-slate-700 hover:bg-primary-600 hover:text-white transition-premium"><i data-lucide="chevron-left" class="w-4 h-4"></i></a>
                    <?php endif; ?>
                    
                    <div class="flex gap-1">
                        <?php for($i=1; $i<=$total_no_of_pages; $i++): ?>
                            <?php if($i == $page_no): ?>
                                <span class="px-4 py-2 bg-primary-600 text-white rounded-xl font-black text-xs shadow-lg shadow-primary-500/30"><?php echo $i; ?></span>
                            <?php elseif($i == 1 || $i == $total_no_of_pages || ($i >= $page_no-1 && $i <= $page_no+1)): ?>
                                <a href="?page_no=<?php echo $i; ?>" class="px-4 py-2 bg-white dark:bg-slate-800 text-slate-500 rounded-xl font-bold text-xs hover:bg-slate-50 dark:hover:bg-slate-700 transition-premium border border-slate-100 dark:border-slate-700"><?php echo $i; ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>

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
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Yes, delete it!',
        customClass: { popup: 'rounded-2xl glass' }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'manage-bank.php?delid=' + id;
        }
    })
}
</script>

<?php include_once('includes/modern-layout-bottom.php'); ?>
<?php } ?>
