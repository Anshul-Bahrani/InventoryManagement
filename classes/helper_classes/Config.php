<?php
class Config 
{
    protected $config;
    //har operating system me 2 hidden files hoti hai ek hai "."(. is current directory) and ek hai ".."(.. is previous directory)
    public function __construct()
    {
        $this->config = parse_ini_file(__DIR__ ."/../../config.ini");

    }
    public function get(string $key)
    {
        if(isset($this->config[$key]))
        {
            return $this->config[$key];
        }
        die("This config cannot be found : " . $key);
    }
}