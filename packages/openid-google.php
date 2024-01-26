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

$google = \GoogleService::oauth2Client();

if (!isset($_SESSION['oauth.google.access_token'])) {
    if (!isset($_GET['code'])) {
        return redirect(filter_var($google->createAuthUrl(), FILTER_SANITIZE_URL));
    } else {
        $google->authenticate($_GET['code']);
        $_SESSION['oauth.google.access_token']= $google->getAccessToken();
    }          
}

if (!$google->getAccessToken())
    $google->setAccessToken($_SESSION['oauth.google.access_token']);