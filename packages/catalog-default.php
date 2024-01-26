<?php
/**
 * PROJECT AKHIR SEMESTER PALCOMTECH
 * Mata Kuliah: Pemograman Web Dasar
 * Dosen : Bpk. Hendra Efendi
 * 
 * DAFTAR KELOMPOK :
 * - Stephanus Bagus Saputra
 * - Muhammd Ilham brosnansyah
 * - Muhamad Firdaus 
 * - M Ihsan Adrian 
 * - M. Chaidar Ramadhan 
 * - Mega
 */

$pageTitle = "Katalog Buku";
$tableName = mysqli_table_name('books');
$searchKey = isset($_GET['search']) ? $_GET['search'] : false;
$SQLQuery = $SQLConnector->query("SELECT * FROM $tableName" . (isset($_GET['search']) ? " WHERE booktitle LIKE '%$searchKey%' OR bookauthor LIKE '%$searchKey%' OR bookpublisher LIKE '%$searchKey%' OR bookid LIKE '%$searchKey%' OR booksummary LIKE '%$searchKey%' OR bookdescription LIKE '%$searchKey%';" : ";"));
$models = $SQLQuery->fetch_all(MYSQLI_ASSOC);
?>
<?php require_once('header.layout.php'); ?>
<?php require_once('_catalog.listview.php'); ?>
<?php require_once('footer.layout.php'); ?>