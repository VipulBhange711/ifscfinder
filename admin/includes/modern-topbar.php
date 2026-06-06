<nav class="fixed top-0 z-30 w-full glass border-b border-slate-200 dark:border-slate-800 sm:pl-72 transition-premium">
    <div class="px-4 py-3 lg:px-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button data-drawer-target="sidebar" data-drawer-toggle="sidebar" aria-controls="sidebar" type="button" class="inline-flex items-center p-2 text-sm text-slate-500 rounded-xl sm:hidden hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-200 dark:text-slate-400 dark:hover:bg-slate-800 transition-colors">
                    <span class="sr-only">Open sidebar</span>
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                
                <!-- Advanced Search Bar -->
                <div class="hidden md:block ml-4 relative group">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none transition-colors group-focus-within:text-primary-500">
                        <i data-lucide="search" class="w-4 h-4 text-slate-400"></i>
                    </div>
                    <input type="text" id="command-palette-trigger" onclick="openCommandPalette()"
                           class="bg-slate-100/50 border-none text-slate-900 text-sm rounded-2xl focus:ring-2 focus:ring-primary-500 block w-96 pl-12 p-3 dark:bg-slate-800/50 dark:placeholder-slate-500 dark:text-white transition-premium cursor-pointer" 
                           placeholder="Quick search... (Ctrl + K)" readonly>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <kbd class="px-2 py-1 text-[10px] font-black text-slate-400 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg shadow-sm">CTRL K</kbd>
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Theme Toggle -->
                <button onclick="toggleTheme()" class="p-2.5 text-slate-500 rounded-2xl hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800 transition-premium hover:rotate-12">
                    <i data-lucide="sun" class="hidden dark:block w-5 h-5"></i>
                    <i data-lucide="moon" class="block dark:hidden w-5 h-5"></i>
                </button>

                <!-- Notification Center -->
                <div class="relative group">
                    <button class="p-2.5 text-slate-500 rounded-2xl hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800 transition-premium group-hover:shake">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                        <span class="absolute top-2.5 right-2.5 flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500 border-2 border-white dark:border-slate-900"></span>
                        </span>
                    </button>
                </div>

                <div class="h-8 w-[1px] bg-slate-200 dark:bg-slate-800 mx-2"></div>

                <!-- User Profile -->
                <?php
                $aid = $_SESSION['ifscaid'];
                $sql = "SELECT AdminName, Email, ProfileImage from tbladmin where ID=:aid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':aid', $aid, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                    foreach ($results as $row) {
                ?>
                <div class="flex items-center ml-2">
                    <button type="button" class="flex items-center gap-3 p-1.5 pr-4 text-sm bg-white dark:bg-slate-800 rounded-2xl focus:ring-4 focus:ring-primary-100 dark:focus:ring-primary-900 shadow-sm border border-slate-100 dark:border-slate-700 transition-premium hover:border-primary-300" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                        <div class="w-9 h-9 rounded-xl overflow-hidden shadow-inner border border-slate-100 dark:border-slate-700">
                            <img class="w-full h-full object-cover" src="<?php echo $row->ProfileImage ? 'assets/images/users/'.$row->ProfileImage : 'assets/images/users/avatar-1.jpg'; ?>" alt="User Avatar">
                        </div>
                        <div class="hidden lg:flex flex-col text-left">
                            <span class="text-xs font-black text-slate-900 dark:text-white leading-none mb-1"><?php echo $row->AdminName; ?></span>
                            <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Super Admin</span>
                        </div>
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400"></i>
                    </button>
                    
                    <!-- Premium Dropdown Menu -->
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-slate-100 rounded-[1.5rem] shadow-3xl dark:bg-slate-800 dark:divide-slate-700 glass border-none overflow-hidden min-w-[240px]" id="dropdown-user">
                        <div class="px-6 py-5 bg-gradient-to-br from-slate-50 to-white dark:from-slate-800/50 dark:to-slate-800">
                            <p class="text-sm text-slate-900 dark:text-white font-black mb-1"><?php echo $row->AdminName; ?></p>
                            <p class="text-xs font-medium text-slate-500 truncate dark:text-slate-400"><?php echo $row->Email; ?></p>
                        </div>
                        <ul class="p-2 space-y-1" role="none">
                            <li>
                                <a href="profile.php" class="flex items-center px-4 py-3 text-sm text-slate-700 rounded-xl hover:bg-primary-50 dark:text-slate-300 dark:hover:bg-primary-900/20 dark:hover:text-primary-400 transition-premium group">
                                    <i data-lucide="user" class="w-4 h-4 mr-3 text-slate-400 group-hover:text-primary-500"></i>
                                    My Profile
                                </a>
                            </li>
                            <li>
                                <a href="change-password.php" class="flex items-center px-4 py-3 text-sm text-slate-700 rounded-xl hover:bg-primary-50 dark:text-slate-300 dark:hover:bg-primary-900/20 dark:hover:text-primary-400 transition-premium group">
                                    <i data-lucide="shield-lock" class="w-4 h-4 mr-3 text-slate-400 group-hover:text-primary-500"></i>
                                    Security
                                </a>
                            </li>
                        </ul>
                        <div class="p-2">
                            <a href="logout.php" class="flex items-center px-4 py-3 text-sm text-red-600 rounded-xl hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20 transition-premium group font-bold">
                                <i data-lucide="log-out" class="w-4 h-4 mr-3"></i>
                                Sign Out
                            </a>
                        </div>
                    </div>
                </div>
                <?php }} ?>
            </div>
        </div>
    </div>
</nav>
