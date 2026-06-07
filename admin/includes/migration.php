<?php
/**
 * IFSC Finder Pro - Auto Migration System
 * Ensures database schema is up-to-date across all cloned systems.
 */

try {
    // 1. Check for ProfileImage in tbladmin
    $checkAdmin = $dbh->query("SHOW COLUMNS FROM tbladmin LIKE 'ProfileImage'");
    if ($checkAdmin->rowCount() == 0) {
        $dbh->exec("ALTER TABLE tbladmin ADD ProfileImage VARCHAR(255) DEFAULT NULL AFTER Email");
    }

    // 2. Check for CreationDate in tblbank
    $checkBank = $dbh->query("SHOW COLUMNS FROM tblbank LIKE 'CreationDate'");
    if ($checkBank->rowCount() == 0) {
        $dbh->exec("ALTER TABLE tblbank ADD CreationDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
    }

    // 3. Check for CreationDate in tblstate
    $checkState = $dbh->query("SHOW COLUMNS FROM tblstate LIKE 'CreationDate'");
    if ($checkState->rowCount() == 0) {
        $dbh->exec("ALTER TABLE tblstate ADD CreationDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
    }

    // 4. Check for CreationDate in tblcity
    $checkCity = $dbh->query("SHOW COLUMNS FROM tblcity LIKE 'CreationDate'");
    if ($checkCity->rowCount() == 0) {
        $dbh->exec("ALTER TABLE tblcity ADD CreationDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
    }

    // 5. Check for CreationDate in tblbankdetail
    $checkDetail = $dbh->query("SHOW COLUMNS FROM tblbankdetail LIKE 'CreationDate'");
    if ($checkDetail->rowCount() == 0) {
        $dbh->exec("ALTER TABLE tblbankdetail ADD CreationDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
    }

} catch (Exception $e) {
    // Silent fail to prevent blocking the app, but log error if needed
    error_log("Migration Error: " . $e->getMessage());
}
?>
