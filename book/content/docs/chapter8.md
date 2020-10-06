---
title: 第八章 雷锋依然在人间 －－－ 工厂方法模式
type: docs
weight: 9
---

### 第八章 雷锋依然在人间 －－－ 工厂方法模式

根据[第一章](https://github.com/flyingalex/design-patterns-by-php/blob/master/files/chapter1.md)，简单工厂模式（加减乘除）是这样的：
```php
class OperationFactory
{
    public static function createOperation($operation)
    {
        switch ($operation) {
            case '+':
                $oper = new OperationAdd();
                break;
            case '-':
                $oper = new OperationSub();
                break;
            case '/':
                $oper = new OperationDiv();
                break;
            case '*':
                $oper = new OperationMul();
                break;
        }
        return $oper;
    }
}
// 客户端代码
$operation = OperationFactory::createOperation('+');
$operation->setA(1);
$operation->setA(2);
echo $operation->getResult()."\n";
```
换成工厂方法模式
```php
interface IFactory
{
    public function CreateOperation();
}

class AddFactory implements IFactory
{
    public function CreateOperation()
    {
        return new OperationAdd();
    }
}

class SubFactory implements IFactory
{
    public function CreateOperation()
    {
        return new OperationSub();
    }
}

class MulFactory implements IFactory
{
    public function CreateOperation()
    {
        return new OperationMul();
    }
}

class DivFactory implements IFactory
{
    public function CreateOperation()
    {
        return new OperationDiv();
    }
}

//客户端代码
$operationFactory = new AddFactory();
$operation = $operationFactory->CreateOperation();
$operation->setA(10);
$operation->setB(10);
echo $operation->getResult()."\n";
```


总结：

> ***工厂方法模式***，定义一个创建对象的接口，让子类确定实例化哪一个类。工厂方法使一个类的实例化延迟到7其子类。

> 简单工厂模式的最大优点在于工厂类中包含了必要的逻辑判断，根据用户端的选择条件动态实例化相关的类，对于客户端来说，去除了与具体产品的依赖。

> 工厂方法模式实现时，客户端需要决定实例化哪一个工厂来实现运算类，选择判断的问题还是存在的，也就是说，工厂方法把简单工厂的内部逻辑判断移到了客户端代码来进行。你 想要加功能，本来是改工厂类的，而现在是修改客户端。

上一章：[第七章 为别人做嫁衣 －－－ 代理模式]({{< relref "/docs/chapter7" >}})

下一章：[第九章 简历复印 －－－ 原型模式]({{< relref "/docs/chapter9" >}})