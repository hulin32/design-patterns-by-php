<?php 

// 人
class Person
{   
    private $name;
    function __construct($name)
    {
        $this->name = $name;
    }

    public function show()
    {
        echo "打扮".$this->name."\n";
    }
}


// 服饰类
class Finery
{
    protected $person;

    public function decorate($person)
    {
        $this->person = $person;
    }

    public function show()
    {
        if ($this->person != null)
        {
            $this->person->show();
        }
    }
}

// 具体服饰类
class TShirts extends Finery
{
    public function show()
    {
        echo "大T恤\n";
        parent::show();
    }
}

class BigTrouser extends Finery
{
    public function show()
    {
        echo "跨裤\n";
        parent::show();
    }
}

class Sneakers extends Finery
{
    public function show()
    {
        echo "破球鞋\n";
        parent::show();
    }
}

class Suit extends Finery
{
    public function show()
    {
        echo "西装\n";
        parent::show();
    }
}

class Tie extends Finery
{
    public function show()
    {
        echo "领带\n";
        parent::show();
    }
}

class LeatherShoes extends Finery
{
    public function show()
    {
        echo "跨裤\n";
        parent::show();
    }
}


// 客户端代码
$person = new Person("alex");

echo "\n第一种装扮：\n";

$sneakers = new Sneakers();
$bigTrouser = new BigTrouser();
$tShirts = new TShirts();

$sneakers->decorate($person);
$bigTrouser->decorate($sneakers);
$tShirts->decorate($bigTrouser);
$tShirts->show();













