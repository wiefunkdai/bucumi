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

$facebook = FacebookService::oauth2Client();

if (isset($paramName) && $paramName == 'exit' && bucumi_auth()) {
    $_SESSION['oauth.facebook.exit_bucumi'] = true;
}

if (!isset($_GET['code'])) {
    $authUrl = $facebook->getAuthorizationUrl([
        'scope' => ['email', 'public_profile', 'user_gender', 'user_location', 'user_photos'],
    ]);
    $_SESSION['oauth.facebook.oauth2state'] = $facebook->getState();
    return redirect(filter_var($authUrl, FILTER_SANITIZE_URL));        
} elseif (!isset($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth.facebook.oauth2state'])) {        
    unset($_SESSION['oauth.facebook.oauth2state']);
    return redirect(filter_var(create_url('login'), FILTER_SANITIZE_URL));
}

try
{
    $token = $facebook->getAccessToken('authorization_code', [
        'code' => $_GET['code'] ?? ''
    ]);
    $_SESSION['oauth.facebook.access_token'] = $token;
} catch (\Exception $e) {
    return redirect(filter_var(create_url('login'), FILTER_SANITIZE_URL));
}

if (isset($_SESSION['oauth.facebook.access_token'])) {
    try {
        $facebook = FacebookService::oauth2Client();
        $userProfile = $facebook->getResourceOwner($_SESSION['oauth.facebook.access_token']);
        $facebookUserID = $userProfile->getId();

        $tableName = mysqli_table_name('users');
        $SQLQuery = $SQLConnector->query( "SELECT * FROM $tableName WHERE userfacebookid='$facebookUserID';");

        $openid = [];

        if ($SQLQuery->num_rows === 0) {
            if (isset($_SESSION['oauth.facebook.exit_bucumi']))
                unset($_SESSION['oauth.facebook.exit_bucumi']);
            if (bucumi_auth()) {
                $authUserID = $authUser['userid'];
                $userFacebookID = $userProfile->getId();
                $SQLConnector->query("UPDATE $tableName SET userfacebookid='$userFacebookID' WHERE userid='$authUserID';");
                @header('Location: '.create_url($authUser['username'].'/edit'));
            } else {
                $openid['facebookid'] = $userProfile->getId();
                $openid['facebookphoto'] = $userProfile->getPictureUrl();
                $openid['facebookmail'] = $userProfile->getEmail();
                $openid['facebookname'] = $userProfile->getName();
                $openid['facebookgender'] = $userProfile->getGender();
                require_once('register-default.php');
            }
        } else {
            if (isset($_SESSION['oauth.facebook.exit_bucumi']) && bucumi_auth()) {
                $authUserID = $authUser['userid'];
                $userFacebookID = $userProfile->getId();
                $SQLConnector->query("UPDATE $tableName SET userfacebookid=NULL WHERE userid='$authUserID' AND userfacebookid='$userFacebookID';");
                unset($_SESSION['oauth.facebook.exit_bucumi']);
                @header('Location: '.create_url($authUser['username'].'/edit'));
            } else {
                if (isset($_SESSION['oauth.facebook.exit_bucumi']))
                    unset($_SESSION['oauth.facebook.exit_bucumi']);
                $model = $SQLQuery->fetch_array(MYSQLI_ASSOC);
                unset($model['userpassword']);

                if ($model['userstatus']==false) {
                    $userBlocked = true;
                    require_once('login-default.php');
                } else {
                    $_SESSION['bucumi.authuser'] = $model;
                    @header('Location: '.create_url('/'));
                }
            }
        }
    } catch (\Exception $e) {
        return redirect(create_url('login'));
    }
}