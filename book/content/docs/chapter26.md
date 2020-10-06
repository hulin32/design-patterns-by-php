---
title: 第二十六章 项目多也别傻做 －－－ 享元模式
type: docs
weight: 27
---

### 第二十六章 项目多也别傻做 －－－ 享元模式

```php
class User
{
    private $name;
    function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}

abstract class WebSite
{
    abstract public function use(User $user);
}

// 具体网站类
class ConcreteWebSite extends WebSite
{
    private $name = '';

    function __construct($name)
    {
        $this->name = $name;
    }

    public function use(User $user)
    {
        echo "网站分类: ".$this->name."用户:".$user->getName()."\n";
    }
}

//网站工厂
class WebSiteFactory
{
    private $flyweights = [];

    public function getWebSiteGategory($key)
    {
        if (empty($this->flyweights[$key])) {
            $this->flyweights[$key] = new ConcreteWebSite($key);
        }
        return $this->flyweights[$key];
    }


    public function getWebSiteCount()
    {
        return count($this->flyweights);
    }
}

$f = new WebSiteFactory();
$fx = $f->getWebSiteGategory('产品展示');
$fx->use(new User('张伟'));

$fy = $f->getWebSiteGategory('产品展示');
$fy->use(new User('王伟'));

$fz = $f->getWebSiteGategory('产品展示');
$fz->use(new User('王芳'));

$fl = $f->getWebSiteGategory('博客');
$fl->use(new User('李伟'));

$fm = $f->getWebSiteGategory('博客');
$fm->use(new User('王秀英'));

$fn = $f->getWebSiteGategory('博客');
$fn->use(new User('李秀英'));

echo "网站分类总数:".$f->getWebSiteCount()."\n";
```

总结

> ***享原模式*** 运用共享技术有效地支持大量细粒度的对象

> 享原模式可以避免大量非常类似类的开销。在程序设计中，有时需要生成大量细粒度的类实例来表示数据。如果能发现这些实例除了几个参数外基本上都是相同的，有时就能够受大幅度地减少需要实例化的类的数量。如果能把参数移到类实例的外面，在方法调用时将它们传递进来，就可以通过共享大幅度地减少单个实例的数目。

> 如果一个应用程序使用了大量的对象，而大量的这些对象造成了很大的存储开销时就应该考虑使用；还有就是对象的大多数状态可以外部状态，如果删除对象的外部状态，那么可以用相对较少的共享对象取代很多组对象，此时可以考虑使用享原模式。 

上一章：[第二十五章 世界需要和平 －－－ 中介者模式]({{< relref "/docs/chapter25" >}})

下一章：[第二十七章 其实你不懂老板的心 －－－ 解释器模式]({{< relref "/docs/chapter27" >}})