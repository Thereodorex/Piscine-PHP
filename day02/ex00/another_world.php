#!/usr/bin/php
<?php
if ($argc < 2)
	exit();
$res = preg_replace("/[\s]+/", " ", $argv[1]);
echo preg_replace("/^[\s]+|[\s]+$/", "", $res)."\n";
?>
