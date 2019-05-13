<?php

class Tyrion extends Lannister
{
    public function sleepWith($obj)
    {
        if ($obj instanceof Sansa)
            print("Let's do this.". PHP_EOL);
        else
            parent::sleepWith($obj);
    }
}

?>