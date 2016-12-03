<?php 

class Company
{
    private $company;

    public function setName($name)
    {
        $this->company = $name;
    }

    public function getName()
    {
        return $this->company;
    }
}

class Resume
{
    private $name;
    private $sex;
    private $age;
    private $timeArea;
    private $company;

    function __construct($name)
    {
        $this->name = $name;
        $this->company = new Company();
    }

    public function setPersonalInfo($sex, $age)
    {
        $this->sex = $sex;
        $this->age = $age;
    }

    public function setWorkExperience($timeArea, $company)
    {
        $this->timeArea = $timeArea;
        $this->company->setName($company);
    }

    public function display()
    {
        echo $this->name." ".$this->sex." ".$this->age."\n";
        echo $this->timeArea." ".$this->company->getName()."\n";
    }

    // 对引用执行深复制
    function __clone()
    {
        $this->company = clone $this->company;
    }
}

// 客户端代码
$resume = new Resume("大鸟");
$resume->setPersonalInfo("男", 29);
$resume->setWorkExperience("1998-2000","xxx 公司");

$resume2 = clone $resume;
$resume2->setPersonalInfo("男", 40);
$resume2->setWorkExperience("1998-2010","xx 公司");

$resume->display();
$resume2->display();







