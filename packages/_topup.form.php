<form action="<?= create_url('topup/'.$actionName) ?>" method="post" enctype="multipart/form-data" class="row g-3 mb-5" novalidate>
    <?php if(isset($model['topupuserid'])): ?>
        <input type="hidden" name="topupuserid" value="<?= $model['topupuserid'] ?>">
    <?php endif; ?>
    <div class="col-md-6">
        <div class="form-floating mt-3 mb-3 has-validation">
            <select id="inputBucumiBank" name="topupbucumibank" class="select-paymentbank form-control form-select<?= isset($errors['topupbucumibank']) ? ' is-invalid' : (isset($valids['topupbucumibank']) ? ' is-valid' : '') ?>" placeholder="Tujuan Bank Transfer">
                <option value=""<?= isset($model['topupbucumibank']) ? '':' selected' ?>>Pilih Rekening Tujuan</option>
                <option value="bni"<?= isset($model['topupbucumibank']) && $model['topupbucumibank']=='bni' ? ' selected':'' ?>>Bank Negara Indonesia (Rek. 666-666-666)</option>
                <option value="bca"<?= isset($model['topupbucumibank']) && $model['topupbucumibank']=='bca' ? ' selected':'' ?>>Bank Central Asia (Rek. 666-666-666)</option>
                <option value="mandiri"<?= isset($model['topupbucumibank']) && $model['topupbucumibank']=='mandiri' ? ' selected':'' ?>>Bank Mandiri (Rek. 666-666-666)</option>
                <option value="bri"<?= isset($model['topupbucumibank']) && $model['topupbucumibank']=='bri' ? ' selected':'' ?>>Bank Rakyat Indonesia (Rek. 666-666-666)</option>
            </select>
            <label for="inputBucumiBank">Tujuan Bank Transfer</label>
            <?php if(isset($errors['topupbucumibank']) || isset($valids['topupbucumibank'])): ?>
                <div id="inputBucumiBankFeedback" class="<?= isset($errors['topupbucumibank']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['topupbucumibank'] ?? $valids['topupbucumibank'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating mt-3 mb-3 has-validation">
            <input type="date" name="topuptransferdate" class="form-control<?= isset($errors['topuptransferdate']) ? ' is-invalid' : (isset($valids['topuptransferdate']) ? ' is-valid' : '') ?>" id="inputTransferDate" placeholder="Tanggal Transfer" value="<?= $model['topuptransferdate'] ?? date('Y-m-d') ?>">
            <label for="inputTransferDate">Tanggal Transfer</label>
            <?php if(isset($errors['topuptransferdate']) || isset($valids['topuptransferdate'])): ?>
                <div id="inputTransferDateFeedback" class="<?= isset($errors['topuptransferdate']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['topuptransferdate'] ?? $valids['topuptransferdate'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div> 
    <div class="col-md-12">
        <div class="form-floating mb-3 has-validation">
            <input type="text" name="topupbalance" class="form-control<?= isset($errors['topupbalance']) ? ' is-invalid' : (isset($valids['topupbalance']) ? ' is-valid' : '') ?>" id="inputNominal" placeholder="Nominal Transfer" value="<?= $model['topupbalance'] ?? '0' ?>">
            <label for="inputNominal">Nominal Transfer</label>
            <?php if(isset($errors['topupbalance']) || isset($valids['topupbalance'])): ?>
                <div id="inputNominalFeedback" class="<?= isset($errors['topupbalance']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['topupbalance'] ?? $valids['topupbalance'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div> 
    <div class="col-md-6">
        <div class="form-floating mb-3 has-validation">
            <input type="text" name="topupbankfrom" class="form-control<?= isset($errors['topupbankfrom']) ? ' is-invalid' : (isset($valids['topupbankfrom']) ? ' is-valid' : '') ?>" id="inputBankFrom" placeholder="Di Transfer Via Bank" value="<?= $model['topupbankfrom'] ?? '' ?>">
            <label for="inputBankFrom">Di Transfer Via Bank</label>
            <?php if(isset($errors['topupbankfrom']) || isset($valids['topupbankfrom'])): ?>
                <div id="inputBankFrom" class="<?= isset($errors['topupbankfrom']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['topupbankfrom'] ?? $valids['topupbankfrom'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div> 
    <div class="col-md-6">
        <div class="form-floating mb-3 has-validation">
            <input type="text" name="topupnumberbanksender" class="form-control<?= isset($errors['topupnumberbanksender']) ? ' is-invalid' : (isset($valids['topupnumberbanksender']) ? ' is-valid' : '') ?>" id="inputNumberBankSender" placeholder="Nomor Rekening Pengirim" value="<?= $model['topupnumberbanksender'] ?? '' ?>">
            <label for="inputNumberBankSender">Nomor Rekening Pengirim</label>
            <?php if(isset($errors['topupnumberbanksender']) || isset($valids['topupnumberbanksender'])): ?>
                <div id="inputNumberBankSender" class="<?= isset($errors['topupnumberbanksender']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['topupnumberbanksender'] ?? $valids['topupnumberbanksender'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-floating mb-3 has-validation">
            <input type="text" name="topupnamesender" class="form-control<?= isset($errors['topupnamesender']) ? ' is-invalid' : (isset($valids['topupnamesender']) ? ' is-valid' : '') ?>" id="inputNameSender" placeholder="Nama Rekening Pengirim" value="<?= $model['topupnamesender'] ?? '' ?>">
            <label for="inputNameSender">Nama Rekening Pengirim</label>
            <?php if(isset($errors['topupnamesender']) || isset($valids['topupnamesender'])): ?>
                <div id="inputNameSender" class="<?= isset($errors['topupnamesender']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['topupnamesender'] ?? $valids['topupnamesender'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group mb-3 has-validation">
            <label for="inputEvidenceTransfer" class="form-label input-label">Bukti Transfer (Opsional)</label>
            <input type="file" id="inputEvidenceTransfer" name="topupevidencetransfer" class="form-control mt-2<?= isset($errors['topupevidencetransfer']) ? ' is-invalid' : (isset($valids['topupevidencetransfer']) ? ' is-valid' : '') ?>">
            <?php if(isset($errors['topupevidencetransfer']) || isset($valids['topupevidencetransfer'])): ?>
                <div id="inputEvidenceTransferFeedback" class="<?= isset($errors['topupevidencetransfer']) ? 'invalid-feedback' : 'valid-feedback' ?>">
                    <?= $errors['topupevidencetransfer'] ?? $valids['topupevidencetransfer'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-12">
        <div class="col-6 col-md-3 mx-auto">
            <button name="submit" value="topups" type="submit" class="btn btn-lg btn-bucumi w-100">Konfirmasi</button>
        </div>
    </div>
</form>