#!/usr/bin/php
<?php
if ($argc != 3 || !file_exists($argv[1]))
    exit;
$data = explode("\n", file_get_contents($argv[1]));
$keys = false;
$pass = false;
$arrays = array();
foreach ($data as $number => $value)
{
    if (!strstr($value, ";"))
        break;
    $str = explode(";", $value);
    if ($keys === false)
    {
        $keys = $str;
        foreach($keys as $num => $key)
        {
            $arrays[$key] = array();
            if ($key === $argv[2])
                $pass = $num;
        }
        if ($pass == false)
            exit;
    }
    else
        foreach ($keys as $n => $key)
            $arrays[$key][$str[$pass]] = $str[$n];
}
 foreach ($arrays as $key => $elem)
     $$key = $elem;
$stdin = fopen("php://stdin", "r");
while ($stdin && !feof($stdin))
{
    echo "Enter your command: ";
    $word = fgets($stdin);
    if ($word)
        eval($word);
}
fclose($stdin);
?>