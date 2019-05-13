<html>
<head></head>
<body>
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
	if (ft_is_in("login", $_SESSION) && ft_is_in("passwd", $_SESSION))
	{
		echo "<p> You're in!\n</p>";
	}
	else if (ft_is_in("submit", $_GET) && ft_is_in("login", $_GET) && ft_is_in("passwd", $_GET))
	{
		if (!($_GET["login"] === "") && !($_GET["passwd"] === ""))
		{
			$_SESSION['login'] = $_GET["login"];
			$_SESSION['passwd'] = $_GET["passwd"];
			echo "<p>authorization successful!</p>";
		}
	}
?>
<form method="GET" name="index.php">
	<p><input class="login" type="text" name="login" placeholder="login" required></p>
	<p><input class="passwd" type="password" name="passwd" placeholder="passwd" required></p>
	<p><button type="submit" name="submit" value="OK">OK</button></p>
</form></body>
</html>
