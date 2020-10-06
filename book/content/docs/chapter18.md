---
title: 第十八章 如果再回到从前 －－－ 备忘录模式
type: docs
weight: 19
---

### 第十八章 如果再回到从前 －－－ 备忘录模式

```php
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
```

总结：

> ***备忘录模式***，在不破坏封装性的前提下，捕获一个对象的内部状态，并在该对象之前保存这个状态。这样以后就可将该对象恢复到原先保存的状态。

> 代码无措未必优

> 如果在某个系统中使用命令模式时，需要实现命令的撤销功能，那么命令模式可以使用备忘录模式来存储可撤销操作的状态。

> 使用备忘录可以把复杂的对象内部信息对其他的对象屏蔽起来。


上一章：[第十七章 在NBA我需要翻译 －－－ 适配器模式]({{< relref "/docs/chapter17" >}})

下一章：[第十九章 分公司 ＝ 一部分  －－－ 组合模式]({{< relref "/docs/chapter19" >}}) 