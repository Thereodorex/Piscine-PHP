<?php

class Matrix
{
    public static $verbose = false;

    public static function doc()
    {
        return file_get_contents('Matrix.doc.txt');
    }

    const IDENTITY = 'IDENTITY';
    const SCALE = 'SCALE';
    const RX = 'Ox ROTATION';
    const RY = 'Oy ROTATION'; 
    const RZ = 'Oz ROTATION';
    const TRANSLATION = 'TRANSLATION';
    const PROJECTION = 'PROJECTION';

    private $_preset;
    private $_scale;
    private $_angle;
    private $_vtc;
    private $_fov;
    private $_ratio;
    private $_near;
    private $_far;
    protected $matrix;

    public function __construct(array $kwargs = NULL)
    {
        for ($i = 0; $i < 4; $i += 1)
            for ($j = 0; $j < 4; $j += 1)
                $this->matrix[$i][$j] = 0;
        $this->_scale = 1;
        $this->_IDENTITY();
        if (isset($kwargs) && isset($kwargs['preset']))
        {
            $this->_preset = $kwargs['preset'];
            if ($this->_preset === Self::SCALE)
                $this->_scale = $kwargs['scale'];
            else if ($this->_preset === Self::TRANSLATION)
                $this->_vtc = $kwargs['vtc'];
            else if ($this->_preset === Self::RX || $this->_preset === Self::RY || $this->_preset === Self::RZ)
                $this->_angle = $kwargs['angle'];
            else if ($this->_preset === Self::PROJECTION)
            {
                $this->_fov = $kwargs['fov'];
                $this->_ratio = $kwargs['ratio'];
                $this->_near = $kwargs['near'];
                $this->_far = $kwargs['far'];
            }
            $func = '_' . str_replace(" ", "", strtoupper($this->_preset));
            $this->$func();
        }
        if (Self::$verbose)
        {
            if ($this->_preset === Self::IDENTITY)
                echo "Matrix " . $this->_preset . " instance constructed" . PHP_EOL;
            else
                echo "Matrix " . $this->_preset . " preset instance constructed" . PHP_EOL;
        }
    }

    public function __destruct()
    {
        if (Self::$verbose)
            print("Matrix instance destructed" . PHP_EOL);
    }

    public function __toString()
    {
        $tmp = "M | vtcX | vtcY | vtcZ | vtxO" . PHP_EOL;
        $tmp .= "-----------------------------" . PHP_EOL;
        $tmp .= sprintf ("x | %0.2f | %0.2f | %0.2f | %0.2f" . PHP_EOL, $this->matrix[0][0], $this->matrix[0][1], $this->matrix[0][2], $this->matrix[0][3]);
        $tmp .= sprintf ("y | %0.2f | %0.2f | %0.2f | %0.2f" . PHP_EOL, $this->matrix[1][0], $this->matrix[1][1], $this->matrix[1][2], $this->matrix[1][3]);
        $tmp .= sprintf ("z | %0.2f | %0.2f | %0.2f | %0.2f" . PHP_EOL, $this->matrix[2][0], $this->matrix[2][1], $this->matrix[2][2], $this->matrix[2][3]);
        $tmp .= sprintf ("w | %0.2f | %0.2f | %0.2f | %0.2f", $this->matrix[3][0], $this->matrix[3][1], $this->matrix[3][2], $this->matrix[3][3]);
        return $tmp;
    }

    private function _IDENTITY()
    {
        $this->matrix[0][0] = $this->matrix[1][1] = $this->matrix[2][2] = $this->_scale;
        $this->matrix[3][3] = 1;
    }

    private function _SCALE()
    {
        $this->_IDENTITY();
    }

    private function _TRANSLATION()
    {
        $this->matrix[0][3] = $this->_vtc->getX();
        $this->matrix[1][3] = $this->_vtc->getY();
        $this->matrix[2][3] = $this->_vtc->getZ();
    }

    private function _isnull($num)
    {
        return $num == 0.0 ? 0.01 : $num;
    }

