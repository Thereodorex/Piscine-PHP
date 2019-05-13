<?php
	function ft_is_in($name, $where)
	{
		foreach ($where as $kek => $k)
		{
			if ($kek == $name)
				return TRUE;
		}
		return FALSE;
	}
	function isLoginDoenstExist($name, $file)
	{
		if (file_exists($file) === FALSE)
			return TRUE;
		$s = file_get_contents($file);
		$s = unserialize($s);
		foreach($s as $kek => $n)
		{
			if ($n["login"] === $name)
				return FALSE;
		}
		return TRUE;
	}
	$file = "../private/passwd";
	$dir = "../private/";
	if (!ft_is_in("login", $_POST) || !ft_is_in("passwd", $_POST) || !ft_is_in("submit", $_POST))
		exit ("ERROR\n");
	if ($_POST["login"] === "")
		exit ("ERROR\n");
	if ($_POST["passwd"] === "")
		exit ("ERROR\n");
	if ($_POST["submit"] === "")
		exit ("ERROR\n");
	if ($_POST["submit"] != "OK")
		exit ("ERROR\n");
	if (!isLoginDoenstExist($_POST["login"], $file))
		exit ("ERROR\n");
	else
		$new_user = array ("login" => $_POST["login"], "passwd" => hash("whirlpool",$_POST["passwd"]));
	if (!file_exists($dir))
		mkdir($dir, 0755, TRUE);
	if (file_exists($file))
	{
		$temp = array();
		$temp = unserialize(file_get_contents($file));
		$temp[] = $new_user;
		file_put_contents("$file", serialize($temp));
	}
	else
	{
		$temp = array();
		$temp[] = $new_user;
		file_put_contents("$file", serialize($temp));
	}
	exit("OK\n");
?>
