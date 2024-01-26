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
<div class="col-12 col-md-6 d-block mx-auto pt-3">
    <form action="<?= create_url('register') ?>" method="post" class="row g-3 mb-3 mb-md-5" novalidate>
        <h1 class="text-body-emphasis border-bottom text-center my-3 pb-3 mb-4 mb-md-5"><?= $pageTitle; ?></h1>
        <div class="col-md-12">
            <div class="form-floating mb-3 has-validation">
                <input type="email" name="useremail" class="form-control<?= isset($errors['useremail']) ? ' is-invalid' : (isset($valids['useremail']) ? ' is-valid' : '') ?>" id="inputEmail" placeholder="Email" value="<?= $model['useremail'] ?? '' ?>">
                <label for="inputEmail">Email</label>
                <?php if(isset($errors['useremail']) || isset($valids['useremail'])): ?>
                    <div id="inputEmailFeedback" class="<?= isset($errors['useremail']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                        <?= $errors['useremail'] ?? $valids['useremail'] ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-floating mb-3 has-validation">
                <input type="text" name="usernationid" class="form-control<?= isset($errors['usernationid']) ? ' is-invalid' : (isset($valids['usernationid']) ? ' is-valid' : '') ?>" id="inputNationID" placeholder="Nomor Identitas" value="<?= $model['usernationid'] ?? '' ?>">
                <label for="inputNationID">KTP/SIM/NIM</label>
                <?php if(isset($errors['usernationid']) || isset($valids['usernationid'])): ?>
                    <div id="inputNationIDFeedback" class="<?= isset($errors['usernationid']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                        <?= $errors['usernationid'] ?? $valids['usernationid'] ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-floating mb-3 has-validation">
                <input type="text" name="userfullname" class="form-control<?= isset($errors['userfullname']) ? ' is-invalid' : (isset($valids['userfullname']) ? ' is-valid' : '') ?>" id="inputFullName" placeholder="Nama Lengkap" value="<?= $model['userfullname'] ?? '' ?>">
                <label for="inputFullName">Nama Lengkap</label>
                <?php if(isset($errors['userfullname']) || isset($valids['userfullname'])): ?>
                    <div id="inputFullNameFeedback" class="<?= isset($errors['userfullname']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                        <?= $errors['userfullname'] ?? $valids['userfullname'] ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
  <div class="col-md-12">
    <div class="form-floating mb-3 has-validation">
        <input type="text" name="username" class="form-control<?= isset($errors['username']) ? ' is-invalid' : (isset($valids['username']) ? ' is-valid' : '') ?>" id="inputUsername" placeholder="Username" value="<?= $model['username'] ?? '' ?>">
        <label for="inputUsername">Username</label>
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
  <div class="col-md-12">
    <div class="form-floating mb-3 has-validation">
        <input type="password" name="userpasswordconfirm" class="form-control<?= isset($errors['userpasswordconfirm']) ? ' is-invalid' : (isset($valids['userpasswordconfirm']) ? ' is-valid' : '') ?>" id="inputPasswordConfirm" placeholder="Ulangi Sandi" value="<?= $model['userpasswordconfirm'] ?? '' ?>">
        <label for="inputPasswordConfirm">Ulangi Sandi</label>
        <?php if(isset($errors['userpasswordconfirm']) || isset($valids['userpasswordconfirm'])): ?>
            <div id="inputPasswordConfirmFeedback" class="<?= isset($errors['userpasswordconfirm']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                <?= $errors['userpasswordconfirm'] ?? $valids['userpasswordconfirm'] ?>
            </div>
        <?php endif; ?>
    </div>
  </div>
        <div class="col-12 col-md-12 d-grid gap-2 mx-auto">
            <button name="login-form" type="submit" class="btn btn-lg btn-block btn-bucumi">Daftar Bucumi</button>
        </div>
    </form>
</div>