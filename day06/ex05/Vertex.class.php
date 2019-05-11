<?php

require_once 'Color.class.php';

class Vertex
{
    public static $verbose = false;

    public static function doc()
    {
        return file_get_contents('Vertex.doc.txt');
    }

    private $_x;
    private $_y;
    private $_z;
    private $_w;
    private $_color;

    public function __construct(array $kwargs)
    {
        if (isset($kwargs['x']))
            $this->_x = $kwargs['x'];
        else
            $this->_x = 0;
        if (isset($kwargs['y']))
            $this->_y = $kwargs['y'];
        else
            $this->_y = 0;
        if (isset($kwargs['z']))
            $this->_z = $kwargs['z'];
        else
            $this->_z = 0;
        if (isset($kwargs['w']))
            $this->_w = $kwargs['w'];
        else
            $this->_w = 1.0;
        if (isset($kwargs['color']))
            $this->_color = $kwargs['color'];
        else
            $this->_color = new Color( array('rgb' => 0xffffff) );
        if (Self::$verbose)
            print ("$this constructed" . PHP_EOL);
    }

    public function __destruct()
    {
        if (Self::$verbose)
            print ("$this destructed" . PHP_EOL);
    }

    public function __toString()
    {
        if (Self::$verbose)
            return sprintf ("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s )", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color);
        else
            return sprintf ("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f )", $this->_x, $this->_y, $this->_z, $this->_w);
    }

    public function getX()
    {
        return $this->_x;
    }

    public function getY()
    {
        return $this->_y;
    }

    public function getZ()
    {
        return $this->_z;
    }

    public function getW()
    {
        return $this->_w;
    }

    public function getColor()
    {
        return $this->_color;
    }

    public function setX($x)
    {
        $this->_x = $x;
    }

    public function setY($y)
    {
       $this->_y = $y;
    }

    public function setZ($z)
    {
        $this->_z = $z;
    }

    public function setW($w)
    {
        $this->_w = $w;
    }

    public function setColor($color)
    {
        $this->_color = $color;
    }
}

?>