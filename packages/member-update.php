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

if (!bucumi_auth()) {
    @header('Location: '.create_url('login'));
    exit();
  } elseif ($authUser['userrole']<>'admin') {
    throw new \Exception('Hanya admin yang berhak mengakses halaman ini!');
    exit();
  }
  

$pageTitle = "Buat Anggota Baru";
$uploads = [];
$errors = [];
$valids = [];
$model = [];
$uploadPhotoPath = rtrim(ASSET_PATH, '/') . '/avatars';

if (!is_dir($uploadPhotoPath)) {
    mkdir($uploadPhotoPath, 777, true);
}

if (($model=$_POST) && (isset($model) && is_array($model) && !empty($model))) {
    $tableName = mysqli_table_name($model['submit'] ?? 'users');
    $nulledfields = mysqli_null_columns($tableName);
    $requirefields = mysqli_require_columns($tableName);
    $numericfields = mysqli_numeric_columns($tableName);

    if ($model['username']!=$model['usernameold']) {
        $username = $model['username'];
        $usernameold = $model['usernameold'];
        if ($SQLConnector->query( "SELECT * FROM $tableName WHERE username='$username' AND username!='$usernameold';")->num_rows!=false) {
            $errors['username'] = 'ID Pengguna telah digunakan oleh pengguna lain!';
        }
    }
    
    if ($model['useremail']!=$model['useremailold']) {
        $useremail = $model['useremail'];
        $useremailold = $model['useremailold'];
        if ($SQLConnector->query( "SELECT * FROM $tableName WHERE useremail='$useremail' AND useremail!='$useremailold';")->num_rows!=false) {
            $errors['useremail'] = 'Email telah digunakan oleh pengguna lain!';
        }
    }

    if (in_array('userpassword', $requirefields) && (empty($model['userpassword']) || trim($model['userpassword'])=='')) {
        unset($requirefields[array_search('userpassword', $requirefields)]);
    }

    foreach ($model as $name=>$value) {        
        if (($name!='userpassword' && in_array($name, $requirefields) && !in_array($name, $nulledfields) && !in_array($name, $numericfields)) && (empty($model[$name]) || trim($model[$name]==''))) {
            $errors[$name] = 'Data wajib diinput!';
        } elseif (in_array($name, $numericfields) && !is_numeric($model[$name]) && !empty($model[$name]) && trim($model[$name]!='')) {
            $errors[$name] = 'Hanya boleh berupa angka!';
        } elseif ((in_array($name, $requirefields) && !in_array($name, $nulledfields) && in_array($name, $numericfields) && $model[$name]==0) && (empty($model[$name]) || trim($model[$name])=='')) {
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

    if ((!empty($model['userpassword']) && trim($model['userpassword'])!='') && strlen(trim($model['userpassword'])) < 6) {
        $errors['userpassword'] = 'Kata Sandi minimal paling sedikit 6 karakter';
    }

    if ((!empty($model['userpassword']) && trim($model['userpassword'])!='') && (trim($model['userpassword']) != trim($model['userpasswordconfirm']) || (empty($model['userpasswordconfirm']) || trim($model['userpasswordconfirm'])==''))) {
        $errors['userpasswordconfirm'] = 'Konfirmasi sandi salah!';
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
                if ($attributes['error'] === 0) {
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
        $userID = $model['userid'];
        $model['userrole'] = 'member';
        if ((empty($model['userpassword']) || trim($model['userpassword'])=='')) {
            unset($model['userpassword']);
        } else {
            $model['userpassword']=mysqli_input_password($model['userpassword']);
        }
        $queryFields = mysqli_query_params_builder($tableName, $model);
        $authUserID = $authUser['userid'];
        $SQLQuery = $SQLConnector->query("UPDATE $tableName SET $queryFields WHERE userid='$userID' AND userrole='member';");    
        if ($SQLQuery) {
            @header("Location: " . create_url('member/manage'));
            exit();
        }
    }
} else {
    $userid = isset($_GET['id']) ? $_GET['id'] : $_POST['userid'] ?? 'default';
    $tableName = mysqli_table_name('users');
    $authUserID = $authUser['userid'];
    $SQLQuery = $SQLConnector->query( "SELECT * FROM $tableName WHERE userid='$userid' AND userrole='member';");
    if ($SQLQuery->num_rows === 0) {
        throw new \Exception('Data is invalid!');
        exit();
    }
    $model = $SQLQuery->fetch_array(MYSQLI_ASSOC);
    $pageTitle = "Anggota ".ucfirst($model['username']);
    $model['userpassword'] = null;
    $model['usernameold'] = $model['username'];
    $model['useremailold'] = $model['useremail'];
}
?>
<?php require_once('header.layout.php'); ?>
<h1 class="text-body-emphasis border-bottom pb-3 mb-4"><?= $pageTitle; ?></h1>
<?php require_once('_member.form.php'); ?>
<?php require_once('footer.layout.php'); ?>