<?php
include('includes/dbconnection.php');
try {
    $dbh->exec("ALTER TABLE tbladmin ADD Photo VARCHAR(255) DEFAULT NULL AFTER Address");
    echo "Column 'Photo' added successfully to 'tbladmin' table.";
} catch (PDOException $e) {
    echo "Note: " . $e->getMessage();
}
?>
