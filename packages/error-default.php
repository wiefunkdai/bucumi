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

$pageTitle = "Gangguan Akses Halaman";
?>
<?php require_once('header.layout.php'); ?>
<h1 class="text-body-emphasis border-bottom pb-3 mb-4"><?= $pageTitle; ?></h1>
<p class="fs-5 col-md-8">Maaf atas ketidaknyamanan ini. Saat ini, telah terjadinya kesalahan akses oleh anda pada halaman website ini atau website kami saat ini sedang mengalami gangguan pada server yang menyebabkan layanan kami tidak dapat diakses.</p>
<div class="mb-5">
<button type="button" onclick="javascript:history.back()" class="btn btn-bucumi btn-lg px-4">Ke Halaman Sebelumnya</a>
</div>
<hr class="col-3 col-md-2 mt-5 mb-5">
<div class="row g-5">
  <div class="col-md-6">
    <h2 class="text-body-emphasis">Kemungkinan Gangguan:</h2>
    <p>Ada beberapa alasan mengapa halaman website mungkin gagal dimuat. Beberapa penyebab umumnya melibatkan masalah teknis, jaringan, atau server. </p>
    <ul class="list-unstyled ps-0">
      <li class="icon-link mb-1" style="align-items: unset">
      <i class="bi bi-arrow-right-short"></i>
        Sumber Gangguan: (Contoh: Pemeliharaan rutin, gangguan teknis, atau lonjakan lalu lintas yang tidak terduga).
      </li>
      <li class="icon-link mb-1" style="align-items: unset">
      <i class="bi bi-arrow-right-short"></i>
        Langkah yang diambil: (Contoh: Tim teknis kami sedang bekerja untuk mengatasi masalah ini).
      </li>
      <li class="icon-link mb-1" style="align-items: unset">
      <i class="bi bi-arrow-right-short"></i>
        Estimasi Waktu Pemulihan: (Jika memungkinkan, berikan perkiraan waktu kapan layanan akan kembali normal).
      </li>
    </ul>
    
  </div>

  <div class="col-md-6">
  </div>
</div>
<hr class="col-12 my-5">
<p class="col-md-12 text-center">Kami memahami bahwa situasi ini dapat menyulitkan, dan kami menghargai kesabaran dan pengertian Anda. Kami berkomitmen untuk segera mengatasi masalah ini dan memulihkan layanan secepat mungkin.</p>
<p class="col-md-12 text-center">Terima kasih atas pengertian Anda.</p>
<?php require_once('footer.layout.php'); ?>