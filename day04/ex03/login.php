<?php
session_start();
include("auth.php");

$file = "../private/passwd";
$dir = "../private/";
function ft_is_in($name, $where)
{
	foreach ($where as $kek => $k)
	{
		if ($kek == $name)
			return TRUE;
	}
	return FALSE;
}
	if (!file_exists($file))
		exit("ERROR\n");
	if (ft_is_in("login", $_GET) && ft_is_in("passwd", $_GET))
	{
		if (auth($_GET["login"], $_GET["passwd"]))
			$_SESSION["loggued_on_user"] = $_GET["login"];
		else
		{
			$_SESSION["loggued_on_user"] = "";
			exit("ERROR\n");
		}
		exit("OK\n");
	}
	exit("ERROR\n");
?>
