<?php
$file = explode(";", file_get_contents('list.csv'));
foreach ($_GET as $key => $value)
    if (!in_array("$value=$value", $file))
        file_put_contents("list.csv", "$value=$value;", FILE_APPEND);