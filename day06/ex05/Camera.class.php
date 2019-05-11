<?php

class Camera
{
    public static $verbose = false;

    public static function doc()
    {
        return file_get_contents('Camera.doc.txt');
    }

    private $_pos;
    private $_width;
    private $_height;
    private $_ratio;
    private $_translation_matrix;
    private $_rotate_matrix;
    private $_view_matrix;
    private $_project_matrix;

    public function __construct(array $kwa = NULL)
    {
        $this->_pos = $kwa['origin'];
        if (isset($kwa['ratio']))
        {
            $this->_ratio = $kwa['ratio'];
            $this->_width = 1000;
            $this->height = $this->_width / $this->_ratio;
        }
        else
        {
            $this->_width = $kwa['width'];
            $this->_height = $kwa['height'];
            $this->_ratio = $this->_width / $this->_height;
        }
        $this->_translation_matrix = new Matrix ( array(
        'preset' => Matrix::TRANSLATION, 'vtc' => (new Vector( array('dest' => $this->_pos)))->opposite()) );
        $this->_rotate_matrix = $kwa['orientation']->transpose();
        $this->_view_matrix = $this->_rotate_matrix->mult( $this->_translation_matrix );
        $this->_project_matrix = new Matrix ( array(
            'preset' => MATRIX::PROJECTION,
            'fov' => $kwa['fov'],
            'ratio' => $this->_ratio,
            'near' => $kwa['near'],
            'far' => $kwa['far']
        ) );
        if (Self::$verbose)
            echo "Camera instance constructed" . PHP_EOL;
    }

    public function __destruct()
    {
        if (Self::$verbose)
            echo "Camera instance destructed" . PHP_EOL;
    }

    function __toString()
		{
			$tmp  = 'Camera(' . PHP_EOL;
			$tmp .= '+ Origine: ' . $this->_pos . PHP_EOL;
			$tmp .= '+ tT:' . PHP_EOL;
			$tmp .= $this->_translation_matrix . PHP_EOL;
			$tmp .= '+ tR:' . PHP_EOL;
			$tmp .= $this->_rotate_matrix . PHP_EOL;
			$tmp .= '+ tR->mult( tT ):' . PHP_EOL;
			$tmp .= $this->_view_matrix . PHP_EOL;
			$tmp .= '+ Proj:' . PHP_EOL;
			$tmp .= $this->_project_matrix . PHP_EOL;
			$tmp .= ')';
			return ($tmp);
        }

    public function watchVertex( $worldVertex )
    {
        $vtx = $this->_project_matrix->transformVertex($this->_view_matrix->transformVertex($worldVertex));
        return new Vertex( array(
            'x' => ($vtx->getX() / $vtx->getW() + 1) * 0.5 * $this->width,
            'y' => ($vtx->getX() / $vtx->getW() + 1) * 0.5 * $this->height,
            'z' => $vtx->getZ(), 
            'w' => $vtx->getW(),
            'color' => $vtx->getColor()) );
    }

    public function watchTriangle($triangle)
    {
        $res = array();
        foreach($triangle->iter() as $key => $value)
        {
            $res[] = $this->watchVertex($value);
        }
        return new Triangle($res);
    }

    public function watchMesh(array $arr)
    {
        $res = array();
        foreach($arr as $value)
            $res[] = $this->watchTriangle($value);
        return $res;
    }
}

?>