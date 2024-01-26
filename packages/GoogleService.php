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

/**
 * SDaiLover Open Source & Software Development
 *
 * @fullname  : Stephanus Bagus Saputra,
 *              ( 戴 Dai 偉 Wie 峯 Funk )
 * @email     : wiefunk@stephanusdai.web.id
 * @contact   : https://t.me/wiefunkdai
 * @support   : https://opencollective.com/wiefunkdai
 * @link      : https://www.sdailover.web.id,
 *              https://www.stephanusdai.web.id
 * @license   : https://www.sdailover.web.id/license/
 * @copyright : (c) 2023 StephanusDai Developer. All rights reserved.
 * This software using Laravel Framework has released under the terms of the MIT License.
 */

defined('GOOGLE_CLIENT_ID') or define('GOOGLE_CLIENT_ID', 'YOUR CLIENT ID');
defined('GOOGLE_CLIENT_SECRET') or define('GOOGLE_CLIENT_SECRET', 'YOUR CLIENT SECRET');
defined('GOOGLE_CLIENT_REDIRECT_URI') or define('GOOGLE_CLIENT_REDIRECT_URI', 'YOUR CALLBACK URL');

class GoogleService
{
    private static $googleClient;

    public static function oauth2Client()
    {
        if (self::$googleClient===null) {
            $google = new \Google\Client();
            $google->setClientId(GOOGLE_CLIENT_ID);
            $google->setClientSecret(GOOGLE_CLIENT_SECRET);
            $google->setRedirectUri(GOOGLE_CLIENT_REDIRECT_URI);
            $google->addScope([
                \Google\Service\Oauth2::USERINFO_EMAIL,
                \Google\Service\Oauth2::USERINFO_PROFILE,
                \Google\Service\Oauth2::OPENID
            ]);
            $google->setIncludeGrantedScopes(true);
            $google->setAccessType("offline");
            self::$googleClient = $google;
        }
        return self::$googleClient;
    }

    public static function closeClient()
    {
        if (self::$googleClient!==null)
            self::$googleClient->revokeToken(); 
        if (isset($_SESSION['oauth.google.access_token'])) {
            unset($_SESSION['oauth.google.access_token']);
        }
        self::$googleClient=null;
    }
}