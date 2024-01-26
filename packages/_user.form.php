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
<form action="<?= create_url('user/'.$actionName) ?>" method="post" enctype="multipart/form-data" class="row g-3 mb-5" novalidate>
<?php if(isset($model['userid'])): ?>
    <input type="hidden" name="userid" value="<?= $model['userid'] ?>">
<?php endif; ?>
<?php if(isset($model['usernameold'])): ?>
    <input type="hidden" name="usernameold" value="<?= $model['usernameold'] ?>">
<?php endif; ?>
<?php if(isset($model['useremailold'])): ?>
    <input type="hidden" name="useremailold" value="<?= $model['useremailold'] ?>">
<?php endif; ?>
    <div class="col-md-12">
        <h4 class="mb-3">Biodata</h4>
    </div>
    <div class="col-12">
        <div class="col-md-4 mx-auto">
            <div class="text-center mb-3">
                <img src="<?= create_assetlink('avatars/'. (!empty($model['userphoto']) ? $model['userphoto'] : 'default.jpg')) ?>" width="200" height="200" class="mb-3 rounded-circle">
                <div class="input-group has-validation">
                    <input type="hidden" name="userphoto" value="<?= $model['userphoto'] ?? null ?>">
                    <input type="file" id="inputPhoto" name="userphoto" class="form-control mt-2<?= isset($errors['userphoto']) ? ' is-invalid' : (isset($valids['userphoto']) ? ' is-valid' : '') ?>">
                    <?php if(isset($errors['userphoto']) || isset($valids['userphoto'])): ?>
                        <div id="inputPhotoFeedback" class="<?= isset($errors['userphoto']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                            <?= $errors['userphoto'] ?? $valids['userphoto'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
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
    <div class="col-md-6">
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
    <div class="col-md-6">
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
            <textarea name="useraddress" class="form-control<?= isset($errors['useraddress']) ? ' is-invalid' : (isset($valids['useraddress']) ? ' is-valid' : '') ?>" id="inputAddress" placeholder="Alamat Lengkap" style="min-height:80px"><?= $model['useraddress'] ?? '' ?></textarea>
            <label for="inputAddress">Alamat Lengkap</label>
            <?php if(isset($errors['useraddress']) || isset($valids['useraddress'])): ?>
                <div id="inputAddressFeedback" class="<?= isset($errors['useraddress']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['useraddress'] ?? $valids['useraddress'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-floating mb-3 has-validation">
            <input type="date" name="userbirthday" class="form-control<?= isset($errors['userbirthday']) ? ' is-invalid' : (isset($valids['userbirthday']) ? ' is-valid' : '') ?>" id="inputBirthday" placeholder="Tanggal Lahir" value="<?= $model['userbirthday'] ?? '' ?>">
            <label for="inputBirthday">Tanggal Lahir</label>
            <?php if(isset($errors['userbirthday']) || isset($valids['userbirthday'])): ?>
                <div id="inputBirthdayFeedback" class="<?= isset($errors['userbirthday']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['userbirthday'] ?? $valids['userbirthday'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-floating mb-3 has-validation">
            <input type="text" name="userphone" class="form-control<?= isset($errors['userphone']) ? ' is-invalid' : (isset($valids['userphone']) ? ' is-valid' : '') ?>" id="inputPhone" placeholder="Nomor Ponsel" value="<?= $model['userphone'] ?? '' ?>">
            <label for="inputPhone">Nomor Ponsel</label>
            <?php if(isset($errors['userphone']) || isset($valids['userphone'])): ?>
                <div id="inputPhoneFeedback" class="<?= isset($errors['userphone']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['userphone'] ?? $valids['userphone'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-floating mb-3 has-validation">
            <select name="usergender" id="inputGender" class="form-control form-select<?= isset($errors['usergender']) ? ' is-invalid' : (isset($valids['usergender']) ? ' is-valid' : '') ?>" placeholder="Jenis Kelamin">
                <option value="pria"<?= isset($model['usergender']) && $model['usergender']=='pria' ? ' selected':' selected' ?>>Laki Laki</option>
                <option value="wanita"<?= isset($model['usergender']) && $model['usergender']=='wanita' ? ' selected':'' ?>>Perempuan</option>
            </select>
            <label for="inputGender">Jenis Kelamin</label>
            <?php if(isset($errors['usergender']) || isset($valids['usergender'])): ?>
                <div id="inputGenderFeedback" class="<?= isset($errors['usergender']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['usergender'] ?? $valids['usergender'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-floating mb-3 has-validation">
            <textarea name="userdescription" class="form-control<?= isset($errors['userdescription']) ? ' is-invalid' : (isset($valids['useraddress']) ? ' is-valid' : '') ?>" id="inputDescription" placeholder="Tentang Pribadi" style="min-height:80px"><?= $model['userdescription'] ?? '' ?></textarea>
            <label for="inputDescription">Tentang Pribadi</label>
            <?php if(isset($errors['userdescription']) || isset($valids['userdescription'])): ?>
                <div id="inputDescriptionFeedback" class="<?= isset($errors['userdescription']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['userdescription'] ?? $valids['userdescription'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-12">
        <h4 class="mb-3">Otentikasi Akun</h4>
    </div>
  <div class="col-md-6">
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
  <div class="col-md-6">
    <div class="form-floating mb-3 has-validation">
        <select id="inputStatus" name="userstatus" class="form-control form-select<?= isset($errors['userstatus']) ? ' is-invalid' : (isset($valids['userstatus']) ? ' is-valid' : '') ?>" placeholder="Status Akun">
            <option value="1"<?= isset($model['userstatus']) && $model['userstatus']==1 ? ' selected':' selected' ?>>Aktif</option>
            <option value="0"<?= isset($model['userstatus']) && $model['userstatus']==0 ? ' selected':'' ?>>Blokir</option>
        </select>
        <label for="inputStatus">Status Akun</label>
        <?php if(isset($errors['userstatus']) || isset($valids['userstatus'])): ?>
            <div id="inputStatusFeedback" class="<?= isset($errors['userstatus']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                <?= $errors['userstatus'] ?? $valids['userstatus'] ?>
            </div>
        <?php endif; ?>
    </div>
  </div>
  <div class="col-md-6">
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
  <div class="col-md-6">
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
  <div class="col-12">
    <div class="d-flex align-items-center justify-content-between row">
        <div class="col-6 col-md-2">
            <button name="submit" value="users" type="submit" class="btn btn-bucumi w-100">Simpan Data</button>
        </div>
        <div class="col-4 col-md-1 text-end">
            <?php if (isset($model['userid']) && $actionName=='update'): ?>
                <button type="button" class="btn btn-danger w-100" onclick="javascript:return confirm('Apakah Anda Yakin untuk Hapus Ini?')? window.open('<?= create_url('user/remove?id='.$model['userid']) ?>','_self') : false">Hapus</button>
            <?php endif; ?>
        </div>
    </div>
  </div>
</form>