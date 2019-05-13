<?php
function auth($login, $passwd)
{
	$temp = array();
	$file_ = "../private/passwd";
	$temp = unserialize(file_get_contents($file_));
	if (!$file_)
		return FALSE;
	foreach($temp as $t)
	{
		if ($t["login"] === $login)
		{
			if ($t["passwd"] === hash("whirlpool", $passwd))
				return TRUE;
			else
			{
				return FALSE;
			}
		}
	}
}
?>
