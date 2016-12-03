### Chapter 2 商场促销 －－－ 策略模式

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
* 算法a
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
            case 'a':
               $this->strategy = new ConcreteStrategyB();
                break;
            case 'a':
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



上一章：[Chapter 1 代码无错就是优 －－－简单工厂模式](https://github.com/flyingalex/design-patterns-by-php/blob/master/chapter1.md)

下一章：[Chapter 3 拍摄UFO －－－ 单一职责原则](https://github.com/flyingalex/design-patterns-by-php/blob/master/chapter3.md)
