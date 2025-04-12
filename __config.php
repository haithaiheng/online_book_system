<?php
define('BASE_PATH',str_replace('\\','/',dirname(__FILE__)).'/');
$http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'? "https://" : "http://";
$host  = $_SERVER['HTTP_HOST'];
// $host_upper = strtoupper($host);
$path   = trim(str_replace($_SERVER['DOCUMENT_ROOT'],'',BASE_PATH),'');
$baseurl = $http . $host . $path ;
?>