---
title: 第十九章 分公司＝一部分  －－－ 组合模式
type: docs
weight: 20
---

### 第十九章 分公司＝一部分  －－－ 组合模式
```php
<?php

// component为组合中的对象接口，在适当的情况下，实现所有类共有接口的默认行为。声明一个接口用于访问和管理Component的字部件。
abstract class Component
{
    protected $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    //通常用add和remove方法来提供增加或移除树枝货树叶的功能
    abstract public function add(Component $c);
    abstract public function remove(Component $c);
    abstract public function display($depth);
}

//leaf在组合中表示叶节点对象，叶节点对象没有子节点。
class Leaf extends Component
{   
    // 由于叶子没有再增加分枝和树叶，所以add和remove方法实现它没有意义，
    // 但这样做可以消除叶节点和枝节点对象在抽象层次的区别，它们具有完全一致的接口
    public function add(Component $c)
    {
        echo "can not add to a leaf\n";
    }

    public function remove(Component $c)
    {
        echo "can not remove to a leaf\n";
    }

    // 叶节点的具体方法，此处是显示其名称和级别
    public function display($depth)
    {
        echo str_repeat('-', $depth).$this->name."\n";
    }
}

//composite定义有枝节点行为，用来存储子部件，在Component接口中实现与子部件有关的操作，比如增加add和删除remove.

class Composite extends Component
{
    //一个子对象集合用来存储其下属的枝节点和叶节点。
    private $childern = [];

    public function add(Component $c)
    {
        array_push($this->childern, $c);
    }

    public function remove(Component $c)
    {
        foreach ($this->childern as $key => $value) {
            if ($c === $value) {
                unset($this->childern[$key]);
            }
        }
    }

    // 显示其枝节点名称，并对其下级进行遍历
    public function display($depth)
    {
        echo str_repeat('-', $depth).$this->name."\n";
        foreach ($this->childern as $component) {
            $component->display($depth + 2);
        }
    }
}

//客户端代码

$root = new Composite('root');
$root->add(new Leaf("Leaf A"));
$root->add(new Leaf("Leaf B"));

$comp = new Composite("Composite X");
$comp->add(new Leaf("Leaf XA"));
$comp->add(new Leaf("Leaf XB"));

$root->add($comp);

$comp2 = new Composite("Composite X");
$comp2->add(new Leaf("Leaf XA"));
$comp2->add(new Leaf("Leaf XB"));

$comp->add($comp2);

$root->add(new  Leaf("Leaf C"));

$leaf = new Leaf("Leaf D");
$root->add($leaf);
$root->remove($leaf);

$root->display(1);
```

总结：

> ***组合模式***，将对象组合成树形结构以表示‘部分与整体’的层次结构。组合模式使得用户对单个对象和组合对象的使用具有一致性。

> 透明方式，子类的所有接口一致，虽然有些接口没有用。

> 安全方式，子类接口不一致，只实现特定的接口，但是这样就要做相应的判断，带来了不便。

> 需求中是体现部分与整体层次的结构时，或希望用户可以忽略组合对象与单个对象的不同，统一地使用组合结构中的所有对象时，就应该考虑用组合模式了。

> 组合模式可以让客户一致地使用组合结构和单个对象。 

上一章：[第十八章 如果再回到从前 －－－ 备忘录模式]({{< relref "/docs/chapter18" >}})

下一章：[第二十章 想走？可以！先买票 －－－ 迭代器模式]({{< relref "/docs/chapter20" >}}) 