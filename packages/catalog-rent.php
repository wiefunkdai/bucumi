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
$tableName = mysqli_table_name('rents');
$models = [];

if ($paramName!==false) {
    $startDate = date('Y-m-d H:m:s');
    $endDate = date('Y-m-d H:m:s', time() + 60 * 60);
    $authUserID = $authUser['userid'];
    $SQLQuery = $SQLConnector->query("SELECT * FROM $tableName WHERE rentbookid='$paramName' AND rentuserid='$authUserID' AND (rentdatetime>='$startDate' AND rentdatetime<='$endDate');");
    if ($SQLQuery->num_rows == 0) {
        $SQLConnector->query("INSERT INTO $tableName SET rentbookid='$paramName', rentuserid='$authUserID', rentdatetime='$startDate';");
    }
}
header('Location: '.create_url('catalog/detail/'.$paramName));
?>