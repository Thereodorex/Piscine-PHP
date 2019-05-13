<?

abstract class Fighter
{
    public $_fighter_type;

    public function __construct($fighter_type)
    {
        $this->_fighter_type = $fighter_type;
    }

    abstract public function fight($target);
}

?>