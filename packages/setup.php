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

@session_start();
@set_error_handler("error_handler");
@set_exception_handler('exception_handler');

defined('ASSET_PATH') or define('ASSET_PATH', dirname(__DIR__).'/resources/media/');
defined('APPLICATON_PATH') or define('APPLICATON_PATH', dirname(__DIR__));
defined('TEMPLATE_PATH') or define('TEMPLATE_PATH', __DIR__);
defined('TEMPLATE_ERROR_PAGE') or define('TEMPLATE_ERROR_PAGE', rtrim(TEMPLATE_PATH, '/').'/error-default.php');
defined('WEBSITE_URI') or define('WEBSITE_URI', 'http://localhost/bucumi');
defined('ASSET_URI') or define('ASSET_URI', 'http://localhost/bucumi/resources/media/');
defined('GOOGLE_CLIENT_ID') or define('GOOGLE_CLIENT_ID', 'YOUR CLIENT ID');
defined('GOOGLE_CLIENT_SECRET') or define('GOOGLE_CLIENT_SECRET', 'YOUR CLIENT SECRET');
defined('GOOGLE_CLIENT_REDIRECT_URI') or define('GOOGLE_CLIENT_REDIRECT_URI', 'YOUR CALLBACK URL');
defined('FACEBOOK_CLIENT_ID') or define('FACEBOOK_CLIENT_ID', 'YOUR CLIENT ID');
defined('FACEBOOK_CLIENT_SECRET') or define('FACEBOOK_CLIENT_SECRET', 'YOUR CLIENT SECRET');
defined('FACEBOOK_CLIENT_REDIRECT_URI') or define('FACEBOOK_CLIENT_REDIRECT_URI', 'YOUR CALLBACK URL');
defined('FACEBOOK_GRAPH_API_VERSION') or define('FACEBOOK_GRAPH_API_VERSION', 'YOUR GRAPH API');
defined('DB_HOST') or define('DB_HOST', 'localhost');
defined('DB_USER') or define('DB_USER', 'root');
defined('DB_PASS') or define('DB_PASS', '');
defined('DB_USE') or define('DB_USE', 'pwd_bucumi');
defined('DB_PREFIX') or define('DB_PREFIX', 'sd_');

require(APPLICATON_PATH.'/vendor/autoload.php');
require(__DIR__.'/GoogleService.php');
require(__DIR__.'/FacebookService.php');

function error_handler($level, $message, $file, $line) {
    throw new \ErrorException($message, $level, E_ERROR, $file, $line);
}

function exception_handler(Throwable $exception) {
    try {
        @header($_SERVER["SERVER_PROTOCOL"]." 500 Server Error");
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            echo json_encode($exception);
        } else {
            print_r("<!--// Error System Server: \n");
            print_r($exception);
            print_r("//-->\n");
            require(TEMPLATE_ERROR_PAGE);
        }
    } catch (\Exception $ex) {
        echo("<script>window.open('".create_url('error')."','_self');</script>");
    }
    exit(0);
}

function redirect($targetLink) {
    header('Location: '.trim($targetLink,'/'));
}

function create_url($targetLink) {
    return WEBSITE_URI . trim($targetLink,'/');
}

function create_assetlink($targetLink) {
    return ASSET_URI . trim($targetLink,'/');
}

function bucumi_user() {
    return isset($_SESSION['bucumi.authuser']) ? $_SESSION['bucumi.authuser'] :[];
}

function bucumi_auth() {
    return isset($_SESSION['bucumi.authuser']);
}

function mysqli_table_name($name) {
    return DB_PREFIX.str_replace(DB_PREFIX, '', $name);
}

function mysqli_null_columns($table_name) {
    $dbName = DB_USE;
    $tableName = mysqli_table_name($table_name);
    $SQLConnector = $SQLConnector ?? new mysqli(DB_HOST, DB_USER, DB_PASS, DB_USE);
    $sqlQuery = $SQLConnector->query("SELECT COLUMN_NAME FROM information_schema.COLUMNS  WHERE TABLE_SCHEMA='$dbName' AND TABLE_NAME='$tableName' AND IS_NULLABLE='YES' AND COLUMN_DEFAULT='NULL';");
    $sqlRows = [];
    while ($rows = $sqlQuery->fetch_assoc()) {
        array_push($sqlRows, $rows['COLUMN_NAME']);
    }
    return $sqlRows;
}

function mysqli_require_columns($table_name) {
    $dbName = DB_USE;
    $tableName = mysqli_table_name($table_name);
    $SQLConnector = $SQLConnector ?? new mysqli(DB_HOST, DB_USER, DB_PASS, DB_USE);
    $sqlQuery = $SQLConnector->query("SELECT COLUMN_NAME FROM information_schema.COLUMNS  WHERE TABLE_SCHEMA='$dbName' AND TABLE_NAME='$tableName' AND IS_NULLABLE='NO';");
    $sqlRows = [];
    while ($rows = $sqlQuery->fetch_assoc()) {
        array_push($sqlRows, $rows['COLUMN_NAME']);
    }
    return $sqlRows;
}

function mysqli_numeric_columns($table_name) {
    $dbName = DB_USE;
    $tableName = mysqli_table_name($table_name);
    $SQLConnector = $SQLConnector ?? new mysqli(DB_HOST, DB_USER, DB_PASS, DB_USE);
    $sqlQuery = $SQLConnector->query("SELECT COLUMN_NAME FROM information_schema.COLUMNS  WHERE TABLE_SCHEMA='$dbName' AND TABLE_NAME='$tableName' AND DATA_TYPE IN ('BIT','TINYINT','BOOL','BOOLEAN','SMALLINT','MEDIUMINT','INT','INTEGER','BIGINT','FLOAT','DOUBLE','DECIMAL','DEC');");
    $sqlRows = [];
    while ($rows = $sqlQuery->fetch_assoc()) {
        array_push($sqlRows, $rows['COLUMN_NAME']);
    }
    return $sqlRows;
}

function mysqli_all_columns($table_name) {
    $dbName = DB_USE;
    $tableName = mysqli_table_name($table_name);
    $SQLConnector = $SQLConnector ?? new mysqli(DB_HOST, DB_USER, DB_PASS, DB_USE);
    $sqlQuery = $SQLConnector->query("SELECT COLUMN_NAME FROM information_schema.COLUMNS  WHERE TABLE_SCHEMA='$dbName' AND TABLE_NAME='$tableName';");
    $sqlRows = [];
    while ($rows = $sqlQuery->fetch_assoc()) {
        array_push($sqlRows, $rows['COLUMN_NAME']);
    }
    return $sqlRows;
}

function mysqli_input_field($value) {
    $SQLConnector = $SQLConnector ?? new mysqli(DB_HOST, DB_USER, DB_PASS, DB_USE);
    return mysqli_real_escape_string($SQLConnector, strip_tags(trim($value)));
}

function mysqli_input_password($value) {
    return sha1(mysqli_input_field($value));
}

function mysqli_query_params_builder($table_name, $params) {
    $results = [];
    $tableName = mysqli_table_name($table_name);
    $tableColumns = mysqli_all_columns($tableName);
    foreach ($tableColumns as $field) {
        if (isset($params[$field])) {
            $value = mysqli_input_field($params[$field]);
            $results[] = "$field='$value'";
        }
    }
    return implode(',', $results);
}