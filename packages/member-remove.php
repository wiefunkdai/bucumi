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
  

$pageTitle = "Hapus Akun";
$tableName = mysqli_table_name('users');
$authUserID = $authUser['userid'];
$SQLQuery = $SQLConnector->query("DELETE FROM $tableName WHERE userid='".($_GET['id'] ?? null)."' AND userrole='member'");
if (mysqli_affected_rows($SQLConnector) > 0) {
    echo("<script>alert('Data berhasil dan telah terhapus!');window.open('".create_url('member/manage')."','_self');</script>");
} else {
    @header('Location: '.create_url('error'));
}
$SQLConnector->close();