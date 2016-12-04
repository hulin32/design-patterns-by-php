<?php 

// 公司管理系统
//公司抽象类
abstract class Company
{
    protected $name;
    function __construct($name)
    {
        $this->name = $name;
    }

    abstract public function add(Company $c);
    abstract public function remove(Company $c);
    abstract public function display($depth);
    abstract public function lineOfDuty();//职责，不同部门需要履行不同的职责
}

//具体公司类，实现接口 树枝节点
class ConcreteCompany extends Company
{
    private $childern = [];
    public function add(Company $c)
    {
        array_push($this->childern, $c);
    }

    public function remove(Company $c)
    {
        foreach ($this->childern as $key => $value) {
            if ($c === $value) {
                unset($this->childern[$key]);
            }
        }
    }

    // 显示其枝节点名称，并对其下级进行遍历
    public function display($depth)
    {
        echo str_repeat('-', $depth).$this->name."\n";
        foreach ($this->childern as $component) {
            $component->display($depth + 2);
        }
    }

    public function lineOfDuty()
    {
        foreach ($this->childern as $company) {
            $company->lineOfDuty();
        }
    }
}


//人力资源部
class HRDepartment extends Company
{
    public function add(Company $c){}

    public function remove(Company $c){}

    // 显示其枝节点名称，并对其下级进行遍历
    public function display($depth)
    {
        echo str_repeat('-', $depth).$this->name."\n";
    }
    public function lineOfDuty()
    {
        echo $this->name."-----员工招聘培训\n";
    }
}

//财务部
class FinanceDepartment extends Company
{
    public function add(Company $c){}

    public function remove(Company $c){}

    // 显示其枝节点名称，并对其下级进行遍历
    public function display($depth)
    {
        echo str_repeat('-', $depth).$this->name."\n";
    }
    public function lineOfDuty()
    {
        echo $this->name."-----公司财务收支管理\n";
    }
}

$root = new ConcreteCompany("北京总公司");
$root->add(new HRDepartment("北京人力资源部"));
$root->add(new FinanceDepartment("北京财务部"));


$comp = new ConcreteCompany("上海分公司");
$comp->add(new HRDepartment("上海人力资源部"));
$comp->add(new FinanceDepartment("上海财务部"));
$root->add($comp);

$comp1 = new ConcreteCompany("南京分公司");
$comp1->add(new HRDepartment("南京人力资源部"));
$comp1->add(new FinanceDepartment("南京财务部"));
$comp->add($comp1);

$comp2 = new ConcreteCompany("杭州分公司");
$comp2->add(new HRDepartment("杭州人力资源部"));
$comp2->add(new FinanceDepartment("杭州财务部"));
$comp->add($comp2);

echo "结构图:\n";
$root->display(1);

echo "\n职责:\n";
$root->lineOfDuty();













