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
  
  $pageTitle = "Buku Manajemen";
  $tableName = mysqli_table_name('books');
  $SQLQuery = $SQLConnector->query("SELECT * FROM $tableName;");
  $models = $SQLQuery->fetch_all(MYSQLI_ASSOC);
?>
<?php require_once('header.layout.php'); ?>
<h1 class="text-body-emphasis border-bottom pb-3 mb-4"><?= $pageTitle; ?></h1>
<div class="grid-toolbar container mb-3">
<div class="row">
    <div class="col-8 col-md-6 px-0 pe-1 d-flex gap-2 justify-content-md-start">

    </div> 
    <div class="col-4 col-md-6 px-0 ps-1 d-flex gap-2 justify-content-md-end">
      <button onclick="javascript:window.open('book/create', '_self')" class="btn btn-outline-bucumi" type="button">
        <i class="bi bi-plus-circle-fill me-1"></i><span class="btn-cap">Buat Baru</span>
      </button>
    </div>
  </div>
</div>
<div id="gridTable" class="grid-view grid-responsive table-responsive-sm">
    <table class="table table-sm table-striped table-bordered">
    <thead>
    <tr>
        <th class="column-primary" scope="col" style="width:40px">#</th>
                <th class="column-primary" scope="col">Kode Buku</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Kunci/Kategori</th>
                <th scope="col">Pengarang</th>
                <th scope="col">Penerbit</th>
                <th scope="col">Tanggal Terbit</th>
                <th scope="col">Status</th>
                <th class="column-primary" scope="col" style="width:40px">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
          <?php if (count($models)===0): ?>
            <tr data-key="0">
              <td scope="row" class="text-center" colspan="13">Belum memiliki data sedikitpun!</td>
            </tr>
            <?php else: ?>
            <?php foreach($models as $model): ?>
            <tr data-key="<?=  $model['bookid'] ?? '' ?>">
                <th scope="row"><img src="<?= create_assetlink('books/'. (!empty($model['bookcover']) ? $model['bookcover'] : 'default.jpg')) ?>" width="40" height="40" class="rounded"></th>
                <td class="title"><?=  $model['bookid'] ?? '-' ?> <a href="javascript:void();" class="btn grid-expand"><span class="bi bi-caret-down-square-fill"></span></a></td>
                <td><?=  $model['booktitle'] ?? '-' ?></td>
                <td><?=  $model['bookkeyword'] ?? '-' ?></td>
                <td><?=  $model['bookauthor'] ?? '-' ?></td>
                <td><?=  $model['bookpublisher'] ?? '-' ?></td>
                <td><?=  !empty($model['bookpublishdate']) ? date("d F Y",strtotime($model['bookpublishdate'])) : '-' ?></td>
                <td><span class="btn btn-sm <?=  $model['bookstatus']!=false ? 'btn-primary' : 'btn-secondary' ?> rounded-pill px-3"><?=  $model['bookstatus']!=false ? 'Publish' : 'Arsip' ?></span></td>
                <th>
                
                <div class="btn-group dropstart">
  <button type="button" class="btn btn-sm btn-bucumi dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="bi bi-list"></i>
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="<?= create_url('book/update?id='.$model['bookid']) ?>"><i class="bi bi-pencil-square"></i> Edit Data</a></li>
    <li><a class="dropdown-item" href="<?= create_url('book/create') ?>"><i class="bi bi-file-earmark-plus"></i> Buat Data Baru</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><button type="button" class="dropdown-item" onclick="javascript:return confirm('Apakah Anda Yakin untuk Hapus Ini?')? window.open('<?= create_url('book/remove?id='.$model['bookid']) ?>','_self') : false"><i class="bi bi-eraser"></i> Hapus Data</button></li>
  </ul>
</div>
                </th>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="mt-3">
    <table class="table table-sm table-striped table-bordered table-print">
    <thead>
    <tr>
        <th class="column-primary" scope="col">Kode Buku</th>
                <th class="column-primary" scope="col">Judul Buku</th>
                <th scope="col">Sinopsi</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Kunci/Kategori</th>
                <th scope="col">Jumlah Halaman</th>
                <th scope="col">Pengarang</th>
                <th scope="col">Penerbit</th>
                <th scope="col">Tanggal Terbit</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
          <?php if (count($models)===0): ?>
            <tr data-key="0">
              <td scope="row" class="text-center" colspan="13">Belum memiliki data sedikitpun!</td>
            </tr>
            <?php else: ?>
            <?php foreach($models as $model): ?>
            <tr data-key="<?=  $model['bookid'] ?? '' ?>">
                <th scope="row"><?=  $model['bookid'] ?? '-' ?></th>
                <td class="title"><?=  $model['booktitle'] ?? '-' ?></td>
                <td><?=  $model['booksummary'] ?? '-' ?></td>
                <td><?=  $model['bookdescription'] ?? '-' ?></td>
                <td><?=  $model['bookkeyword'] ?? '-' ?></td>
                <td><?=  $model['booktotalpages'] ?? '-' ?></td>
                <td><?=  $model['bookauthor'] ?? '-' ?></td>
                <td><?=  $model['bookpublisher'] ?? '-' ?></td>
                <td><?=  !empty($model['bookpublishdate']) ? date("d F Y",strtotime($model['bookpublishdate'])) : '-' ?></td>
                <td><?=  $model['bookstatus']!=false ? 'Publish' : 'Arsip' ?></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table></div>
</div>
<?php require_once('footer.layout.php'); ?>