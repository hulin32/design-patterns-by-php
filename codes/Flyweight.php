<?php
// veersion 1
// abstract class Flyweight
// {
//  abstract public function operation($extringsicState);
// }

// class ConcreteFlyweight extends Flyweight
// {
//  public function operation($extringsicState)
//  {
//      echo "ConcreteFlyweight:".$extringsicState."\n";
//  }
// }

// class UnsharedConcreteFlyweight extends Flyweight
// {
//  public function operation($extringsicState)
//  {
//      echo "Unshared ConcreteFlyweight:".$extringsicState."\n";
//  }
// }

// class FlyweightFactory
// {
//  private $flyweights = [];

//  function __construct()
//  {   
//      $this->flyweights['x'] = new ConcreteFlyweight();
//      $this->flyweights['y'] = new ConcreteFlyweight();
//      $this->flyweights['z'] = new ConcreteFlyweight();
//  }

//  public function getFlyweight($key)
//  {
//      return $this->flyweights[$key];
//  }
// }

// //client 
// $state = 22;
// $f = new FlyweightFactory();
// $fx =  $f->getFlyweight('x');
// $fx->operation(--$state);

// $fx =  $f->getFlyweight('y');
// $fx->operation(--$state);

// $fx =  $f->getFlyweight('z');
// $fx->operation(--$state);

// $uf = new UnsharedConcreteFlyweight();
// $uf->operation(--$state);

// veersion 2
// abstract class WebSite
// {
//     abstract public function use();
// }

// // 具体网站类
// class ConcreteWebSite extends WebSite
// {
//     private $name = '';

//     function __construct($name)
//     {
//         $this->name = $name;
//     }

//     public function use()
//     {
//         echo "网站分类: ".$this->name."\n";
//     }
// }

// //网站工厂
// class WebSiteFactory
// {
//     private $flyweights = [];

//     public function getWebSiteGategory($key)
//     {
//         if (empty($this->flyweights[$key])) {
//             $this->flyweights[$key] = new ConcreteWebSite($key);
//         }
//         return $this->flyweights[$key];
//     }


//     public function getWebSiteCount()
//     {
//         return count($this->flyweights);
//     }
// }


// $f = new WebSiteFactory();
// $fx = $f->getWebSiteGategory('产品展示');
// $fx->use();

// $fy = $f->getWebSiteGategory('产品展示');
// $fy->use();

// $fz = $f->getWebSiteGategory('产品展示');
// $fz->use();

// $fl = $f->getWebSiteGategory('博客');
// $fl->use();

// $fm = $f->getWebSiteGategory('博客');
// $fm->use();

// $fn = $f->getWebSiteGategory('博客');
// $fn->use();

// echo "网站分类总数:".$f->getWebSiteCount();


// veersion 3
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

echo "网站分类总数:".$f->getWebSiteCount();
