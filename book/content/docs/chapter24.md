---
title: 第二十四章 加薪非要老总批 －－－ 职责链模式
type: docs
weight: 25
---

### 第二十四章 加薪非要老总批 －－－ 职责链模式
```php
abstract class Handler
{
    protected $successor;
    
    //设置继承者
    public function setSuccessor(Handler $successor)
    {
        $this->successor = $successor;
    }
    
    //处理请求的抽象方法
    abstract function handleRequest(int $request);
}
    
//如果可以处理请求，就处理之，否者转发给它的后继者
class ConcreteHandler1 extends Handler
{
    public function handleRequest(int $request)
    {
        if ($request >=0 && $request < 10)
        {
            echo "ConcreteHandler1 handle it\n";
        } else if ($this->successor != null) {
             // 转移
            $this->successor->handleRequest($request);
        }
    }
}

class ConcreteHandler2 extends Handler
{
    public function handleRequest(int $request)
    {
        if ($request >=10 && $request < 20)
        {
            echo "ConcreteHandler2 handle it\n";
        } else if ($this->successor != null) {
            $this->successor->handleRequest($request);
        }
    }
}

// client
$h1 = new ConcreteHandler1();
$h2 = new ConcreteHandler2();
设置职责链上下家
$h1->setSuccessor($h2);
$requests = [1,5,7,16,25];
循环给最小处理者提交请求，不同的数额，由不同权限处理者处理
foreach ($requests as $value) {
    $h1->handleRequest($value);
}
```

总结
> ***职责链模式***， 使多个对象都有机会处理请求，从而避免请求的发送者和接受者之间的耦合关系。将这个对象连成一条链，并沿着这条链传递该请求，直到有一个对像处理它为止。

> 当用户提交一个请求时，请求是沿着链传递直至有一个对象负责处理它。

> 接受者和发送者都没有对方的明确信息，且链中的对象自己也并不知道链的结构。结果是职责链可简化对象的相互连接，它们仅需要保持一个向其后继者的引用，而不需要保持它所有的候选者的引用。

> 随时地增加或修改处理一个请求的结构。增强了给对象指派职责的灵活性。

> 一个请求极有可能到了链的末端都得不到处理，或者因为没有正确配置而得不到处理。

上一章：[第二十三章 烤羊肉串引来的思考 －－－ 命令模式]({{< relref "/docs/chapter23" >}})

下一章：[第二十五章 世界需要和平 －－－ 中介者模式]({{< relref "/docs/chapter25" >}})