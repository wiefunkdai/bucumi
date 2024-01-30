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

$pageTitle = "Daftar Bucumi";
$uploads = [];
$errors = [];
$valids = [];
$model = [];
$uploadPhotoPath = rtrim(ASSET_PATH, '/') . '/avatars';

if (!is_dir($uploadPhotoPath)) {
    mkdir($uploadPhotoPath, 0777, true);
}

if (($model=$_POST) && (isset($model) && is_array($model) && !empty($model))) {
    $tableName = mysqli_table_name($model['submit'] ?? 'users');
    $nulledfields = mysqli_null_columns($tableName);
    $requirefields = mysqli_require_columns($tableName);
    $numericfields = mysqli_numeric_columns($tableName);

    if (isset($model['usergoogleid'])) {
        $openid = [];
        $openid['googleid'] = $model['usergoogleid'];
        $openid['googlephoto'] = $model['userphoto'];
    }

    if (isset($model['userfacebookid'])) {
        $openid = [];
        $openid['facebookid'] = $model['userfacebookid'];
        $openid['facebookphoto'] = $model['userphoto'];
    }

    $username = $model['username'];
    if ($SQLConnector->query( "SELECT * FROM $tableName WHERE username='$username';")->num_rows!=false) {
        $errors['username'] = 'ID Pengguna telah digunakan oleh pengguna lain!';
    }

    $useremail = $model['useremail'];
    if ($SQLConnector->query( "SELECT * FROM $tableName WHERE username='$useremail';")->num_rows!=false) {
        $errors['useremail'] = 'Email telah digunakan oleh pengguna lain!';
    }

    foreach ($model as $name=>$value) {        
        if ((in_array($name, $requirefields) && !in_array($name, $nulledfields) && !in_array($name, $numericfields)) && (empty($model[$name]) || trim($model[$name]==''))) {
            $errors[$name] = 'Data wajib diinput!';
        } elseif (in_array($name, $numericfields) && !is_numeric($model[$name]) && !empty($model[$name]) && trim($model[$name]!='')) {
            $errors[$name] = 'Hanya boleh berupa angka!';
        } elseif ((in_array($name, $requirefields) && !in_array($name, $nulledfields) && in_array($name, $numericfields) && $model[$name]<>0) && (empty($model[$name]) || trim($model[$name])=='')) {
            $errors[$name] = 'Data wajib diinput!';
        } else {
            if (in_array($name, $nulledfields) && (empty($model[$name]) || trim($model[$name]==''))) {
                unset($model[$name]);
            }
            $valids[$name] = 'Terlihat bagus!';
        }
    }

    $model['userfullname'] = ucwords(strtolower($model['userfullname']), ' ');

    if ((!empty($model['username']) && trim($model['username'])!='') && !ctype_alnum(trim($model['username']))) {
        $errors['username'] = 'Username hanya mengandung huruf dan angka!';
    }

    if ((!empty($model['useremail']) && trim($model['useremail'])!='') && !preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,})$/i", trim($model['useremail']))) {
        $errors['useremail'] = 'Format email salah!';
    }

    if ((!empty($model['userpassword']) && trim($model['userpassword'])!='') && strlen(trim($model['userpassword']))<6) {
        $errors['userpassword'] = 'Kata Sandi minimal paling sedikit 6 karakter';
    }

    if (trim($model['userpassword']) != trim($model['userpasswordconfirm']) || (empty($model['userpasswordconfirm']) || trim($model['userpasswordconfirm'])=='')) {
        $errors['userpasswordconfirm'] = 'Konfirmasi sandi salah!';
    }
        
    if (isset($model['userphoto']) && (trim($model['userphoto']) <> '' || !empty(trim($model['userphoto'])))) {
        $streamPhotoFileUrl = $model['userphoto'];
        $streamPhotoType = 'image/webp';
        $streamPhotoAcceptable = array(
            'image/jpeg'=>'.jpg',
            'image/jpg'=>'.jpg',
            'image/gif'=>'.gif',
            'image/png'=>'.png'
        );
        try {
            $streamPhotoFile = file_get_contents($model['userphoto']);
            $streamPhotoType = @mime_content_type($streamPhotoFileUrl);
        } catch(\Exception $e) {
            $streamPhotoFile = file_get_contents($model['userphoto']);
            $streamPhotoBuffer = @imagecreatefromstring($streamPhotoFile);
            $fileInfo = finfo_open();
            $streamPhotoType = finfo_buffer($fileInfo, $streamPhotoFile, FILEINFO_MIME_TYPE);            
        }

        if (isset($streamPhotoAcceptable[$streamPhotoType])) {
            $uploadPhotoName = $model['username'].'-'.time().$streamPhotoAcceptable[$streamPhotoType];
            $uploadPhotoFile = $uploadPhotoPath.'/'.$uploadPhotoName;
    
            try {        
                $ch = curl_init($streamPhotoFileUrl);
                $fp = fopen($uploadPhotoFile, 'wb');
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_exec($ch);
                curl_close($ch);
                fclose($fp);
                $model['userphoto'] = $uploadPhotoName;
            } catch(\Exception $e) {
                try {
                    file_put_contents($uploadPhotoFile, $streamPhotoFile);
                    $model['userphoto'] = $uploadPhotoName;
                } catch(\Exception $e) {
                    unset($model['userphoto']);
                }
            }
        }
    }

    if (array_key_exists('userphoto', $errors)) {
        unset($errors['userphoto']);
    }

    if (($files = $_FILES) && isset($files)) {
        $maxsize    = 2097152;
        $acceptable = array(
            'image/jpeg'=>'.jpg',
            'image/jpg'=>'.jpg',
            'image/gif'=>'.gif',
            'image/png'=>'.png'
        );

        foreach($files as $name=>$attributes) {
            $fileType=$attributes['type'];
            if ((in_array($name, $requirefields) && !in_array($name, $numericfields) && !in_array($name, $nulledfields)) && $attributes['error']!==0) {
                $errors[$name] = 'Berkas wajib di upload!';
            } else {
                if ($attributes['error']===0) {
                    if(($attributes['size'] >= $maxsize) || ($attributes["size"] == 0)) {
                        $errors[$name] = 'Berkas terlalu besar! Berat berkas tidak boleh melebihi 2MB!';
                    } elseif(!in_array($fileType, array_keys($acceptable)) && (!empty($fileType))) {
                        $errors[$name] = 'Ekstensi Berkas tidak sesuai! Berkas JPG, GIF dan PNG yang diterima!';
                    } else {
                        $uploads[$name] = $attributes;
                    }                 
                }
            }
        }

        if ((!empty($uploads) && count($uploads) > 0) && (!empty($errors) && count($errors) > 0)) {
            foreach(array_keys($uploads) as $name) {
                $errors[$name] = 'Berkas gagal diterima! Silahkan ulangi kembali!';
            }
        }

        if ((!empty($uploads) && count($uploads) > 0) && (empty($errors) && count($errors) === 0)) {
            foreach($uploads as $name=>$attributes) {
                $fileType=$attributes['type'];
                $uploadPhotoName = $model['username'].'-'.time().$acceptable[$fileType];
                $uploadPhotoFile = $uploadPhotoPath.'/'.$uploadPhotoName;
                if (move_uploaded_file($attributes['tmp_name'], $uploadPhotoFile)) {
                    $model[$name] = $uploadPhotoName;
                }
            }
        }
    }

    if (empty($errors) && count($errors) === 0) {
        $model['userrole'] = 'member';
        $model['userpassword']=mysqli_input_password($model['userpassword']);
        
        $queryFields = mysqli_query_params_builder($tableName, $model);
        $SQLQuery = $SQLConnector->query("INSERT INTO $tableName SET $queryFields;");    
        if ($SQLQuery) {
            $authid = $model['username'];
            $user = $SQLConnector->query( "SELECT * FROM $tableName WHERE username='$authid';")->fetch_array(MYSQLI_ASSOC);
            unset($user['userpassword']);
            $_SESSION['bucumi.authuser'] = $user;
            @header('Location: '.create_url('/'));
            exit();
        }
    }
}
$model['userrole']='member';
?>
<?php require_once('header.layout.php'); ?>
<?php require_once('_register.form.php'); ?>
<?php require_once('footer.layout.php'); ?>