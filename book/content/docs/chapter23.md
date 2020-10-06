---
title: 第二十三章 烤羊肉串引来的思考 －－－ 命令模式
type: docs
weight: 24
---

### 第二十三章 烤羊肉串引来的思考 －－－ 命令模式

```php
<?php 

//烤串

class Barbecuer
{
    public function bakeMutton()
    {
        echo "烤羊肉串\n";
    }

    public function bakeChickenWing()
    {
        echo "烤鸡翅\n";
    }
}

// 抽象命令
abstract  class  Command
{
    protected $receiver;

    function __construct(Barbecuer $receiver)
    {
        $this->receiver = $receiver;
    }

    abstract public function excuteCommand();
}

//烤羊肉
class BakeMuttonCommand extends Command
{
    public function excuteCommand()
    {
        $this->receiver->bakeMutton();
    }
}

//烤鸡翅
class BakeChickenWingCommand extends Command
{
    public function excuteCommand()
    {
        $this->receiver->bakeChickenWing();
    }
}

//服务员
class Waiter
{
    private $commands = [];

    //设置订单
    public function setOrder(Command $command)
    {
        if ($command instanceof BakeChickenWingCommand)
        {
            echo "服务员： 鸡翅没有了，请点别的烧烤\n";
        } else {
            echo "增加订单\n";
            array_push($this->commands, $command);
        }
    }

    //取消订单
    public function cancelOrder(Command $command){}

    //通知执行
    public function notify()
    {
        foreach ($this->commands as $value) {
            $value->excuteCommand();
        }
    }
}

//客户端代码

//开店前准备
$boy = new Barbecuer();
$bakeMuttonCommand1 = new BakeMuttonCommand($boy);
$bakeMuttonCommand2 = new BakeMuttonCommand($boy);
$bakeChickenWingCommand1 = new BakeChickenWingCommand($boy);
$girl = new Waiter();

//开门营业
$girl->setOrder($bakeMuttonCommand1);
$girl->setOrder($bakeMuttonCommand2);
$girl->setOrder($bakeChickenWingCommand1);
$girl->notify();
```

总结：

> ***命令模式***，将 一个请求封装为一个对象，从而使你可用不同的请求对客户进行参数化；对请求排队或记录请求日志，以及支持可撤销的操作。

> 对请求派对或记录请求日志，以及日志可撤销的操作。

> 优点：第一，能较容易地设计一个命令队列；第二，在需要的情况下，可以较容易地将命令记入日志；第三，允许请求的一方决定是否要否决请求；第四，可以容易地实现对请求的撤销和重做；第五，由于加进新的具体命令类不影响其他的类，因此增加新的具体命令类很容易；最重要的是该 模式把请求一个操作的对象与知道怎么执行一个操作的对象分隔开。

>  敏捷开发原则告诉我们，不要为代码添加基于猜测的、实际不需要的功能。如果不清楚一个系统是否需要命令模式，一般酒不要急着去实现它，事实上，在需要的时候通过重构实现这个模式并不难，只有在真正需要如撤销/恢复操作等功能时，把原来的代码重构为命令模式才有意义。

上一章：[第二十二章 手机软件何时统一 －－－ 桥接模式]({{< relref "/docs/chapter22" >}})

下一章：[第二十四章 加薪非要老总批 －－－ 职责链模式]({{< relref "/docs/chapter24" >}}) 