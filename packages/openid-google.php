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

if (isset($paramName) && $paramName == 'exit' && bucumi_auth()) {
    $_SESSION['oauth.google.exit_bucumi'] = true;
}

if (!isset($_SESSION['oauth.google.access_token'])) {
    if (!isset($_GET['code'])) {
        return redirect(filter_var($google->createAuthUrl(), FILTER_SANITIZE_URL));
    } else {
        $google->authenticate($_GET['code']);
        $_SESSION['oauth.google.access_token']= $google->getAccessToken();
    }          
}

if (isset($_SESSION['oauth.google.access_token'])) {
    try {
        if (!$google->getAccessToken())
            $google->setAccessToken($_SESSION['oauth.google.access_token']);
        $google = GoogleService::oauth2Client();
        $oauth2 = new \Google\Service\Oauth2($google);
        $userProfile = $oauth2->userinfo->get(); 

        $tableName = mysqli_table_name('users');
        $SQLQuery = $SQLConnector->query("SELECT * FROM $tableName WHERE usergoogleid='$userProfile->id';");

        $openid = [];
        if ($SQLQuery->num_rows === 0) {
            if (isset($_SESSION['oauth.google.exit_bucumi']))
                unset($_SESSION['oauth.google.exit_bucumi']);
            if (bucumi_auth()) {
                $authUserID = $authUser['userid'];
                $SQLConnector->query("UPDATE $tableName SET usergoogleid='$userProfile->id' WHERE userid='$authUserID';");
                @header('Location: '.create_url($authUser['username'].'/edit'));
            } else {
                $openid['googleid'] = $userProfile->id;
                $openid['googlephoto'] = $userProfile->picture;
                $openid['googlemail'] = $userProfile->email;
                $openid['googlename'] = $userProfile->name;
                require_once('register-default.php');
            }
        } else {
            if (isset($_SESSION['oauth.google.exit_bucumi']) && bucumi_auth()) {
                $authUserID = $authUser['userid'];
                $SQLConnector->query("UPDATE $tableName SET usergoogleid=NULL WHERE userid='$authUserID' AND usergoogleid='$userProfile->id';");
                unset($_SESSION['oauth.google.exit_bucumi']);
                @header('Location: '.create_url($authUser['username'].'/edit'));
            } else {
                if (isset($_SESSION['oauth.google.exit_bucumi']))
                    unset($_SESSION['oauth.google.exit_bucumi']);
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
    } catch(\Exception $e) {
        @header('Location: '.create_url('error'));
    }
}