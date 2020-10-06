---
title: 第十六章 无尽加班何时休 －－－ 状态模式
type: docs
weight: 17
---

### 第十六章 无尽加班何时休 －－－ 状态模式

```php
//工作状态
abstract class State
{
    abstract public function WriteProgram(Work $w);
}

class ForenoonState extends State
{
    public function WriteProgram(Work $w)
    {
        if ($w->getHour() < 12) {
            echo "当前时间：".$w->getHour()." 上午工作，精神百倍\n";
        } else {
            $w->setState(new NoonState());
            $w->WriteProgram();
        }
    }
}

class NoonState extends State
{
    public function WriteProgram(Work $w)
    {
        if ($w->getHour() < 13) {
            echo "当前时间：".$w->getHour()." 饿了，午饭；犯困，午休\n";
        } else {
            $w->setState(new AfterNoonState());
            $w->WriteProgram();
        }
    }
}

class AfterNoonState extends State
{
    public function WriteProgram(Work $w)
    {
        if ($w->getHour() < 17) {
            echo "当前时间：".$w->getHour()." 下午状态不错，继续努力\n";
        } else {
            $w->setState(new EveningState());
            $w->WriteProgram();
        }
    }
}

class EveningState extends State
{
    public function WriteProgram(Work $w)
    {
        if ($w->getTaskFinishedState()) {
            //如果完成任务，下班
            $w->setState(new RestState());
            $w->WriteProgram();
        } else {
            if ($w->getHour() < 21) {
                echo "当前时间：".$w->getHour()." 加班哦，疲惫之极\n";
            } else {
                //超过21点，则转入睡眠工作状态
                $w->setState(new SleepingState());
                $w->WriteProgram();
            }
        }
    }
}

class SleepingState extends State
{
    public function WriteProgram(Work $w)
    {
        echo "当前时间：".$w->getHour()." 不行了，睡觉\n";
    }
}

class RestState extends State
{
    public function WriteProgram(Work $w)
    {
        echo "当前时间：".$w->getHour()." 下班回家\n";
    }
}

class Work
{
    private $current;

    function __construct()
    {
        $this->current = new ForenoonState();
    }

    private $hour;
    public function getHour()
    {
        return $this->hour;
    }
    public function setHour($hour)
    {
        $this->hour = $hour;
    }

    private $finished = false;
    public function setTaskFinished($bool)
    {
        $this->finished = $bool;
    }
    public function getTaskFinishedState()
    {
        return $this->finished;
    }

    public function setState(State $state)
    {
        $this->current = $state;
    }

    public function WriteProgram()
    {
        $this->current->WriteProgram($this);
    }
}

//客户端代码
$emergencyProjects = new Work();
$emergencyProjects->setHour(9);
$emergencyProjects->WriteProgram();
$emergencyProjects->setHour(10);
$emergencyProjects->WriteProgram();
$emergencyProjects->setHour(12);
$emergencyProjects->WriteProgram();
$emergencyProjects->setHour(13);
$emergencyProjects->WriteProgram();
$emergencyProjects->setHour(14);
$emergencyProjects->WriteProgram();
$emergencyProjects->setHour(17);

$emergencyProjects->setTaskFinished(false);
$emergencyProjects->WriteProgram();

$emergencyProjects->setHour(19);
$emergencyProjects->WriteProgram();
$emergencyProjects->setHour(22);
$emergencyProjects->WriteProgram();

```

总结：

> ***状态模式***，当一个对象的内在状态改变时允许改变其行为，这个对象看起来像是改变了其类。

> 面向对象设计其实就是希望做到代码的责任分解。

> 状态模式主要解决的当控制一个对象状态转换的条件表达式过于复杂时的情况。把状态的判断逻辑转移到表示不同状态的一系列类当中，可以把复杂的判断逻辑简单化。

> 将于特定状态相关的行为局部化，并且将不同状态的行为分割开来。

> 将特定的状态相关的行为都放入一个对象中，由于所有与状态相关的代码都存在于某个ConcreteState中，所以通过定义的子类可以很容易地增加新的状态和转换。

> 消除了庞大的条件分支语句。

> 状态模式通过把各种状态转移逻辑分布到State的子类之间，来减少项目之间的依赖。

> 当一个对象的行为取决于它的状态，并且它必须在运行时刻根据状态改变它的行为时，就可以考虑使用状态模式了。 


上一章：[第十五章 就不能不换DB吗？ －－－ 抽象工厂模式]({{< relref "/docs/chapter15" >}})

下一章：[第十七章 在NBA我需要翻译 －－－ 适配器模式]({{< relref "/docs/chapter17" >}}) 