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
<form action="<?= create_url('book/'.$actionName) ?>" method="post" enctype="multipart/form-data" class="row g-3 mb-5" novalidate>
<?php if(isset($model['bookid'])): ?>
    <input type="hidden" name="bookid" value="<?= $model['bookid'] ?>">
<?php endif; ?>
<?php if(isset($model['booktitleold'])): ?>
    <input type="hidden" name="booktitleold" value="<?= $model['booktitleold'] ?>">
<?php endif; ?>
    <div class="col-12">
        <div class="col-md-4 mx-auto">
            <div class="text-center mb-3">
                <img src="<?= create_assetlink('books/'. (!empty($model['bookcover']) ? $model['bookcover'] : 'default.jpg')) ?>" width="200" height="200" class="mb-3 rounded">
                <div class="input-group has-validation">
                    <input type="hidden" name="bookcover" value="<?= $model['bookcover'] ?? null ?>">
                    <input type="file" id="inputCover" name="bookcover" class="form-control mt-2<?= isset($errors['bookcover']) ? ' is-invalid' : (isset($valids['bookcover']) ? ' is-valid' : '') ?>">
                    <?php if(isset($errors['bookcover']) || isset($valids['bookcover'])): ?>
                        <div id="inputCoverFeedback" class="<?= isset($errors['bookcover']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                            <?= $errors['bookcover'] ?? $valids['bookcover'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group mb-3 has-validation">
            <label for="inputFilePath">Upload PDF Buku</label>
            <input type="hidden" name="bookfilepath" value="<?= $model['bookfilepath'] ?? null ?>">
            <input type="file" id="inputFilePath" name="bookfilepath" class="form-control mt-2<?= isset($errors['bookfilepath']) ? ' is-invalid' : (isset($valids['bookfilepath']) ? ' is-valid' : '') ?>">
            <?php if(isset($errors['bookfilepath']) || isset($valids['bookfilepath'])): ?>
                <div id="inputFilePathFeedback" class="<?= isset($errors['bookfilepath']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['bookfilepath'] ?? $valids['bookfilepath'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-floating mb-3 has-validation">
            <input type="text" name="booktitle" class="form-control<?= isset($errors['booktitle']) ? ' is-invalid' : (isset($valids['booktitle']) ? ' is-valid' : '') ?>" id="inputTitle" placeholder="Judul Buku" value="<?= $model['booktitle'] ?? '' ?>">
            <label for="inputTitle">Judul Buku</label>
            <?php if(isset($errors['booktitle']) || isset($valids['booktitle'])): ?>
                <div id="inputTitleFeedback" class="<?= isset($errors['booktitle']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['booktitle'] ?? $valids['booktitle'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-floating mb-3 has-validation">
            <input type="text" name="bookkeyword" class="form-control<?= isset($errors['bookkeyword']) ? ' is-invalid' : (isset($valids['bookkeyword']) ? ' is-valid' : '') ?>" id="inputKeyword" placeholder="Kunci / Kategori Buku" value="<?= $model['bookkeyword'] ?? '' ?>">
            <label for="inputKeyword">Kunci / Kategori Buku</label>
            <?php if(isset($errors['bookkeyword']) || isset($valids['bookkeyword'])): ?>
                <div id="inputKeywordFeedback" class="<?= isset($errors['bookkeyword']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['bookkeyword'] ?? $valids['bookkeyword'] ?>
                </div>
            <?php endif; ?>
            <div class="form-text">Masukan kunci dengan koma, misalnya: Ilmu Komputer, Web Programming, dan lainnya.</div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-floating mb-3 has-validation">
            <input type="date" name="bookpublishdate" class="form-control<?= isset($errors['bookpublishdate']) ? ' is-invalid' : (isset($valids['bookpublishdate']) ? ' is-valid' : '') ?>" id="inputPublishDate" placeholder="Tanggal Terbit" value="<?= $model['bookpublishdate'] ?? '' ?>">
            <label for="inputPublishDate">Tanggal Terbit</label>
            <?php if(isset($errors['bookpublishdate']) || isset($valids['bookpublishdate'])): ?>
                <div id="inputPublishDateFeedback" class="<?= isset($errors['bookpublishdate']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['bookpublishdate'] ?? $valids['bookpublishdate'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-floating mb-3 has-validation">
            <input type="text" name="booksummary" class="form-control<?= isset($errors['booksummary']) ? ' is-invalid' : (isset($valids['booksummary']) ? ' is-valid' : '') ?>" id="inputSummary" placeholder="Sinopsi Buku" value="<?= $model['booksummary'] ?? '' ?>">
            <label for="inputSummary">Sinopsi Buku</label>
            <?php if(isset($errors['booksummary']) || isset($valids['booksummary'])): ?>
                <div id="inputSummaryFeedback" class="<?= isset($errors['booksummary']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['booksummary'] ?? $valids['booksummary'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>   
    <div class="col-md-12">
        <div class="form-floating mb-3 has-validation">
            <textarea name="bookdescription" class="form-control<?= isset($errors['bookdescription']) ? ' is-invalid' : (isset($valids['bookdescription']) ? ' is-valid' : '') ?>" id="inputDescription" placeholder="Keterangan Buku" style="min-height:80px"><?= $model['bookdescription'] ?? '' ?></textarea>
            <label for="inputDescription">Keterangan Buku</label>
            <?php if(isset($errors['bookdescription']) || isset($valids['bookdescription'])): ?>
                <div id="inputDescriptionFeedback" class="<?= isset($errors['bookdescription']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['bookdescription'] ?? $valids['bookdescription'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div> 
    <div class="col-md-6">
        <div class="form-floating mb-3 has-validation">
            <input type="text" name="bookauthor" class="form-control<?= isset($errors['bookauthor']) ? ' is-invalid' : (isset($valids['bookauthor']) ? ' is-valid' : '') ?>" id="inputAuthor" placeholder="Pengarang Buku" value="<?= $model['bookauthor'] ?? '' ?>">
            <label for="inputAuthor">Pengarang Buku</label>
            <?php if(isset($errors['bookauthor']) || isset($valids['bookauthor'])): ?>
                <div id="inputAuthorFeedback" class="<?= isset($errors['bookauthor']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['bookauthor'] ?? $valids['bookauthor'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div> 
    <div class="col-md-6">
        <div class="form-floating mb-3 has-validation">
            <input type="text" name="bookpublisher" class="form-control<?= isset($errors['bookpublisher']) ? ' is-invalid' : (isset($valids['bookpublisher']) ? ' is-valid' : '') ?>" id="inputPublisher" placeholder="Penerbit Cetak" value="<?= $model['bookpublisher'] ?? '' ?>">
            <label for="inputPublisher">Penerbit Cetak</label>
            <?php if(isset($errors['bookpublisher']) || isset($valids['bookpublisher'])): ?>
                <div id="inputPublisherFeedback" class="<?= isset($errors['bookpublisher']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['bookpublisher'] ?? $valids['bookpublisher'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating mb-3 has-validation">
            <input type="text" name="booktotalpages" class="form-control<?= isset($errors['booktotalpages']) ? ' is-invalid' : (isset($valids['booktotalpages']) ? ' is-valid' : '') ?>" id="inputTotalPages" placeholder="Jumlah Halaman" value="<?= $model['booktotalpages'] ?? '' ?>">
            <label for="inputTotalPages">Jumlah Halaman</label>
            <?php if(isset($errors['booktotalpages']) || isset($valids['booktotalpages'])): ?>
                <div id="inputTotalPagesFeedback" class="<?= isset($errors['booktotalpages']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['booktotalpages'] ?? $valids['booktotalpages'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div> 
    <div class="col-md-6">
        <div class="form-floating mb-3 has-validation">
            <select id="inputStatus" name="bookstatus" class="form-control form-select<?= isset($errors['bookstatus']) ? ' is-invalid' : (isset($valids['bookstatus']) ? ' is-valid' : '') ?>" placeholder="Status Buku">
                <option value="1"<?= isset($model['bookstatus']) && $model['bookstatus']==1 ? ' selected':' selected' ?>>Publish</option>
                <option value="0"<?= isset($model['bookstatus']) && $model['bookstatus']==0 ? ' selected':'' ?>>Arsip</option>
            </select>
            <label for="inputStatus">Status Akun</label>
            <?php if(isset($errors['bookstatus']) || isset($valids['bookstatus'])): ?>
                <div id="inputStatusFeedback" class="<?= isset($errors['bookstatus']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['bookstatus'] ?? $valids['bookstatus'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-between row">
            <div class="col-6 col-md-2">
                <button name="submit" value="books" type="submit" class="btn btn-bucumi w-100">Simpan Data</button>
            </div>
            <div class="col-4 col-md-1 text-end">
                <?php if ($actionName=='update'): ?>
                    <button type="button" class="btn btn-danger w-100" onclick="javascript:return confirm('Apakah Anda Yakin untuk Hapus Ini?')? window.open('<?= create_url('book/remove?id='.$model['bookid']) ?>','_self') : false">Hapus</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</form>