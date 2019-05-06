#!/usr/bin/php
<?php
date_default_timezone_set('Europe/Paris');
if ($argc < 2)
	exit;
$pcs = array();
$res = preg_match('/([Ll]undiv|[Mm]ardi|[Mm]ercredi|[jJ]eudi|[vV]endredi|[sS]amedi|[dD]imanche) ([0-9]|[01][0-9]) ([jJ]anvier|[fF]evrier|[mM]ars|[aA]vril|[mM]ai|[jJ]uin|[jJ]uillet|[aA]out|[sS]eptembre|[oO]ctobre|[nN]ovembre|[dD]ecembre) ([0-9]{4}) (([0-2][0-9]):([0-5][0-9]):([0-5][0-9]))/', $argv[1], $pcs);
if (!$res)
{
	echo "Wrong Format\n";
	exit;
}
$month = array (1 => "janvier",
				2 => "fevrier",
				3 => "mars",
				4 => "aavril",
				5 => "mai",
				6 => "juin",
				7 => "jullet",
				8 => "aout",
				9 => "septembre",
				10 => "octobre",
				11 => "novembre",
				12 => "decembre");
$pcs[3] = array_search(strtolower($pcs[3]), $month);
$time = strtotime($pcs[2] . "-" . $pcs[3] . "-" . $pcs[4] . " " . $pcs[5]);
if ($time)
	echo "$time\n";
else
	echo "Wrong Format\n";
?>
