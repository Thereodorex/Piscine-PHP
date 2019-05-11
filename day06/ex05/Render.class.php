<?php

class Render
{
    public static $verbose = false;

    public static function doc()
    {
        return file_get_contents('Render.doc.txt');
    }

    const VERTEX = '_renderVertex';
    const EDGE = '_renderEdge';
    const RASTERIZE = '_renderRast';

    private $_width;
    private $_height;
    private $_filename;
    private $_image;

    public function __construct(array $kwa = NULL)
    {
        $this->_width = $kwa['width'];
        $this->_height = $kwa['height'];
        $this->_filename = $kwa['filename'];
        $this->_image = imagecreate($this->_width, $this->_height);
        imagecolorallocate($this->_image, 0, 0, 0);
        if (Self::$verbose)
            print("Render instance constructed" . PHP_EOL);
    }

    public function __destruct()
    {
        if (Self::$verbose)
            print("Render instance destructed" . PHP_EOL);
    }

    public function __toString()
    {
        return "";
    }

    public function renderVertex($screenVertex)
    {
        //echo $screenVertex->getX()." ".$screenVertex->getY()." ".$screenVertex->color->red." ".$screenVertex->color->green." ".$screenVertex->color->blue."\n";
        imagesetpixel($this->_image, $screenVertex->getX(), $screenVertex->getY(),
        imagecolorallocate($this->_image, $screenVertex->color->red, $screenVertex->color->green, $screenVertex->color->blue));
        // imagesetpixel($this->_image, 100, 100,
        // imagecolorallocate($this->_image, 255, 0, 0));
    }

    public function renderMesh(array $arr, $mode)
    {
        foreach($arr as $value)
            $this->renderTriangle($value, $mode);
    }

    public function renderTriangle($triangle, $mode)
    {
        if ($mode === Self::VERTEX || $mode === Self::EDGE || $mode === Self::RASTERIZE)
        {
            $this->$mode($triangle);
        }
    }

    public function develop()
    {
        imagepng($this->_image, $this->_filename);
    }

    private function _renderVertex($triangle)
    {
        //print($triangle."\n");
        foreach($triangle->iter() as $elem)
            $this->renderVertex($elem);
    }

    private function _renderEdge($triangle)
    {
        
    }

    private function _renderRast($triangle)
    {
        
    }
}

// $magenta = new Color( array( 'red' => 0xff, 'green' => 0   , 'blue' => 0xff ) );
// $white   = new Color( array( 'red' => 0xff, 'green' => 0xff, 'blue' => 0xff ) );
// $grey    = new Color( array( 'red' => 70  , 'green' => 70  , 'blue' => 70   ) );
    
// $ren = new Render (['width' => 640, 'height' => 480, 'filename' => 'pic.png']);

// $image = imagecreate(125, 125);
// $blue = imagecolorallocate($image, 0, 0, 255);
// $red = imagecolorallocate($image, 255, 0, 0);
// imagepng($image, "blue.png");
// imagedestroy($image);
?>