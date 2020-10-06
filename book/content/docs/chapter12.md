---
title: 第十二章 牛市股票还会亏钱 －－－ 外观模式
type: docs
weight: 13
---

### 第十二章 牛市股票还会亏钱 －－－ 外观模式

```php
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

```

总结：

> ***外观模式***，为子系统中的一组接口提供一个一致的界面，此模式定义了一个高层接口，这个接口使得这一子系统更容易使用。

> 首先，在设计初期阶段，应该要有意识的将不同的两个层分离，层与层之间建立外观Facade；其次，在开发阶段，子系统往往因为不断的重构演化而变得越来越复杂，增加外观Facade可以提供一个简单的接口，减少它们之间的依赖；另外在维护一个遗留的大型系统时，可能这个系统已经非常难以维护和扩展了，为新系统开发一个外观Facade类，来提供设计粗糙或高度复杂的遗留代码的比较清晰简单的接口，让系统与Facade对象交互，Facade与遗留代码交互所有复杂的工作

上一章：[第十一章 无熟人难办事 －－－ 迪米特法则]({{< relref "/docs/chapter11" >}})

下一章：[第十三章 好菜每回味不同 －－－ 建造者模式]({{< relref "/docs/chapter13" >}})