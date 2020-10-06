---
title: 第二章 商场促销 －－－ 策略模式
type: docs
weight: 3
---

### 第二章 商场促销 －－－ 策略模式

1.策略模式
```php
<?php 

/**
* abstract class
*/
abstract class Strategy
{
    // 算法方法
    abstract public function AlgorithmInterface();    
}

/**
* 算法a
*/
class ConcreteStrategyA extends Strategy
{
    public function AlgorithmInterface()
    {
        echo "算法a实现\n";
    }
}


/**
* 算法b
*/
class ConcreteStrategyB extends Strategy
{
    public function AlgorithmInterface()
    {
        echo "算法b实现\n";
    }
}

/**
* 算法c
*/
class ConcreteStrategyC extends Strategy
{
    public function AlgorithmInterface()
    {
        echo "算法c实现\n";
    }
}

/**
* 上下文context
*/
class Context
{
    private $strategy;

    function __construct($strategy)
    {
        $this->strategy = $strategy;
    }

    public function contextInterface()
    {
        $this->strategy->AlgorithmInterface();
    }
}

$context = new Context(new ConcreteStrategyA());
$context->contextInterface();

$context = new Context(new ConcreteStrategyB());
$context->contextInterface();

$context = new Context(new ConcreteStrategyC());
$context->contextInterface();


```

2.策略模式和简单工厂结合
```php
<?php

// 只需要修改上方的Context类
class Context
{
    private $strategy;

    function __construct($operation)
    {
        switch ($operation) {
            case 'a':
                $this->strategy = new ConcreteStrategyA();
                break;
            case 'b':
               $this->strategy = new ConcreteStrategyB();
                break;
            case 'c':
                $this->strategy = new ConcreteStrategyC();
                break;
        }
    }

    public function contextInterface()
    {
        return $this->strategy->AlgorithmInterface();
    }
}

//客户端代码
$context = new Context('a');
$context->contextInterface();
```

总结：
> 面向对象的编程，并不是类越多越好，类的划分为了封装，但分类的基础是抽象，具有相同属性和功能的对象集合才是类。

> 策略模式是一种定义一系列算法的方法，从概念上来看，所有这些算法完成的都是相同的工作，只是实现不同，它可以以相同的方式调用所有的算法，减少了各种算法类与使用算法类之间的耦合。

> 策略模式的Strategy类层次为Context定义了一系列的可供重用的算法或行为。继承有助于析取出这些算法中公共功能。

> 策略模式简化了单元测试，因为每个算法都有自己的类，可以通自己接口单独测试。

> 当不同的行为堆砌在一个类中时，就很难避免使用条件语句来选择合适的行为。将这些行为封装在一个个Strategy类中，可以在使用这些行为的类中消除条件语句。

> 策略模式就是用来封装算法的，但在实践中，我们发现可以用它来封装几乎任何类型的规则，只要在分析过程中听到需要在不同时间应用不同的业务规则，就可以考虑使用策略模式处理这种变化的可能性。

> 在基本的策略模式中，选择所用具体实现的职责由客户端对象承担，并转给策略模式的Context对象。

上一章：[第一章 代码无错就是优 －－－简单工厂模式]({{< relref "/docs/chapter1" >}})

下一章：[第三章 拍摄UFO －－－ 单一职责原则]({{< relref "/docs/chapter3" >}})
