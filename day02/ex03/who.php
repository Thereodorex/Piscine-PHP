#!/usr/bin/php
<?php
date_default_timezone_set("Europe/Moscow");
$fp = fopen("/var/run/utmpx", 'rb');
while (strlen($bin = fread($fp, 628)))
{
	$res = unpack("a256user/a4id/a32name/ipid/itype/I2time", $bin);
	if ($res["type"] == 7)
		echo $res["user"]."  ".$res["name"]."  ".date("M  j H:i", $res['time1'])."\n";
}
?>
