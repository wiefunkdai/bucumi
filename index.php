<?php
/**
 * BUCUMI : https://sdailover.web.id/campus/bucumi/
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

require_once(__DIR__.'/packages/setup.php');

$SQLConnector = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_USE);
$SQLPrefix = DB_PREFIX;
$authUser = bucumi_user();

$pathInfo = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : null;
$scriptName = basename($_SERVER['SCRIPT_FILENAME']);
$scriptUrl = basename($_SERVER['PHP_SELF']) === $scriptName ? $_SERVER['PHP_SELF'] : '';
$baseUrl = rtrim(dirname($scriptUrl),'\\/');;
if(($pos = strpos($pathInfo, '?')) !== false)
    $pathInfo = substr($pathInfo, 0, $pos);

if(strpos($pathInfo,$scriptUrl) === 0)
    $pathInfo= substr($pathInfo, strlen($scriptUrl));
elseif($baseUrl === '' || strpos($pathInfo, $baseUrl) === 0)
    $pathInfo = substr($pathInfo, strlen($baseUrl));
elseif(strpos($_SERVER['PHP_SELF'], $scriptUrl) === 0)
    $pathInfo = substr($_SERVER['PHP_SELF'], strlen($scriptUrl));

if($pathInfo === '/' || $pathInfo === false)
    $pathInfo = '';
elseif($pathInfo !== '' && $pathInfo[0] === '/')
    $pathInfo = substr($pathInfo, 1);
if(($posEnd = strlen($pathInfo)-1) > 0 && $pathInfo[$posEnd] === '/')
    $pathInfo=substr($pathInfo, 0, $posEnd);

$routePart = trim($pathInfo, '/');
$pageName = $routePart !== '' ? $routePart : 'mainsite';
$actionName = 'default';
$paramName = false;
if (strpos($routePart, '/') !== false) {
    $routePart = explode('/', $routePart);
    $pageName = $routePart[0] ?? 'mainsite';
    $actionName = $routePart[1] ?? 'default';
    $paramName = $routePart[2] ?? false;
}

$userTable = mysqli_table_name('users');
$userQuery = $SQLConnector->query("SELECT * FROM $userTable WHERE username='$pageName' AND userstatus=1;");
if ($userQuery->num_rows!==0) {
    $model = $userQuery->fetch_array(MYSQLI_ASSOC);
    $pageTemplate = rtrim(TEMPLATE_PATH, '/').'/profile-'.$actionName.'.php';
    require $pageTemplate;
} else {
    $pageTemplate = rtrim(TEMPLATE_PATH, '/').'/'.$pageName.'-'.$actionName.'.php';
    require $pageTemplate;
}