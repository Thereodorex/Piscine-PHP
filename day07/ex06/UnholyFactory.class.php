<?

class UnholyFactory
{
    private $_absorbed;

    public function absorb($fighter)
    {
        if ($fighter instanceof Fighter)
        {
            if (isset($this->_absorbed[$fighter->_fighter_type]))
                printf("(Factory already absorbed a fighter of type %s)" . PHP_EOL, $fighter->_fighter_type);
            else
            {
                $this->_absorbed[$fighter->_fighter_type] = $fighter;
                printf("(Factory absorbed a fighter of type %s)" . PHP_EOL, $fighter->_fighter_type);
            }
        }
        else
            print("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
    }

    public function fabricate($fighter)
    {
        if (isset($this->_absorbed[$fighter]))
        {
            print ("(Factory fabricates a fighter of type $fighter)". PHP_EOL);
            return (clone $this->_absorbed[$fighter]);
        }
        else
            print("(Factory hasn't absorbed any fighter of type $fighter)" . PHP_EOL);
    }
}

?>