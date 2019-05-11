<?php

class Triangle
{
    public static $verbose = false;

    public static function doc()
    {
        return file_get_contents('Triangle.doc.txt');
    }

    private $_a;
    private $_b;
    private $_c;

    public function __construct(array $kwa = NULL)
    {
        // if (isset($kwa))
        // {
            $this->_a = $kwa[0];
            $this->_b = $kwa[1];
            $this->_c = $kwa[2];
        // }
        // else
        // {
        //     $this->_a = new Vertex();
        //     $this->_b = new Vertex();
        //     $this->_c = new Vertex();
        // }
        if (Self::$verbose)
            print("Triangle instance constructed" . PHP_EOL);
    }

    public function __destruct()
    {
        if (Self::$verbose)
            print("Triangle instance destructed" . PHP_EOL);
    }

    public function __toString()
    {
        return sprintf ("Triangle( %s, \n%s, \n%s )", $this->_a, $this->_b, $this->_c);
    }

    public function iter()
    {
        return array('A' => $this->_a, 'B' => $this->_b, 'C' => $this->_c);
    }
}

?>