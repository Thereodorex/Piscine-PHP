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
			return FALSE;
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
	if (!ft_is_in("login", $_POST) || !ft_is_in("newpw", $_POST) || !ft_is_in("submit", $_POST) || !ft_is_in("oldpw", $_POST))
		exit ("ERROR\n");
	if ($_POST["login"] === "")
		exit ("ERROR\n");
	if ($_POST["oldpw"] === "")
		exit ("ERROR\n");
	if ($_POST["submit"] === "")
		exit ("ERROR\n");
	if ($_POST["submit"] != "OK")
		exit ("ERROR\n");
	if ($_POST["newpw"] === "")
		exit ("ERROR\n");
	if (isLoginDoenstExist($_POST["login"], $file))
		exit ("ERROR\n");
	if (!file_exists($dir))
		exit ("ERROR\n");
	if (file_exists($file))
	{
		$temp = array();
		$temp = unserialize(file_get_contents($file));
		for($i = 0; $i < count($temp); $i++)
		{
			if ($temp[$i]["login"] === $_POST["login"])
			{
				if ($temp[$i]["passwd"] === hash("whirlpool", $_POST["oldpw"]))
				{
					$temp[$i]["passwd"] = hash("whirlpool", $_POST["newpw"]);
					file_put_contents("$file", serialize($temp));
					exit("OK\n");
				}
				else
					exit ("ERROR\n");
			}
		}
	}
	exit ("ERROR\n");
?>
