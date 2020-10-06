---
title: 第十五章 就不能不换DB吗？ －－－ 抽象工厂模式
type: docs
weight: 16
---

### 第十五章 就不能不换DB吗？ －－－ 抽象工厂模式

```php
<?php 

/////////version1
//数据库访问
class User
{
    private $id = null;
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId($id)
    {
        return $this->id;
    }

    private $name = null;
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName($name)
    {
        return $this->id;
    }
}

class Department
{
    private $id = null;
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId($id)
    {
        return $this->id;
    }

    private $name = null;
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName($name)
    {
        return $this->id;
    }
}

interface IUser
{
    public function insert(User $user);
    public function getUser($id);
}

class SqlserverUser implements IUser 
{
    public function insert(User $user)
    {
        echo "往SQL Server中的User表添加一条记录\n";
    }

    public function getUser($id)
    {
        echo "根据id得到SQL Server中User表一条记录\n";
    }
}

class AcessUser implements IUser 
{
    public function insert(User $user)
    {
        echo "往Acess Server中的User表添加一条记录\n";
    }

    public function getUser($id)
    {
        echo "根据id得到Acess Server中User表一条记录\n";
    }
}

// interface IFactory
// {
//     public function CreateUser();
//     public function CreateDepartment();
// }

// class SqlserverFactory implements IFactory
// {
//     public function CreateUser()
//     {
//         return new SqlserverUser();
//     }

//     public function CreateDepartment()
//     {
//         return new SqlserverDepartment();
//     }
// }

// class AcessFactory implements IFactory
// {
//     public function CreateUser()
//     {
//         return new AcessUser();
//     }

//     public function CreateDepartment()
//     {
//         return new AcessDepartment();
//     }
// }
//简单工厂替换抽象工厂
class DataBase
{
    const DB = 'Sqlserver';
    // private $db = 'Access';

    public static function CreateUser()
    {   
        $class = static::DB.'User';
        return new $class();
    }

    public static function CreateDepartment()
    {
        $class = static::DB.'Department';
        return new $class();
    }

}


interface IDepartment
{
    public function insert(Department $user);
    public function getDepartment($id);
}

class SqlserverDepartment implements IDepartment 
{
    public function insert(Department $department)
    {
        echo "往SQL Server中的Department表添加一条记录\n";
    }

    public function getDepartment($id)
    {
        echo "根据id得到SQL Server中Department表一条记录\n";
    }
}

class AcessDepartment implements IDepartment 
{
    public function insert(Department $department)
    {
        echo "往Acess Server中的Department表添加一条记录\n";
    }

    public function getDepartment($id)
    {
        echo "根据id得到Acess Server中Department表一条记录\n";
    }
}

//客户端代码
// $user = new User();
// $iu = (new AcessFactory())->CreateUser();
// $iu->insert($user);
// $iu->getUser(1);

// $department = new Department();
// $id = (new AcessFactory())->CreateDepartment();
// $id->insert($department);
// $id->getDepartment(1);
/////////////////////////////////////////////////

//改为简单工厂后的客户端代码
$user = new User();
$iu = DataBase::CreateUser();
$iu->insert($user);
$iu->getUser(1);

$department = new Department();
$id = DataBase::CreateDepartment();
$id->insert($department);
$id->getDepartment(1);
```

> ***抽象工厂模式***，提供一个创建一系列相关或相互依赖对象的接口，而无需指定他们的具体类。

> 菜鸟程序员遇到问题，只会用时间来摆平。

> 工厂方法模式是定义一个用于创建对象的接口，让子类决定实例化哪一个类。

> 抽象工厂模式的好处便是易于交换产品系列，由于具体工厂类，在一个应用中只需要在初始化的时候出现一次，这就使得改变一个应用的具体工厂变得非常容易，它只是需要改变具体工厂即可使用不同的产品配置。它让具体的创建实例过程与客户端分离，客户端是通过它们的抽象接口操作实例，产品的具体类名也被具体工厂的实现分离，不会出现在客户端代码中。

> 编程是门艺术，大批量的改动是非常丑陋的做法。

> 所有在用简单工厂的地方，都可以考虑用反射技术来去除switch或if，解除分支判断代码的耦合。

上一章：[第十四章 老板回来，我不知道 －－－ 观察者模式]({{< relref "/docs/chapter14" >}})

下一章：[第十六章 无尽加班何时休 －－－ 状态模式]({{< relref "/docs/chapter16" >}}) 