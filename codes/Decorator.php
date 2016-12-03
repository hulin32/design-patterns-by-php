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

























