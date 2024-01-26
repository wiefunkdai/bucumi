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
?>
<div class="container">
<h1 class="text-body-emphasis border-bottom pb-3 mb-4"><?= $pageTitle; ?></h1>
<div class="row pt-3 mb-2">
    <?php if (count($models) == 0): ?>
        <div class="col-md-12">
            <div class="position-relative p-5 text-center text-muted bg-body border border-dashed rounded-5">
                <h3 class="text-body-emphasis pb-2">Buku Tidak Tersedia</h3>
                <div class="col-lg-6 mx-auto mb-4">
                    <form action="<?= create_url('catalog') ?>" method="GET" class="welcome-form-search" role="search">
                        <input name="search" type="search" class="input-search form-control form-control-light text-bg-light" placeholder="Cari Buku..." aria-label="Search">
                        <button type="submit" class="btn btn-search position-absolute"><i class="bi bi-search"></i></button>
                    </form>
                </div>
                <p class="col-lg-6 mx-auto my-4">
                    Silahkan cari dengan kata kunci lainnya..
                </p>
            </div>
        </div>
    <?php else: ?>
        <?php foreach($models as $model): ?>
        <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col-12 col-lg-auto d-flex align-items-center justify-content-center pt-4 pt-lg-0 ps-0 ps-lg-4">
            <img src="<?= create_assetlink('books/'. (!empty($model['bookcover']) ? $model['bookcover'] : 'default.jpg')) ?>" width="200" height="250" class="bd-placeholder-img d-block bordered">
            </div>
            <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary-emphasis"><?= substr($model['bookkeyword'], 0, 24) ?>..</strong>
            <h3 class="mb-0"><?= substr($model['booktitle'], 0, 40) ?></h3>
            <div class="mb-1 text-body-secondary"><?= substr($model['bookauthor'], 0, 36) ?></div>
            <p class="card-text mb-3"><?= substr($model['booksummary'],0,120) ?>..</p>
            <div class="d-flex justify-content-between align-items-center">
                <a href="<?= create_url('catalog/detail/'.$model['bookid']) ?>" class="btn btn-sm btn-outline-secondary icon-link gap-1 icon-link-hover stretched-link">
                    Detail Buku
                </a>
                <small class="text-body-secondary">Hal. <?= $model['booktotalpages'] ?></small>
            </div>
            </div>
        </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>