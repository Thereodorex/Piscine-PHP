<?php

class Mesh
{
    public static $verbose = false;

    public static function doc()
    {
        return file_get_contents('Mesh.doc.txt');
    }

    private $_a;
    private $_b;
    private $_c;

    public function __construct(array $kwa = NULL)
    {

        if (Self::$verbose)
            print("Meshinstance constructed" . PHP_EOL);
    }

    public function __destruct()
    {
        if (Self::$verbose)
            print("Mesh instance destructed" . PHP_EOL);
    }

    public function __toString()
    {
        return "";
    }

}

?>