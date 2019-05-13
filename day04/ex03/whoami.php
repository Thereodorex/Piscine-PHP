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
	session_start();
	if (ft_is_in("loggued_on_user", $_SESSION))
		echo $_SESSION["loggued_on_user"] . PHP_EOL;
	else
		exit("ERROR\n");
?>
