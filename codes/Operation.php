<?php 

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


/**
* operation factory
*/
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

$operation = OperationFactory::createOperation('+');
$operation->setA(1);
$operation->setB(2);
echo $operation->getResult()."\n";
