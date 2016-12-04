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


























