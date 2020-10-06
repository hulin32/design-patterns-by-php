---
title: 第七章 为别人做嫁衣 －－－ 代理模式
type: docs
weight: 8
---

### 第七章 为别人做嫁衣 －－－ 代理模式

```php
<?php 

class SchoolGirl
{
    private $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}

// 代理接口
interface GiveGift
{
    public function GiveDolls();
    public function GiveFlowers();
    public function GiveChocolate();
}

// 代理实现送礼物接口
class Proxy implements GiveGift
{
    protected $pursuit;

    function __construct(SchoolGirl $girl)
    {
        $this->pursuit = new Pursuit($girl);
    }

    public function GiveDolls()
    {
        $this->pursuit->GiveDolls();
    }

    public function GiveFlowers()
    {
        $this->pursuit->GiveFlowers();
    }

    public function GiveChocolate()
    {
        $this->pursuit->GiveChocolate();
    }
}

// 追求者类实现送礼物接口
class Pursuit implements GiveGift
{
    protected $girl;
    function __construct(SchoolGirl $girl)
    {
        $this->girl = $girl;
    }

    public function GiveDolls()
    {
        echo $this->girl->getName()." 送你娃娃\n";
    }

    public function GiveFlowers()
    {
        echo $this->girl->getName()." 送你花\n";
    }
    
    public function GiveChocolate()
    {
        echo $this->girl->getName()." 送你巧克力\n";
    }
}

// 客户端代码
$girl = new SchoolGirl('李梅');
$proxy = new Proxy($girl);
$proxy->GiveDolls();
$proxy->GiveChocolate();
$proxy->GiveFlowers();

```

总结：
> ***代理模式***，为其他对象提供一种代理以控制对这个对象的访问

上一章：[第六章 穿什么有这么重要吗 －－－ 装饰模式]({{< relref "/docs/chapter6" >}})

下一章：[第八章 雷锋依然在人间 －－－ 工厂方法模式]({{< relref "/docs/chapter8" >}})