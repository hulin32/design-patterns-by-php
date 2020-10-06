---
title: 第二十五章 世界需要和平 －－－ 中介者模式
type: docs
weight: 26
---

### 第二十五章 世界需要和平 －－－ 中介者模式

```php
<?php

abstract class Mediator
{
    abstract public function send($message, Colleague $colleague);
}

abstract class Colleague
{
    protected $mediator;

    function __construct(Mediator $mediator)
    {
        $this->mediator = $mediator;
    }
}

class ConcreteMediator extends Mediator
{
    private $colleague1;
    private $colleague2;

    public function setColleague1(Colleague $colleague)
    {
        $this->colleague1 = $colleague;
    }

    public function setColleague2(Colleague $colleague)
    {
        $this->colleague2 = $colleague;
    }

    public function send($message, Colleague $colleague)
    {
        if($this->colleague1 == $colleague)
        {
            $this->colleague2->notify($message);
        } else {
            $this->colleague1->notify($message);
        }
    }
}

class ConcreteColleague1 extends Colleague
{
    public function send($message)
    {
        $this->mediator->send($message, $this);
    }

    public function notify($message)
    {
        echo "ConcreteColleague1 ".$message."\n";
    }
}

class ConcreteColleague2 extends Colleague
{
    public function send($message)
    {
        $this->mediator->send($message, $this);
    }

    public function notify($message)
    {
        echo "ConcreteColleague2 ".$message."\n";;
    }
}

//client

$mediator = new ConcreteMediator();
$c1 = new ConcreteColleague1($mediator);
$c2 = new ConcreteColleague2($mediator);

$mediator->setColleague1($c1);
$mediator->setColleague2($c2);

$c1->send('do you eat?');
$c2->send('no, do you want to invite me to dinner?');
```

总结

> ***中介者模式***，用一个中介对象来封装一系列的对象交互。中介者使各对象不需要显示地相互交互，从而使其耦合松散，而且可以独立地改变它们之间的交互。

> 尽管将一个系统分割成许多对象通常可以增加其可复用性，但是对象间的交互连接的激增又会降低其可复用性了。

> 大量的连接使得一个对象不大可能在没有其他对象的支持下工作，系统表现为一个不可分割的整体，所以，对系统的行为进行任何较大的改动就十分困难了。

> 中介者模式很容易在系统中应用，也很容易在系统中误用。当系统出现了‘多对多’交互复杂的对象群时，不要急于使用中介者模式，而要反思你的系统设计上是不是合理。

> 由于把对象如何协作进行了抽象，将中介作为一个独立的概念并将其封装在一个对象中，这样关注的对象就从对象各自本身的行为转移到它们之间的交互上来，也就是站在一个更宏观的角度去看待系统。

> 中介者模式一般应用于一组对象以定义良好但是复杂的方式进行通信的结合，以及想定制一个分布在多个类中的行为，而又不想生成太多的子类的场合。

上一章：[第二十四章 加薪非要老总批 －－－ 职责链模式]({{< relref "/docs/chapter24" >}})

下一章：[第二十六章 项目多也别傻做 －－－ 享元模式]({{< relref "/docs/chapter26" >}})