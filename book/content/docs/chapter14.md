---
title: 第十四章 老板回来，我不知道 －－－ 观察者模式
type: docs
weight: 15
---

### 第十四章 老板回来，我不知道 －－－ 观察者模式

```php
<?php 

abstract class Subject
{
    private $observers = [];

    public function attach(Observer $observer)
    {
        array_push($this->observers, $observer);
    }

    public function detatch($observer)
    {
        foreach ($this->observers as $key => $value) {
            if ($observer === $value) {
                unset($this->observers[$key]);
            }
        }
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }
}

abstract class Observer
{
    abstract function update();
}

class ConcreteSubject extends Subject
{
    private $subjectState;
    public function setState($state)
    {
        $this->subjectState = $state;
    }

    public function getState()
    {
        return $this->subjectState;
    }
}

class ConcreteObserver extends Observer
{
    private $name;
    private $subject;

    function __construct(ConcreteSubject $subject, $name)
    {
        $this->subject = $subject;
        $this->name = $name;
    }

    public function update()
    {
        echo "观察者 ".$this->name."的新状态是:".$this->subject->getState()."\n";
    }
}

$s = new ConcreteSubject();
$s->attach(new ConcreteObserver($s, "x"));
$s->attach(new ConcreteObserver($s, "y"));
$z = new ConcreteObserver($s, "z");
$s->attach($z);
$s->detatch($z);
$s->setState('ABC');
$s->notify();
```

总结：
> ***观察者模式***，定义了一种一对多的依赖关系，让多个观察者对象同时监听某一个主题对象。这个主题对象在状态发生变化时，会通知所有观察者对象，使它们能够自动更新自己。

> 将一个系统分割成一系列相互协作的类有一个很不好的副作用，那就是要维护相关对象间的一致性。我们不希望为了维持一致性而使各类紧密耦合，这样会给维护、扩展和重用都带来不便。

> 观察者模式所做的工作其实就是在接触耦合。让耦合的双方都依赖于抽象，而不是依赖于具体。从而使得各自的变化都不会影响另一边的变化。

上一章：[第十三章 好菜每回味不同 －－－ 建造者模式]({{< relref "/docs/chapter13" >}})

下一章：[第十五章 就不能不换DB吗？ －－－ 抽象工厂模式]({{< relref "/docs/chapter15" >}}) 