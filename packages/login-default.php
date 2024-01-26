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

if (bucumi_auth()) {
    @header('Location: '.create_url('/'));
    exit();
}

$pageTitle = "Masuk ke Bucumi";
$tableName = mysqli_table_name('users');
$errors = [];
$valids = [];
$model = [];
$userBlocked = false;

if (isset($_POST['login-form'])) {
    if (($model=$_POST) && (isset($model) && is_array($model) && !empty($model))) {
        if (empty($model['username']) || trim($model['username']=='')) {
            $errors['username'] = 'ID Pengguna harap diisi!';
        }  else {
            $valids['username'] = 'Terlihat bagus!';
        }
    
        if (empty($model['userpassword']) || trim($model['userpassword']=='')) {
            $errors['userpassword'] = 'Kata Sandi harap diisi!';
        }
        if (empty($errors) && count($errors) === 0) {
            $authid = $model['username'] ?? 'default';
            $authpass=mysqli_input_password($model['userpassword']);
            $SQLQuery = $SQLConnector->query( "SELECT * FROM $tableName WHERE userpassword='$authpass' AND (userid='$authid' OR username='$authid' OR usernationid='$authid');");
            if ($SQLQuery->num_rows === 0) {
                $errors['userpassword'] = 'Cek Ulang ID Pengguna atau Kata Sandi!';
            } else {
                $model = $SQLQuery->fetch_array(MYSQLI_ASSOC);
                unset($model['userpassword']);
    
                if ($model['userstatus']==false) {
                    $userBlocked = true;   
                } else {
                    $_SESSION['bucumi.authuser'] = $model;
                    @header('Location: '.create_url('/'));
                }
            }
        }
    }
}

$model['userpassword'] = null;
?>
<?php require_once('header.layout.php'); ?>
<?php if ($userBlocked!=false): ?>
    <h1 class="text-body-emphasis border-bottom pb-3 mb-4">Maaf, Gagal Login!</h1>
    <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading"> Akun Anda Terblokir!</h4>
        <p>Kami ingin menyampaikan permohonan maaf yang mendalam atas ketidaknyamanan yang Anda alami karena pemblokiran akun Anda. Kami memahami bahwa ini dapat menimbulkan frustrasi dan kami ingin memberikan klarifikasi dan solusi segera.</p>
        <hr>
        <p class="mb-0">Terima kasih atas pengertian dan kesabaran Anda selama kami menangani masalah ini. Kami menghargai dukungan Anda sebagai pengguna kami.</p>
    </div>
    <div class="mb-5 text-center">
<button type="button" onclick="javascript:location.replace(location.href);" class="btn btn-bucumi btn-lg px-4">Ke Halaman Sebelumnya</a>
</div>
<?php else: ?>
<div class="col-12 col-md-6 d-block mx-auto pt-3">
<form action="<?= create_url('login') ?>" method="post" class="row g-3 mb-3 mb-md-5" novalidate>
    <h1 class="text-body-emphasis border-bottom text-center my-3 pb-3 mb-4 mb-md-5"><?= $pageTitle; ?></h1>
    <div class="col-md-12">
        <div class="form-floating mb-3 has-validation">
            <input type="text" name="username" class="form-control<?= isset($errors['username']) ? ' is-invalid' : (isset($valids['username']) ? ' is-valid' : '') ?>" id="inputUsername" placeholder="ID Pengguna" value="<?= $model['username'] ?? '' ?>">
            <label for="inputUsername">ID Pengguna</label>
            <?php if(isset($errors['username']) || isset($valids['username'])): ?>
                <div id="inputUsernameFeedback" class="<?= isset($errors['username']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['username'] ?? $valids['username'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-floating mb-3 has-validation">
            <input type="password" name="userpassword" class="form-control<?= isset($errors['userpassword']) ? ' is-invalid' : (isset($valids['userpassword']) ? ' is-valid' : '') ?>" id="inputPassword" placeholder="Kata Sandi" value="<?= $model['userpassword'] ?? '' ?>">
            <label for="inputPassword">Kata Sandi</label>
            <?php if(isset($errors['userpassword']) || isset($valids['userpassword'])): ?>
                <div id="inputPasswordFeedback" class="<?= isset($errors['userpassword']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['userpassword'] ?? $valids['userpassword'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-12 col-md-12 d-grid gap-2 mx-auto">
        <button name="login-form" type="submit" class="btn btn-lg btn-block btn-bucumi">Masuk Bucumi</button>
        <button type="button" class="btn btn-lg btn-block btn-secondary" onclick="javascript:window.open('<?= create_url('register') ?>', '_self')">Daftar Baru</button>
    </div>
    <div class="col-12 col-md-12 d-grid gap-2 d-sm-flex align-items-center justify-content-sm-center">
        <p class="fs-5 text-center mb-0">Atau Login Dengan :</p>
        <button type="button" class="btn btn-floating btn-outline-bucumi px-4 gap-3"><i class="bi bi-google"></i> Google</button>
        <button type="button" class="btn btn-floating btn-outline-bucumi px-4"><i class="bi bi-facebook"></i> Facebook</button>
    </div>
</form>
</div>
<?php endif; ?>
<?php require_once('footer.layout.php'); ?>