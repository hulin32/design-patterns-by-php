<?php

//发起人类
class Originator
{   
    // 需要保存的属性，可能有多个
    private $state;
    public function setState($state)
    {
        $this->state = $state;
    }
    public function getState()
    {
        return $this->state;
    }

    //创建备忘录，将当前需要保存的信息导入并实例化出一个memento对象。
    public function createMemento()
    {
        return new Memento($this->state);
    }

    //恢复备忘录，将memento导入并将相关数据恢复。
    public function setMemento(Memento $memento)
    {   
        $this->state = $memento->getState();
    }

    //显示数据
    public function show()
    {
        echo "status ".$this->state."\n";
    }
}

//备忘录类

class Memento
{
    private $state;

    //构造方法，将相关数据导入
    function __construct($state)
    {
        $this->state = $state;
    }

    //获取需要保存的数据，可以多个
    public function getState()
    {
        return $this->state;
    }
}

//管理者类
class CareTaker
{
    private $memento;

    public function getMemento()
    {   
        return $this->memento;
    }

    //设置备忘录
    public function setMemento(Memento $memento)
    {   
        $this->memento = $memento;
    }
}

//客户端程序
$o = new Originator(); //Originator初始状态，状态属性on
$o->setState("On");
$o->show();

//保存状态时，由于有了很好的封装，可以隐藏Originator的实现细节
$c = new CareTaker();
$c->setMemento($o->createMemento());

// 改变属性
$o->setState("Off");
$o->show();

// 恢复属性
$o->setMemento($c->getMemento());
$o->show();
