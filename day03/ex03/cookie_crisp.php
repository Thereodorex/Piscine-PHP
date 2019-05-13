<?php

function k_isin($key, $tab)
{
    foreach ($tab as $k => $v)
        if ($k === $key)
            return true;
    return false;
}

if (!k_isin('action', $_GET) && !k_isin('name', $_GET))
    exit;
$act = $_GET['action'];
if ($act === "set" && k_isin("value", $_GET))
    setcookie($_GET['name'], $_GET['value']);
else if ($act === "get" && $_COOKIE[$_GET['name']])
    echo $_COOKIE[$_GET["name"]]."<br>";
else if ($act === "del")
    setcookie($_GET['name'], "", time() - 100);

?>