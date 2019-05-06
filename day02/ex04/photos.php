#!/usr/bin/php
<?php

function curl($url)
{
	$curl = curl_init();
	$options = [	CURLOPT_URL => $url,
					CURLOPT_HEADER => false,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_RETURNTRANSFER => true
				];
	curl_setopt_array($curl, $options);
	$res = curl_exec($curl);
	curl_close($curl);
	return ($res);
}

function get_img_urls($url, $page)
{
	$res = array();
	preg_match_all("/<img[^>]+src[\s]*=[\s]*\"([^\s>\"]+)/si", $page, $res);
	foreach ($res[1] as $key => $value)
		if (!preg_match("/^http(s?):\/\//", $res[1][$key]))
			$res[1][$key] = $url."/".$res[1][$key];
	return $res[1];
}

function download($urls, $dir)
{
	foreach($urls as $elem)
			file_put_contents($dir.strrchr($elem, "/"), curl($elem));
}

$name = explode("/", $argv[1]);
$name = $name[0]."//".$name[2];
$urls = get_img_urls($name, curl($argv[1]));
$dir = preg_replace("/\//", "", $argv[1]);
if (!file_exists($dir) || !is_dir($dir))	mkdir($dir);
download($urls, $dir);
?>
