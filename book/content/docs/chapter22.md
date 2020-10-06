---
title: 第二十二章 手机软件何时统 －－－ 桥接模式
type: docs
weight: 23
---

### 第二十二章 手机软件何时统 －－－ 桥接模式

```php
<?php 

//手机软件
abstract class HandsetSoft
{
    abstract public function run();
}

//游戏、通讯录等具体类

//手机游戏
class HandsetGame extends HandsetSoft
{
    public function run()
    {
        echo "运行手机游戏\n";
    }
}
//手机通讯录
class HandsetAddressList extends HandsetSoft
{
    public function run()
    {
        echo "运行手机通讯录\n";
    }
}

//手机品牌类
abstract class HandsetBrand
{
    protected $soft;

    //设置手机软件
    public function setHandsetSoft(HandsetSoft $soft)
    {
        $this->soft = $soft;
    }

    //运行
    abstract public function run();
}

// 手机品牌n
class HandsetBrandN extends HandsetBrand
{
    public function run()
    {
        $this->soft->run();
    }
}

// 手机品牌m
class HandsetBrandM extends HandsetBrand
{
    public function run()
    {
        $this->soft->run();
    }
}

//客户端调用代码
$ab = new HandsetBrandN();
$ab->setHandsetSoft(new HandsetGame());
$ab->run();

$ab->setHandsetSoft(new HandsetAddressList());
$ab->run();

$ab = new HandsetBrandM();
$ab->setHandsetSoft(new HandsetGame());
$ab->run();

$ab->setHandsetSoft(new HandsetAddressList());
$ab->run();
```

总结：

> 桥接模式，将抽象部分与它的实现部分分离，使它们都可以独立地变化。

> 合成/聚合复用原则，尽量使用合成/聚合，尽量不要使用类继承。

> 聚合表示弱的‘拥有’关系，体现的是A对象可以包含B对象，但B对象不是A对象的一部分；合成则是一种强的‘拥有’关系，体现了严格的部分和整体的关系，部分和整体的生命周期一样。

> 对象的继承关系是在编译时就定义好了，所以无法在运行时改变从父类继承的实现。子类的实现与它的父类有非常紧密的依赖关系，以至于父类实现中的任何变化必然会导致子类发生变化。当你需要复用子类时，如果继承下来的实现不适合解决新的问题，则父类必须重写或被其他更合适的类替换。这种依赖关系限制了灵活性并最终限制了复用性。

> 优先使用对象的合成/聚合将有助于你保持每个类被封装，并被集中在单个任务上。这样类和类继承层次会保持较小规模，并且不太可能增长为不可控制的庞然大物。

> 什么叫抽象与它的实现分离，这并不是说，让抽象类与其派生类分离，因为这没有任何意义。实现指的是抽象类和它的派生类用来实现自己的对象。

> 实现系统可能有多角度分类，每一种分类都有可能变化，那么就把这种多角度分离出来让它们独立变化，减少它们之间的耦合。

> 只要真正深入地理解了设计原则，很多设计模式其实就是原则的应用而已，或许在不知不觉中就在使用设计模式了。

上一章：[第二十一章 有些类也需要计划生育 －－－ 单例模式]({{< relref "/docs/chapter21" >}})

下一章：[第二十三章 烤羊肉串引来的思考 －－－ 命令模式]({{< relref "/docs/chapter23" >}}) 