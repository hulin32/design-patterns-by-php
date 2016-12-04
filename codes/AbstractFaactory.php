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

