---
title: 第六章 穿什么有这么重要吗 －－－ 装饰模式
type: docs
weight: 7
---

### 第六章 穿什么有这么重要吗 －－－ 装饰模式

```php
<?php

abstract class Component
{
    abstract public function Operation();
}

/**
* ConcreteComponent
*/
class ConcreteComponent extends Component
{
    public function Operation()
    {
        echo "具体对象的操作.\n";
    }
}

abstract class Decorator extends Component
{
    protected $component;

    // 设置component
    public function SetComponent($component)
    {
        $this->component = $component;
    }

    // 重写Operation(),实际执行的是component的Operation方法
    public function Operation()
    {
        if ($this->component != null)
        {
            $this->component->Operation();
        }
    }
}

/**
* ConcreteDecoratorA
*/
class ConcreteDecoratorA extends Decorator
{
    // 本类的独有功能，以区别于ConcreteDecoratorB
    private $addedState;

    public function Operation()
    {   
        // 首先运行原Component的Operation(),再执行本类的功能，
        // 如addedState,相当于对原Component进行了装饰
        parent::Operation();
        $this->addedState = "ConcreteDecoratorA Status";
        echo $this->addedState."\n";
        echo "具体装饰对象A的操作.\n";
    }
}


/**
* ConcreteDecoratorB
*/
class ConcreteDecoratorB extends Decorator
{
    public function Operation()
    {   
        // 首先运行原Component的Operation(),再执行本类的功能，
        // 如addedBehavior,相当于对原Component进行了装饰
        parent::Operation();
        $this->addedBehavior();
        echo "具体装饰对象B的操作.\n";
    }

    // 本类的独有功能，以区别于ConcreteDecoratorA
    private function addedBehavior()
    {
        echo "ConcreteDecoratorB Status.\n";
    }
}

// 客户端代码
// 装饰的方法是：首先用ConcreteComponent实例化对象c,
// 然后用ConcreteDecoratorA的实例对象$di来包装$c,
// 然后再用ConcreteDecoratorB的实例$d2包装$d1,
// 最终执行$d2的Operation(); 
$c = new ConcreteComponent();
$d1 = new ConcreteDecoratorA();
$d2 = new ConcreteDecoratorB();

$d1->SetComponent($c);
$d2->SetComponent($d1);
$d2->Operation();
```

> 当只有一个ConcreteComponent类而没有抽象的Component类 ，那么Decorator类可以是ConcreteComponent的一个子类。同样的道理，如果只有一个ConcreteDecorator类 ，那么就没有必要建立一个单独的Decorator类，而可以把Decorator类和ConcreteComponent类的责任合并成一个类。

书中用打扮的代码阐释了这样情况下的写法：
```php
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

$sneakers = new Sneakers();
$bigTrouser = new BigTrouser();
$tShirts = new TShirts();

$sneakers->decorate($person);
$bigTrouser->decorate($sneakers);
$tShirts->decorate($bigTrouser);
$tShirts->show();
```


 总结

> ***装饰模式***，动态地给一个对象添加一些额外的职责，就增加功能来说，装饰模式比生成子类更为灵活。

> 装饰模式是为已有功能动态的添加更多功能的一种方式。

> 当系统需要新功能的时候，是向旧的类中添加新的代码。这些新的代码通常装饰了原有类的核心职责或主要行为。

> 在主类中加入新的字段，新的方法和新的逻辑，从而增加了主类的复杂度，而这些新加入的东西仅仅是为满足一些只在某种特定情况下才会执行的特殊行为的需要。装饰模式却提供了一个非常好的解决方案，它把每个要装饰的功能放在单独的类中，并让这个类包装它要装饰的对象，对此，当需要执行特殊行为时，客户代码就可以在运行时根据需要选择地，按顺序地使用装饰功能包装对象了。

> 装饰模式的优点就是把类中的装饰功能从类中搬移去除，这样可以简化原有的类。

> 有效地把类的核心职责和装饰功能区分开了，而且可以去除相关类中的重复的装饰逻辑。



 上一章：[第五章 会修电脑不会修收音机？ －－－ 依赖倒转原则]({{< relref "/docs/chapter5" >}})

下一章：[第七章 为别人做嫁衣 －－－ 代理模式]({{< relref "/docs/chapter7" >}})