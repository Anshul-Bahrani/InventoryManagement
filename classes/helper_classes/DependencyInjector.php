<?php
class DependencyInjector
{
    private $dependencies = [];
    public function set(string $key, $value)
    {
        $this->dependencies[$key] = $value;
    }

    public function get(string $key)
    {
        if(isset($this->dependencies[$key]))
        {
            return $this->dependencies[$key]; //returns $value
        }
        die('This dependency was not found:' . $key);
    }
}