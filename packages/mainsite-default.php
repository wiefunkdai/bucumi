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

$pageTitle = "Hello World";
?>
<?php require_once('header.layout.php'); ?>
<div class="px-4 pt-5 my-5 text-center">
    <img class="d-block mx-auto mb-4" src="<?= create_url('resources/images/bucumi-logosquare.png') ?>" alt="Bucumi" width="180" height="180">
    <h1 class="display-4 fw-bold text-body-emphasis">Selamat Datang!</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4"><b>BUCUMI</b> merupakan pilihan tepat untuk menemukan dan menikmati beragam koleksi buku yang berkualitas dengan mencakup berbagai genre dan topik serta menarik.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
        <form action="<?= create_url('catalog') ?>" method="GET" class="welcome-form-search" role="search">
            <input name="search" type="search" class="input-search form-control form-control-light text-bg-light" placeholder="Cari Buku..." aria-label="Search">
            <button type="submit" class="btn btn-search position-absolute"><i class="bi bi-search"></i></button>
        </form>
      </div>
    </div>
    <div class="overflow-hidden" style="max-height: 30vh;">
      <div class="container px-5">
        <img src="<?= create_url('resources/images/standingbooks-billboard.jpg') ?>" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Bucumi Book" width="700" height="500" loading="lazy">
      </div>
    </div>
  </div>
<?php require_once('footer.layout.php'); ?>