<?php

include_once('IFighter.class.php');

class NightsWatch
{
    private $_fighters = array();

    public function recruit($rec)
    {
        if ($rec instanceof IFighter)
            $this->_fighters[] = $rec;
    }

    public function fight()
    {
        foreach ($this->_fighters as $fighter)
        {
            $fighter->fight();
        }
    }
}

?>