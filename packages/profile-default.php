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

$pageTitle = "Profile " . $model['userfullname'];
?>
<?php require_once('header.layout.php'); ?>
<div class="d-flex row align-items-center g-lg-5 py-5">
    <div class="col-lg-7 order-1 order-lg-0 pt-5 pt-lg-0">
        <p class="col-lg-10 fw-bold text-center text-lg-start text-uppercase text-muted mb-1">Profil</p>
        <h2 class="text-center text-lg-start text-body-emphasis fw-bold lh-1 border-bottom pb-3 mb-3"><?= $model['userfullname']; ?></h2>
        <ul class="col-lg-10 mt-4 px-md-0 px-2">
            <li class="d-flex"><span class="fw-bold" style="width:120px">Tgl. Lahir:</span> <span><?=  $model['userbirthday']!=null ? date("d F Y",strtotime($model['userbirthday'])) : '-' ?></span></li>
            <li class="d-flex"><span class="fw-bold" style="width:120px">Alamat:</span> <span><?= $model['useraddress']!=null && !empty($model['useraddress']) ? nl2br($model['useraddress']) : '-' ?></span></li>
            <li class="d-flex"><span class="fw-bold" style="width:120px">Email:</span> <span><?= $model['useremail'] ?? '-' ?></span></li>
            <li class="d-flex"><span class="fw-bold" style="width:120px">No. HP: </span><span><?= $model['userphone']!=null ? '0'.$model['userphone'] : '-' ?></span></li>
            <li class="d-flex"><span class="fw-bold" style="width:120px">Kelamin: </span><span><?= $model['usergender']!=null && $model['usergender']=='pria' ? 'Laki-Laki' : 'Wanita' ?></span></li>
        </ul>
    </div>
    <div class="col-md-10 mx-auto col-lg-5 order-0 order-lg-1 d-flex flex-column align-items-start justify-content-center">
        <img src="<?= create_assetlink('avatars/'. (!empty($model['userphoto']) ? $model['userphoto'] : 'default.jpg')) ?>" width="200" height="200" class="mb-3 shadow rounded mx-auto">
        <?php if(bucumi_auth() && $authUser['username'] == $model['username']): ?>
            <button type="button" class="btn btn-sm btn-bucumi mx-auto" style="width: 200px;" onclick="javascript:window.open('<?= create_url($model['username'].'/edit') ?>','_self')">Edit Profil</button>
        <?php endif; ?>
    </div>
    <?php if($model['userdescription']!=null && !empty(trim($model['userdescription']))): ?>
    <div class="d-flex flex-column order-2 pt-5 pt-lg-0">
        <p class="text-center text-lg-start fw-bold text-uppercase text-muted border-bottom pb-3 mb-3">Tentang <?= $model['userfullname']; ?></p>
        <p class="mb-3"><?= nl2br($model['userdescription']) ?></p>
    </div>    
    <?php endif; ?>
</div>
<?php require_once('footer.layout.php'); ?>