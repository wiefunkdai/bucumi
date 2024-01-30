<?php

if (!bucumi_auth()) {
    @header('Location: '.create_url('login'));
    exit();
}

$pageTitle = "Isi Saldo Bucumi";
$authUserID = $authUser['username'];
$whatsappPhone = '15550309538';
$whatsappDate = date('d F Y');
$whatsappMessage = <<<EOF
Konfirmasi Top Up BUCUMI
Via Bank: {Nama_Bank_Anda}
No. Rek: {Rekening_Bank_Anda}
Jumlah Transfer: Rp {Nominal_Transfer}
Tanggal: $whatsappDate
Pengguna: $authUserID
EOF;
$whatsappUrlParam = 'phone='.urlencode($whatsappPhone).'&text='.urlencode($whatsappMessage);
$whatsappUrlLink = 'https://api.whatsapp.com/send?'.htmlentities($whatsappUrlParam);
?>
<?php require_once('header.layout.php'); ?>
<h1 class="text-body-emphasis border-bottom pb-3 mb-4"><?= $pageTitle ?></h1>
<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-sm-12 col-lg-4">
        <div class="list-group">
            <div class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                <img src="<?= create_url('resources/images/payments/bni-logo.svg') ?>" alt="BNI" width="64" class="flex-shrink-0 h-100 my-auto">
                <div class="d-flex gap-2 w-100 justify-content-between">
                    <div>
                        <h6 class="mb-0">Bank Negara Indonesia</h6>
                        <p class="mb-0 opacity-75">Rek. 666-666-666</p>
                    </div>
                </div>
            </div>
            <div class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                <img src="<?= create_url('resources/images/payments/bca-logo.svg') ?>" alt="BNI" width="64" class="flex-shrink-0 h-100 my-auto">
                <div class="d-flex gap-2 w-100 justify-content-between">
                    <div>
                        <h6 class="mb-0">Bank Central Asia</h6>
                        <p class="mb-0 opacity-75">Rek. 666-666-666</p>
                    </div>
                </div>
            </div>
            <div class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                <img src="<?= create_url('resources/images/payments/mandiri-logo.svg') ?>" alt="Mandiri" width="64" class="flex-shrink-0 h-100 my-auto">
                <div class="d-flex gap-2 w-100 justify-content-between">
                    <div>
                        <h6 class="mb-0">Bank Mandiri</h6>
                        <p class="mb-0 opacity-75">Rek. 666-666-666</p>
                    </div>
                </div>
            </div>
            <div class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                <img src="<?= create_url('resources/images/payments/bri-logo.svg') ?>" alt="BRI" width="64" class="flex-shrink-0 h-100 my-auto">
                <div class="d-flex gap-2 w-100 justify-content-between">
                    <div>
                        <h6 class="mb-0">Bank Rakyat Indonesia</h6>
                        <p class="mb-0 opacity-75">Rek. 666-666-666</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Transfer Bank</h1>
        <p class="lead">Isi saldo akun <b>BUCUMI</b> melalui Transfer Bank ke rekening yang tersedia dihalaman TopUp ini. Minimal transfer sebesar <i>Rp 25.000</i>, Bila telah melakukan transfer, mohon konfirmasi ke tim kami melalui formulir <b>Konfirmasi</b> atau juga dapat melalui <b>Whatsapp</b>. Terima kasih telah memilih BUCUMI sebagai destinasi pilihan Anda untuk menemukan dan menikmati beragam koleksi buku berkualitas. </p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <button type="button" onclick="javascript:window.open('<?= create_url('topup/confirm') ?>','_self')" class="btn btn-bucumi btn-lg px-4 me-md-2">Konfirmasi</button>
            <button type="button" onclick="javascript:window.open('<?= $whatsappUrlLink ?>','_blank')" class="btn btn-outline-success btn-lg px-4"><i class="bi bi-whatsapp"></i> Whatsapp</button>
        </div>
    </div>
</div>
<?php require_once('footer.layout.php'); ?>