    private function _PROJECTION()
    {
        $this->matrix[1][1] = 1 / $this->_isnull(tan(0.5 * deg2rad($this->_fov)));
        $this->matrix[0][0] = $this->matrix[1][1] / $this->_isnull($this->_ratio);
        $this->matrix[2][2] = -1 * (-$this->_near - $this->_far) / $this->_isnull($this->_near - $this->_far);
        $this->matrix[3][2] = -1;
        $this->matrix[2][3] = (2 * $this->_near * $this->_far) / $this->_isnull($this->_near - $this->_far);
        $this->matrix[3][3] = 0;
    }

    private function _OXROTATION() {
        $this->matrix[0][0] = 1;
        $this->matrix[1][1] = cos($this->_angle);
        $this->matrix[1][2] = -sin($this->_angle);
        $this->matrix[2][1] = sin($this->_angle);
        $this->matrix[2][2] = cos($this->_angle);
    }

    private function _OYROTATION() {
        $this->matrix[0][0] = cos($this->_angle);
        $this->matrix[0][2] = sin($this->_angle);
        $this->matrix[1][1] = 1;
        $this->matrix[2][0] = -sin($this->_angle);
        $this->matrix[2][2] = cos($this->_angle);
    }

    private function _OZROTATION() {
        $this->matrix[0][0] = cos($this->_angle);
        $this->matrix[0][1] = -sin($this->_angle);
        $this->matrix[1][0] = sin($this->_angle);
        $this->matrix[1][1] = cos($this->_angle);
        $this->matrix[2][2] = 1;
    }

    public function transpose()
    {
        $tmp = new Matrix();
        for ($i = 0; $i < 4; $i++)
            for ($j = 0; $j < 4; $j++)
                $tmp->matrix[$i][$j] = $this->matrix[$j][$i];
        return $tmp;
    }

    public function transformVertex(Vertex $vtx) {
        $tmp = array();
        $tmp['x'] = ($vtx->getX() * $this->matrix[0][0]) +
        ($vtx->getY() * $this->matrix[0][1]) + ($vtx->getZ() * $this->matrix[0][2]) +
        ($vtx->getW() * $this->matrix[0][3]);
        $tmp['y'] = ($vtx->getX() * $this->matrix[1][0]) +
        ($vtx->getY() * $this->matrix[1][1]) + ($vtx->getZ() * $this->matrix[1][2]) +
        ($vtx->getW() * $this->matrix[1][3]);
        $tmp['z'] = ($vtx->getX() * $this->matrix[2][0]) +
        ($vtx->getY() * $this->matrix[2][1]) + ($vtx->getZ() * $this->matrix[2][2]) +
        ($vtx->getW() * $this->matrix[2][3]);
        $tmp['w'] = ($vtx->getX() * $this->matrix[3][0]) +
        ($vtx->getY() * $this->matrix[3][1]) + ($vtx->getZ() * $this->matrix[3][2]) +
        ($vtx->getW() * $this->matrix[3][3]);
        $tmp['color'] = $vtx->getColor();
        $vertex = new Vertex($tmp);
        return $vertex;
    }

    public function transformTriangle(Triangle $triangle)
    {
        $res = array();
        foreach($triangle->iter() as $key => $value)
            $res[] = $this->transformVertex($value);
        $hz = new Triangle($res);
        return new Triangle($res);
    }

    public function transformMesh(array $arr)
    {
        $res = array();
        foreach($arr as $value)
            $res[] = $this->transformTriangle($value);
        return $res;
    }

    public function mult(Matrix $rhs)
    {
        $ver = Self::$verbose;
        Self::$verbose = false;
        $tmp = array();
        for ($i = 0; $i < 4; $i += 1)
            for ($j = 0; $j < 4; $j += 1)
            {
                $tmp[$i][$j] = 0;
                for ($k = 0; $k < 4; $k += 1)
                    $tmp[$i][$j] += $this->matrix[$i][$k] * $rhs->matrix[$k][$j];
            }
        $clone = new Matrix();
        $clone->matrix = $tmp;
        Self::$verbose = $ver;
        return $clone;
    }
}
?>