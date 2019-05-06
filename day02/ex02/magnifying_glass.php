#!/usr/bin/php
<?php
function up($line)
{	return ($line[1].strtoupper($line[2]).$line[3]); }
function find($line)
{
	$line = preg_replace_callback('/( title=")(.*?)(")/i', "up", $line[0]);
	$line = preg_replace_callback("/( title=')(.*?)(')/i", "up", $line);
	return (preg_replace_callback("/(>)(.*?)(<)/s", "up", $line));
}
if ($argc < 2 || !file_exists($argv[1]))
	exit;
$page = file_get_contents($argv[1]);
$page = preg_replace_callback("/(<a.*>.*<.*a>)/si", "find", $page);
echo $page;
?>
