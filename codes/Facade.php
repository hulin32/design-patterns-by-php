<?php 

//子系统1
class SubSystemOne
{
    public function methodOne()
    {
        echo "子系统方法1\n";
    }
}

//子系统2
class SubSystemTwo
{
    public function methodTwo()
    {
        echo "子系统方法2\n";
    }
}

//子系统3
class SubSystemThree
{
    public function methodThree()
    {
        echo "子系统方法3\n";
    }
}

//子系统4
class SubSystemFourth
{
    public function methodFourth()
    {
        echo "子系统方法4\n";
    }
}

// 外观方法
class Facade
{
    private $systemOne;
    private $systemTwo;
    private $systemThree;
    private $systemFour;


    function __construct()
    {
        $this->systemOne = new SubSystemOne();
        $this->systemTwo = new SubSystemTwo();
        $this->systemThree = new SubSystemThree();
        $this->systemFour = new SubSystemFourth();
    }

    public function methodA()
    {
        echo "方法A() ---\n";
        $this->systemOne->methodOne();
        $this->systemThree->methodThree();
    }

        public function methodB()
    {
        echo "方法B() ---\n";
        $this->systemTwo->methodTwo();
        $this->systemFour->methodFourth();
    }
}

//客户端代码

$facade = new Facade();
$facade->methodA();
$facade->methodB();

















