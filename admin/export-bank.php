<?php
session_start();
include('includes/dbconnection.php');

if (strlen($_SESSION['ifscaid']) == 0) {
    header('location:logout.php');
} else {
    $format = isset($_GET['format']) ? $_GET['format'] : 'csv';
    $filename = 'banks_export_' . date('Y-m-d');

    $sql = "SELECT ID, BankName, ShortName, CreationDate from tblbank";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    if ($format === 'json') {
        header('Content-Type: application/json; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename . '.json');
        echo json_encode($results, JSON_PRETTY_PRINT);
    } else {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename . '.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('ID', 'Bank Name', 'Short Name', 'Creation Date'));
        foreach ($results as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
    }
    exit();
}
?>
