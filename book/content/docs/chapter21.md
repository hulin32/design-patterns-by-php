---
title: 第二十一章 有些类也需要计划生育 －－－ 单例模式
type: docs
weight: 22
---

### 第二十一章 有些类也需要计划生育 －－－ 单例模式

```php
<?php 

class Singleton
{
    private static $instance;

    private function __construct(){}

    public static function getInstance()
    {
        if (static::$instance == null) 
        {
            static::$instance = new Singleton();
        }
        return static::$instance;
    }
}


//客户端代码
$s1 = Singleton::getInstance();
$s2 = Singleton::getInstance();

if ($s1 == $s2) 
{
    echo "same class";
}

```

总结：

> ***单例模式***，保证一个类仅有一个实例，并提供一个访问它的全局访问点。

> 单例模式因为Singleton类封装它的唯一实例，这样它可以严格地控制客户怎样访问以及何时访问它。简单地说就是对唯一实例的受控访问。


上一章：[第二十章 想走？可以！先买票 －－－ 迭代器模式]({{< relref "/docs/chapter20" >}})

下一章：[第二十二章 手机软件何时统一 －－－ 桥接模式]({{< relref "/docs/chapter22" >}}) 
