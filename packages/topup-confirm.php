<?php

if (!bucumi_auth()) {
    @header('Location: '.create_url('login'));
    exit();
}

$pageTitle = "Konfirmasi Isi Saldo";
$uploads = [];
$errors = [];
$valids = [];
$model = [];
$model['topupuserid'] = $authUser['userid'];
$uploadPhotoPath = rtrim(ASSET_PATH, '/') . '/topups';

if (!is_dir($uploadPhotoPath)) {
    mkdir($uploadPhotoPath, 0777, true);
}

if (($model=$_POST) && (isset($model) && is_array($model) && !empty($model))) {
    $tableName = mysqli_table_name($model['submit'] ?? 'users');
    $nulledfields = mysqli_null_columns($tableName);
    $requirefields = mysqli_require_columns($tableName);
    $numericfields = mysqli_numeric_columns($tableName);
    
    foreach ($model as $name=>$value) {        
        if ((in_array($name, $requirefields) && !in_array($name, $nulledfields) && !in_array($name, $numericfields)) && (empty($model[$name]) || trim($model[$name]==''))) {
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


    if (array_key_exists('topupevidencetransfer', $errors)) {
        unset($errors['topupevidencetransfer']);
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
                $uploadPhotoName = $model['topupuserid'].'-'.time().$acceptable[$fileType];
                $uploadPhotoFile = $uploadPhotoPath.'/'.$uploadPhotoName;
                if (move_uploaded_file($attributes['tmp_name'], $uploadPhotoFile)) {
                    $model[$name] = $uploadPhotoName;
                }
            }
        }
    }

    if (empty($errors) && count($errors) === 0) {
        $model['topupuserid']=$authUser['userid'];
        $queryFields = mysqli_query_params_builder($tableName, $model);
        $SQLQuery = $SQLConnector->query("INSERT INTO $tableName SET $queryFields;");    
        if ($SQLQuery) {
            @header("Location: " . create_url('/'));
            exit();
        }
    }
} else {
    $model['topupuserid'] = $authUser['userid'];
    $model['topupnamesender'] = $authUser['userfullname'];
}
?>
<?php require_once('header.layout.php'); ?>
<h1 class="text-body-emphasis border-bottom pb-3 mb-4"><?= $pageTitle ?></h1>
<?php require_once('_topup.form.php'); ?>
<?php require_once('footer.layout.php'); ?>