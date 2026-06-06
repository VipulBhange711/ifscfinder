<?php
// Modern Layout Bottom Helper
?>
        </div>
        
        <!-- Modern Footer -->
        <footer class="mt-8 p-4 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 flex flex-col md:flex-row items-center justify-between animate__animated animate__fadeIn">
            <div class="text-sm text-slate-500 dark:text-slate-400 mb-4 md:mb-0">
                &copy; <?php echo date('Y'); ?> IFSC Finder Portal. Version 2.0.0
            </div>
            <div class="flex items-center space-x-6">
                <div class="flex items-center">
                    <span class="flex h-2 w-2 mr-2">
                        <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    <span class="text-xs font-bold text-slate-600 dark:text-slate-400 uppercase tracking-tighter">System Online</span>
                </div>
                <div class="flex space-x-4">
                    <a href="guide.php" class="text-xs font-bold text-slate-400 hover:text-primary-600 transition-colors">Documentation</a>
                    <a href="#" class="text-xs font-bold text-slate-400 hover:text-primary-600 transition-colors">Support</a>
                    <a href="#" class="text-xs font-bold text-slate-400 hover:text-primary-600 transition-colors">Privacy</a>
                </div>
            </div>
        </footer>
    </div>
    <?php include_once('includes/modern-scripts.php');?>
</body>
</html>
