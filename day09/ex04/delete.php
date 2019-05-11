<?php
    $file = file_get_contents('list.csv');
    $fd = fopen('list.csv', 'w+');
    foreach($_GET as $key => $value)
        foreach (explode(";", $file) as $line)
        {
            $cv = array_pop(explode("=", $line));
            if ($cv !== '' && $cv !== $value)
                fwrite($fd, "$line;");
        }
    fclose($fd);