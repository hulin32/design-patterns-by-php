<?php 

////////////////////////////////
// from Operation.php

class Operation
{
    protected  $a = 0;
    protected  $b = 0;

    public function setA($a)
    {
        $this->a = $a;
    }

    public function setB($b)
    {
        $this->b = $b;
    }

    public function getResult()
    {
        $result = 0;
        return $result;
    }
}

/**
*  add 
*/
class OperationAdd extends Operation
{
    public function getResult()
    {   
        return $this->a + $this->b;
    }
}

/**
* Mul
*/
class OperationMul extends Operation
{
    public function getResult()
    {
        return $this->a * $this->b;
    } 
}

/**
* sub
*/
class OperationSub extends Operation
{
    public function getResult()
    {
        return $this->a - $this->b;
    }
}

/**
* div
*/
class OperationDiv extends Operation
{
    public function getResult()
    {
        $this->a / $this->b;
    }
}

//////////////////////////////////////

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