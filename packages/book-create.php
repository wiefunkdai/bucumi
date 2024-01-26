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

$uploadCoverPath = rtrim(ASSET_PATH, '/') . '/books';
$uploadBookPath = rtrim(ASSET_PATH, '/') . '/downloads';

if (!is_dir($uploadCoverPath)) {
    mkdir($uploadCoverPath, 0777, true);
}

if (!is_dir($uploadBookPath)) {
    mkdir($uploadBookPath, 0777, true);
}

$pageTitle = "Buat Buku Baru";
$uploads = [];
$errors = [];
$valids = [];
$model = [];

if (($model=$_POST) && (isset($model) && is_array($model) && !empty($model))) {
    $tableName = mysqli_table_name($model['submit'] ?? 'books');
    $bookID = $model['bookid'] ?? strtotime("now");
    $nulledfields = mysqli_null_columns($tableName);
    $requirefields = mysqli_require_columns($tableName);
    $numericfields = mysqli_numeric_columns($tableName);


    $booktitle = $model['booktitle'];
    if ($SQLConnector->query("SELECT * FROM $tableName WHERE booktitle='$booktitle';")->num_rows!=false) {
        $errors['booktitle'] = 'Judul Buku telah digunakan!';
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

    if (array_key_exists('bookfilepath', $errors)) {
        unset($errors['bookfilepath']);
    }

    if (array_key_exists('bookcover', $errors)) {
        unset($errors['bookcover']);
    }

    if (($files = $_FILES) && isset($files)) {
        foreach($files as $name=>$attributes) {
            $maxsize    = 2097152;
            $acceptable = array(
                'image/jpeg'=>'.jpg',
                'image/jpg'=>'.jpg',
                'image/gif'=>'.gif',
                'image/png'=>'.png'
            );
            $fileType=$attributes['type'];
            if ($name=='bookfilepath') {
                $acceptable = ['application/pdf'=>'.pdf'];
                $maxsize    = 52428800;
            }
            if ((in_array($name, $requirefields) && !in_array($name, $numericfields) && !in_array($name, $nulledfields)) && $attributes['error']!==0) {
                $errors[$name] = 'Berkas wajib di upload!';
            } else {
                if ($attributes['error']===0) {
                    if(($attributes['size'] >= $maxsize) || ($attributes["size"] == 0)) {
                        $errors[$name] = 'Berkas terlalu besar! Berat berkas tidak boleh melebihi 2MB!';
                    } elseif(!in_array($fileType, array_keys($acceptable)) && (!empty($fileType))) {
                        if ($name=='bookfilepath') {
                            $errors[$name] = 'Ekstensi Berkas tidak sesuai! Berkas PDF yang diterima!';
                        } else {
                            $errors[$name] = 'Ekstensi Berkas tidak sesuai! Berkas JPG, GIF dan PNG yang diterima!';
                        }
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
            $acceptable = array(
                'application/pdf'=>'.pdf',
                'image/jpeg'=>'.jpg',
                'image/jpg'=>'.jpg',
                'image/gif'=>'.gif',
                'image/png'=>'.png'
            );
            foreach($uploads as $name=>$attributes) {
                $fileType=$attributes['type'];
                $uploadFileName = $bookID.$acceptable[$fileType];
                if ($name=='bookfilepath') {
                    $uploadFileTemp = $uploadBookPath.'/'.$uploadFileName;
                } else {
                    $uploadFileTemp = $uploadCoverPath.'/'.$uploadFileName;
                }
                if (@move_uploaded_file($attributes['tmp_name'], $uploadFileTemp)) {
                    $model[$name] = $uploadFileName;
                }
            }
        }
    }

    if (empty($errors) && count($errors) === 0) {
        $model['bookid']=$bookID;
        $queryFields = mysqli_query_params_builder($tableName, $model);
        $SQLQuery = $SQLConnector->query("INSERT INTO $tableName SET $queryFields;");    
        if ($SQLQuery) {
            @header("Location: " . create_url('book/manage'));
            exit();
        }
    }
}
?>
<?php require_once('header.layout.php'); ?>
<h1 class="text-body-emphasis border-bottom pb-3 mb-4"><?= $pageTitle; ?></h1>
<?php require_once('_book.form.php'); ?>
<?php require_once('footer.layout.php'); ?>