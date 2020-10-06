---
title: 第二十章 想走？可以！先买票 －－－ 迭代器模式
type: docs
weight: 21
---

### 第二十章 想走？可以！先买票 －－－ 迭代器模式

```php
<?php 

//迭代器抽象类
abstract class IteratorClass
{
    abstract public function first();
    abstract public function next();
    abstract public function isDone();
    abstract public function currentItem();
}

// 聚集抽象类
abstract class Aggregate
{
    abstract function createIterator();
}

class ConcreteIterator extends IteratorClass
{
    private $aggregate;
    private $current = 0;
    function __construct($aggregate)
    {
        $this->aggregate = $aggregate;
    }

    public function first()
    {
        return $this->aggregate[0];
    }

    public function next()
    {
        $ret = null;
        $this->current++;
        if ($this->current < count($this->aggregate))
        {
            $ret = $this->aggregate[$this->current];
        }
        return $ret;
    }
    
    public function isDone()
    {
        return $this->current >= count($this->aggregate);
    }

    public function currentItem()
    {
        return $this->aggregate[$this->current];
    }
}

//这个类的代码感觉不符合书上的写法，但我感觉书上的不对，可能我知识面太单薄，没读懂，可自行参阅原著😊。
class ConcreteAggregate extends Aggregate
{
    private $items = [];

    public function createIterator()
    {
        return new ConcreteIterator($this);
    }

    public function count()
    {
        return count($this->items);
    }

    public function add($item)
    {
        array_push($this->items, $item);
    }

    public function items()
    {
        return $this->items;
    }
}

//客户端代码
$a = new ConcreteAggregate();
$a->add("大鸟");
$a->add("小菜");
$a->add("行李");
$a->add("老外");
$a->add("公交内部员工");
$a->add("小偷");

$i = new ConcreteIterator($a->items());

while (!$i->isDone()) 
{
    echo $i->currentItem()." 请买票\n";
    $i->next();
}
```

总结：

> 当你需要对聚集有多种方式遍历时，可以考虑用迭代器模式。

> 当你需要访问一个聚集对象，而且不管这些对象是什么都需要遍历的时候，你就应该考虑用迭代器模式。

> 为遍历不同的聚集结构提供如开始、下一个、是否结束、当前哪一项等统一的接口。

> 迭代器模式就是分离了集合对象的遍历行为，抽象出一个迭代器类来负责，这样既可以做到不暴露集合内部的结构，又可让外部代码透明地访问集合内部的数据。


上一章：[第十九章 分公司 ＝ 一部分  －－－ 组合模式]({{< relref "/docs/chapter19" >}})

下一章：[第二十一章 有些类也需要计划生育 －－－ 单例模式]({{< relref "/docs/chapter21" >}}) 