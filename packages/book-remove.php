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

if (!bucumi_auth()) {
  @header('Location: '.create_url('login'));
  exit();
} elseif ($authUser['userrole']<>'admin') {
  throw new \Exception('Hanya admin yang berhak mengakses halaman ini!');
  exit();
}
  

$pageTitle = "Hapus Buku";
$tableName = mysqli_table_name('books');
$SQLQuery = $SQLConnector->query("DELETE FROM $tableName WHERE bookid='".($_GET['id'] ?? null)."'");
if (mysqli_affected_rows($SQLConnector) > 0) {
    echo("<script>alert('Data berhasil dan telah terhapus!');window.open('".create_url('book/manage')."','_self');</script>");
} else {
    @header('Location: '.create_url('error'));
}
$SQLConnector->close();