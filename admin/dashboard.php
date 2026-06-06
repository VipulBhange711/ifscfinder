<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ifscaid'])==0) {
  header('location:logout.php');
} else {
    $pageTitle = "Dashboard Overview";
    include_once('includes/modern-layout-top.php');

    // Fetch metrics
    $sql1 ="SELECT * from tblbank";
    $query1 = $dbh->prepare($sql1);
    $query1->execute();
    $totbank = $query1->rowCount();

    $sql2 ="SELECT * from tblstate";
    $query2 = $dbh->prepare($sql2);
    $query2->execute();
    $totstate = $query2->rowCount();

    $sql3 ="SELECT * from tblcity";
    $query3 = $dbh->prepare($sql3);
    $query3->execute();
    $totcity = $query3->rowCount();

    // Fetch Growth Data (Last 6 Months)
    $months = [];
    $counts = [];
    for ($i = 5; $i >= 0; $i--) {
        $monthName = date('M', strtotime("-$i months"));
        $monthNum = date('m', strtotime("-$i months"));
        $year = date('Y', strtotime("-$i months"));
        
        $sqlG = "SELECT 
                    ((SELECT COUNT(*) FROM tblbank WHERE MONTH(CreationDate) = :m1 AND YEAR(CreationDate) = :y1) +
                     (SELECT COUNT(*) FROM tblstate WHERE MONTH(CreationDate) = :m2 AND YEAR(CreationDate) = :y2) +
                     (SELECT COUNT(*) FROM tblcity WHERE MONTH(CreationDate) = :m3 AND YEAR(CreationDate) = :y3)) as total";
        $queryG = $dbh->prepare($sqlG);
        $queryG->bindParam(':m1', $monthNum, PDO::PARAM_INT);
        $queryG->bindParam(':y1', $year, PDO::PARAM_INT);
        $queryG->bindParam(':m2', $monthNum, PDO::PARAM_INT);
        $queryG->bindParam(':y2', $year, PDO::PARAM_INT);
        $queryG->bindParam(':m3', $monthNum, PDO::PARAM_INT);
        $queryG->bindParam(':y3', $year, PDO::PARAM_INT);
        $queryG->execute();
        $rowG = $queryG->fetch(PDO::FETCH_ASSOC);
        
        $months[] = $monthName;
        $counts[] = (int)$rowG['total'];
    }

    // Fetch Recent Activity
    $sqlActivity = "(SELECT 'Bank' as type, BankName as title, CreationDate, 'plus' as icon, 'emerald' as color FROM tblbank)
                    UNION
                    (SELECT 'State' as type, State as title, CreationDate, 'map' as icon, 'purple' as color FROM tblstate)
                    UNION
                    (SELECT 'City' as type, City as title, CreationDate, 'navigation' as icon, 'blue' as color FROM tblcity)
                    UNION
                    (SELECT 'Detail' as type, Branch as title, CreationDate, 'git-branch' as icon, 'amber' as color FROM tblbankdetail)
                    ORDER BY CreationDate DESC LIMIT 5";
    $queryActivity = $dbh->prepare($sqlActivity);
    $queryActivity->execute();
    $activities = $queryActivity->fetchAll(PDO::FETCH_OBJ);
?>

<!-- Metric Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
    <!-- Card 1: Banks -->
    <div class="glass-card p-8 rounded-[2.5rem] relative overflow-hidden group hover:scale-[1.02] transition-premium">
        <div class="absolute -right-6 -top-6 w-32 h-32 bg-blue-500/10 rounded-full blur-3xl group-hover:bg-blue-500/20 transition-premium"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-6">
                <div class="p-4 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-2xl group-hover:bg-blue-600 group-hover:text-white transition-premium shadow-lg shadow-blue-500/10">
                    <i data-lucide="landmark" class="w-7 h-7"></i>
                </div>
                <div class="flex flex-col items-end">
                    <span class="text-[10px] font-black text-blue-600 dark:text-blue-400 uppercase tracking-widest bg-blue-50 dark:bg-blue-900/30 px-3 py-1.5 rounded-full mb-1">+12% growth</span>
                    <span class="text-[10px] font-bold text-slate-400">vs last month</span>
                </div>
            </div>
            <p class="text-slate-500 dark:text-slate-400 text-xs font-black uppercase tracking-[0.2em] mb-2">Registered Banks</p>
            <div class="flex items-baseline gap-2">
                <h2 class="text-5xl font-black tracking-tighter"><?php echo htmlentities($totbank);?></h2>
                <span class="text-sm font-bold text-slate-400">entities</span>
            </div>
            <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                <a href="manage-bank.php" class="text-xs font-black text-blue-600 hover:text-blue-700 flex items-center group/link">
                    Explore Database <i data-lucide="arrow-right" class="w-3 h-3 ml-2 group-hover/link:translate-x-1 transition-transform"></i>
                </a>
                <div class="flex -space-x-2">
                    <div class="w-6 h-6 rounded-full border-2 border-white dark:border-slate-800 bg-slate-200"></div>
                    <div class="w-6 h-6 rounded-full border-2 border-white dark:border-slate-800 bg-slate-300"></div>
                    <div class="w-6 h-6 rounded-full border-2 border-white dark:border-slate-800 bg-slate-400"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2: States -->
    <div class="glass-card p-8 rounded-[2.5rem] relative overflow-hidden group hover:scale-[1.02] transition-premium">
        <div class="absolute -right-6 -top-6 w-32 h-32 bg-purple-500/10 rounded-full blur-3xl group-hover:bg-purple-500/20 transition-premium"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-6">
                <div class="p-4 bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 rounded-2xl group-hover:bg-purple-600 group-hover:text-white transition-premium shadow-lg shadow-purple-500/10">
                    <i data-lucide="map" class="w-7 h-7"></i>
                </div>
                <div class="flex flex-col items-end">
                    <span class="text-[10px] font-black text-purple-600 dark:text-purple-400 uppercase tracking-widest bg-purple-50 dark:bg-purple-900/30 px-3 py-1.5 rounded-full mb-1">Coverage High</span>
                    <span class="text-[10px] font-bold text-slate-400">All regions active</span>
                </div>
            </div>
            <p class="text-slate-500 dark:text-slate-400 text-xs font-black uppercase tracking-[0.2em] mb-2">Total States</p>
            <div class="flex items-baseline gap-2">
                <h2 class="text-5xl font-black tracking-tighter"><?php echo htmlentities($totstate);?></h2>
                <span class="text-sm font-bold text-slate-400">regions</span>
            </div>
            <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                <a href="manage-state.php" class="text-xs font-black text-purple-600 hover:text-purple-700 flex items-center group/link">
                    Regional Insights <i data-lucide="arrow-right" class="w-3 h-3 ml-2 group-hover/link:translate-x-1 transition-transform"></i>
                </a>
                <div class="w-16 h-1 bg-purple-100 dark:bg-purple-900/30 rounded-full overflow-hidden">
                    <div class="w-3/4 h-full bg-purple-500"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3: Cities -->
    <div class="glass-card p-8 rounded-[2.5rem] relative overflow-hidden group hover:scale-[1.02] transition-premium">
        <div class="absolute -right-6 -top-6 w-32 h-32 bg-emerald-500/10 rounded-full blur-3xl group-hover:bg-emerald-500/20 transition-premium"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-6">
                <div class="p-4 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-2xl group-hover:bg-emerald-600 group-hover:text-white transition-premium shadow-lg shadow-emerald-500/10">
                    <i data-lucide="navigation" class="w-7 h-7"></i>
                </div>
                <div class="flex flex-col items-end">
                    <span class="text-[10px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-widest bg-emerald-50 dark:bg-emerald-900/30 px-3 py-1.5 rounded-full mb-1">Trending Up</span>
                    <span class="text-[10px] font-bold text-slate-400">New nodes added</span>
                </div>
            </div>
            <p class="text-slate-500 dark:text-slate-400 text-xs font-black uppercase tracking-[0.2em] mb-2">Mapped Cities</p>
            <div class="flex items-baseline gap-2">
                <h2 class="text-5xl font-black tracking-tighter"><?php echo htmlentities($totcity);?></h2>
                <span class="text-sm font-bold text-slate-400">locations</span>
            </div>
            <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                <a href="manage-city.php" class="text-xs font-black text-emerald-600 hover:text-emerald-700 flex items-center group/link">
                    View Network <i data-lucide="arrow-right" class="w-3 h-3 ml-2 group-hover/link:translate-x-1 transition-transform"></i>
                </a>
                <i data-lucide="trending-up" class="text-emerald-500 w-5 h-5"></i>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
    <div class="lg:col-span-2 glass-card p-10 rounded-[2.5rem] relative overflow-hidden">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="text-2xl font-black tracking-tight mb-1">Analytics Overview</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Growth metrics & distribution</p>
            </div>
            <div class="flex gap-2">
                <button class="px-4 py-2 bg-slate-50 dark:bg-slate-800 rounded-xl text-[10px] font-black uppercase tracking-wider hover:bg-primary-500 hover:text-white transition-premium">Weekly</button>
                <button class="px-4 py-2 bg-primary-600 text-white rounded-xl text-[10px] font-black uppercase tracking-wider shadow-lg shadow-primary-500/30">Monthly</button>
            </div>
        </div>
        <div class="h-[350px]">
            <canvas id="growthChart"></canvas>
        </div>
    </div>
    
    <div class="glass-card p-10 rounded-[2.5rem] flex flex-col">
        <div class="mb-10 text-center">
            <h2 class="text-2xl font-black tracking-tight mb-1">Distribution</h2>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Data split by type</p>
        </div>
        <div class="flex-1 flex items-center justify-center relative">
            <canvas id="distributionChart"></canvas>
            <div class="absolute flex flex-col items-center justify-center">
                <span class="text-3xl font-black tracking-tighter"><?php echo $totbank + $totstate + $totcity; ?></span>
                <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Total Items</span>
            </div>
        </div>
        <div class="mt-10 grid grid-cols-3 gap-2">
            <div class="text-center">
                <div class="w-2 h-2 rounded-full bg-blue-500 mx-auto mb-2"></div>
                <p class="text-[10px] font-bold text-slate-500">Banks</p>
            </div>
            <div class="text-center">
                <div class="w-2 h-2 rounded-full bg-purple-500 mx-auto mb-2"></div>
                <p class="text-[10px] font-bold text-slate-500">States</p>
            </div>
            <div class="text-center">
                <div class="w-2 h-2 rounded-full bg-emerald-500 mx-auto mb-2"></div>
                <p class="text-[10px] font-bold text-slate-500">Cities</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity Feed -->
<div class="glass-card p-10 rounded-[3rem]">
    <div class="flex items-center justify-between mb-10">
        <div>
            <h2 class="text-2xl font-black tracking-tight mb-1">Activity Stream</h2>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Latest administrative actions</p>
        </div>
    </div>
    
    <div class="space-y-6">
        <?php if($activities): foreach($activities as $act): ?>
        <!-- Activity Item -->
        <div class="flex items-start gap-6 p-6 rounded-3xl hover:bg-slate-50 dark:hover:bg-slate-900/50 transition-premium group border border-transparent hover:border-slate-100 dark:hover:border-slate-800">
            <div class="p-4 bg-<?php echo $act->color; ?>-100 dark:bg-<?php echo $act->color; ?>-900/30 text-<?php echo $act->color; ?>-600 rounded-2xl shadow-inner group-hover:scale-110 transition-premium">
                <i data-lucide="<?php echo $act->icon; ?>" class="w-6 h-6"></i>
            </div>
            <div class="flex-1">
                <div class="flex items-center justify-between mb-1">
                    <h4 class="font-bold text-slate-900 dark:text-white">New <?php echo $act->type; ?> Registered</h4>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest"><?php echo date('M d, H:i', strtotime($act->CreationDate)); ?></span>
                </div>
                <p class="text-sm text-slate-500 dark:text-slate-400"><?php echo htmlentities($act->title); ?> has been successfully added to the database.</p>
                <div class="mt-4 flex gap-2">
                    <span class="px-3 py-1 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-full text-[10px] font-bold text-slate-500"><?php echo strtoupper($act->type); ?></span>
                    <span class="px-3 py-1 bg-<?php echo $act->color; ?>-50 dark:bg-<?php echo $act->color; ?>-900/30 text-<?php echo $act->color; ?>-600 rounded-full text-[10px] font-bold">LIVE</span>
                </div>
            </div>
        </div>
        <?php endforeach; else: ?>
        <div class="text-center py-10">
            <p class="text-slate-400 font-bold">No recent activity found.</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Ensure Chart.js is loaded
        if (typeof Chart === 'undefined') {
            console.error('Chart.js failed to load');
            return;
        }

        // Advanced Distribution Chart
        const ctx1 = document.getElementById('distributionChart').getContext('2d');
        new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['Banks', 'States', 'Cities'],
                datasets: [{
                    data: [<?php echo $totbank; ?>, <?php echo $totstate; ?>, <?php echo $totcity; ?>],
                    backgroundColor: ['#3b82f6', '#8b5cf6', '#10b981'],
                    hoverBackgroundColor: ['#2563eb', '#7c3aed', '#059669'],
                    borderWidth: 0,
                    borderRadius: 10,
                    spacing: 5
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                cutout: '85%',
                responsive: true,
                maintainAspectRatio: false,
                animation: { animateScale: true, animateRotate: true }
            }
        });

        // Advanced Growth Chart
        const ctx2 = document.getElementById('growthChart').getContext('2d');
        const gradient = ctx2.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(14, 165, 233, 0.4)');
        gradient.addColorStop(1, 'rgba(14, 165, 233, 0)');

        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($months); ?>,
                datasets: [{
                    label: 'New Records',
                    data: <?php echo json_encode($counts); ?>,
                    borderColor: '#0ea5e9',
                    borderWidth: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#0ea5e9',
                    pointBorderWidth: 3,
                    pointRadius: 6,
                    pointHoverRadius: 10,
                    fill: true,
                    backgroundColor: gradient,
                    tension: 0.4
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { 
                        beginAtZero: true,
                        grid: { display: true, color: 'rgba(0,0,0,0.03)' },
                        ticks: { font: { weight: 'bold' } }
                    },
                    x: { 
                        grid: { display: false },
                        ticks: { font: { weight: 'bold' } }
                    }
                }
            }
        });

        // Initialize icons again to be safe
        if (typeof initIcons === 'function') initIcons();
    });
</script>

<?php include_once('includes/modern-layout-bottom.php'); ?>
<?php } ?>
