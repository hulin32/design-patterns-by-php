<?php 

//篮球翻译适配器
abstract class Player
{
    protected $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    abstract public function Attack();
    abstract public function Defense();
}

//前锋
class Forwards extends Player
{
    public function Attack()
    {
        echo "前锋:".$this->name." 进攻\n";
    }
    public function Defense()
    {
        echo "前锋:".$this->name." 防守\n";
    }
}

//中锋
class Center extends Player
{
    function __construct()
    {
        parent::__construct();
    }

    public function Attack()
    {
        echo "中锋:".$this->name." 进攻\n";
    }
    public function Defense()
    {
        echo "中锋:".$this->name." 防守\n";
    }
}

//外籍中锋
class ForeignCenter
{
    private $name;
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function 进攻()
    {
        echo "外籍中锋:".$this->name." 进攻\n";
    }

    public function 防守()
    {
        echo "外籍中锋:".$this->name." 防守\n";
    }
}

//翻译者
class Translator extends Player
{
    private $foreignCenter;

    function __construct($name)
    {
        $this->foreignCenter = new ForeignCenter();
        $this->foreignCenter->setName($name);
    }

    public function Attack()
    {
        $this->foreignCenter->进攻();
    }
    public function Defense()
    {
        $this->foreignCenter->防守();
    }

}



// 客户端代码
$forwards = new Forwards("巴蒂尔");
$forwards->Attack();
$forwards->Defense();

$translator = new Translator("姚明");
$translator->Attack();
$translator->Defense();








