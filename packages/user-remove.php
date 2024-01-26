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

if (isset($_GET['id'])) {
  $tableName = mysqli_table_name('users');
  $SQLQuery = $SQLConnector->query("DELETE FROM $tableName WHERE userid='".($_GET['id'] ?? null)."' AND userrole='admin'");
  if (mysqli_affected_rows($SQLConnector) > 0) {
    if (trim($_GET['id'])==trim($authUser['userid'])) {
      echo("<script>alert('Data berhasil dan telah terhapus!');window.open('".create_url('logout')."','_self');</script>");
      exit();
    } else {
      echo("<script>alert('Data berhasil dan telah terhapus!');window.open('".create_url('user/manage')."','_self');</script>");
      exit();

    }
  } else {
      @header('Location: '.create_url('error'));
      exit();
  }
  $SQLConnector->close();
}