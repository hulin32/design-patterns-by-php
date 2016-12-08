<?php 

abstract class Action
{
    abstract public function getManConclusion(Man $concreteElementA);
    abstract public function getWomanConclusion(Woman $concreteElementB);
}


abstract class Person
{
    abstract public function accept(Action $visitor);
}

class Success extends Action
{
    public function getManConclusion(Man $concreteElementA)
    {
        echo "背后多半有一个伟大的女人\n";
    }

    public function getWomanConclusion(Woman $concreteElementB)
    {
        echo "背后多有一个不成功的男人\n";
    }
}

class Failing extends Action
{
    public function getManConclusion(Man $concreteElementA)
    {
        echo "男人失败时，闷头喝酒，谁也不用劝\n";
    }

    public function getWomanConclusion(Woman $concreteElementB)
    {
        echo "女人失败时，眼泪汪汪，谁也劝不了\n";
    }
}

class Amativeness extends Action
{
    public function getManConclusion(Man $concreteElementA)
    {
        echo "男人恋爱时，凡事不懂也要装懂\n";
    }

    public function getWomanConclusion(Woman $concreteElementB)
    {
        echo "女人恋爱时，遇事懂也装作不懂\n";
    }
}

class Man extends Person
{
    public function accept(Action $visitor)
    {
        $visitor->getManConclusion($this);
    }
}

class Woman extends Person
{
    public function accept(Action $visitor)
    {
        $visitor->getWomanConclusion($this);
    }
}

class ObjectStructure
{
    private $person = [];

    public function acctch(Person $person)
    {
        array_push($this->person, $person);
    }

    public function display(Action $visitor)
    {
        foreach ($this->person as $person) {
            $person->accept($visitor);
        }
    }
}


$o = new ObjectStructure();
$o->acctch(new Man());
$o->acctch(new Woman());

// 成功时的反应
$v1 = new Success();
$o->display($v1);


$v2 = new Failing();
$o->display($v2);


$v3 = new Amativeness();
$o->display($v3);


























