<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$file = fopen("C:\Inetpub","w");


//echo $file;die;

echo fwrite($file,"Hello World. Testing!");
fclose($file);
?>