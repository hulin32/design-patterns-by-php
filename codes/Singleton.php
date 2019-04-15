<?php 

class Singleton
{
    private static $instance;

    private function __construct(){}

    public static function getInstance()
    {
        if (static::$instance == null) 
        {
            static::$instance = new Singleton();
        }
        return static::$instance;
    }
}


//客户端代码
$s1 = Singleton::getInstance();
$s2 = Singleton::getInstance();

if ($s1 == $s2) 
{
    echo "same class";
}
