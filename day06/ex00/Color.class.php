<?php

class Color
{
    public static $verbose = false;

    public static function doc()
    {
        return file_get_contents('Color.doc.txt');
    }

    public $red;
    public $green;
    public $blue;

    public function __construct(array $kwargs)
    {
        if (isset($kwargs['rgb']))
        {
            $value = intval($kwargs['rgb']);
            $this->red = ($value & (0xff << 16)) >> 16;
            $this->green = ($value & (0xff << 8)) >> 8;
            $this->blue = $value & 0xff;
        }
        else
        {
            $this->red = intval($kwargs['red']) & 0xff;
            $this->green = intval($kwargs['green']) & 0xff;
            $this->blue = intval($kwargs['blue']) & 0xff;
        }
        if (Self::$verbose)
        {
            echo $this->__toString();
            echo " constructed." . PHP_EOL;
        }
    }

    public function __destruct()
    {
        if (Self::$verbose)
        {
            echo $this->__toString();
            echo " destructed." . PHP_EOL;
        }
    }

    public function __toString()
    {
        return sprintf ("Color( red: %3u, green: %3u, blue: %3u )", $this->red, $this->green, $this->blue);
    }

    public function add($color)
    {
        $r = ($this->red + $color->red) & 0xff;
        $g = ($this->green + $color->green) & 0xff;
        $b = ($this->blue + $color->blue) & 0xff;
        return new Color( array('rgb' => ($r << 16 | $g << 8 | $b)) );
    }

    public function sub($color)
    {
        $r = ($this->red - $color->red) & 0xff;
        $g = ($this->green - $color->green) & 0xff;
        $b = ($this->blue - $color->blue) & 0xff;
        return new Color( array('rgb' => ($r << 16 | $g << 8 | $b)) );
    }

    public function mult($value)
    {
        $r = ($this->red * $value) & 0xff;
        $g = ($this->green * $value) & 0xff;
        $b = ($this->blue * $value) & 0xff;
        return new Color( array('rgb' => ($r << 16 | $g << 8 | $b)) );
    }
}

?>