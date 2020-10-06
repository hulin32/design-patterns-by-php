---
title: 第十七章 在NBA我需要翻译 －－－ 适配器模式
type: docs
weight: 18
---

### 第十七章 在NBA我需要翻译 －－－ 适配器模式

```php
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
```

总结：

> ***适配器模式***，将一个类的接口转化成客户希望的另外一个接口。适配器模式使得原本由于接口不兼容而不能一起工作的那些类可以一起工作。

> 系统的数据和行为都正确，但接口不符时，我们应该考虑用适配器，目的是使控制范围之外的一个原有对象与某个接口匹配。适配器模式主要应用于希望复用一些现存的类。但是接口又与复用环境要求不一致的情况。

> 两个类所做的事情相同或相似，但是具有不同的接口时要使用它。

> 在双方都不太容易修改的时候再使用适配器模式适配。

上一章：[第十六章 无尽加班何时休 －－－ 状态模式]({{< relref "/docs/chapter16" >}})

下一章：[第十八章 如果再回到从前 －－－ 备忘录模式]({{< relref "/docs/chapter18" >}}) 