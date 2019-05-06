#!/usr/bin/php
<?php

if ($argc != 2 || !file_exists($argv[1]))
    exit;

$data = preg_split("~^[0-9]+\n~m", file_get_contents($argv[1]));
array_shift($data);
sort($data);

$i = 0;
while ($i < count($data))
{
    $tmp = preg_replace("/^\n$/m", "", $data[$i]);
    $i += 1;
    echo("$i\n".$tmp);
    if ($i != count($data))
        echo("\n");
}

?>