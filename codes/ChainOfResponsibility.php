<?php 

// abstract class Handler
// {
//     protected $successor;

//     public function setSuccessor(Handler $successor)
//     {
//         $this->successor = $successor;
//     }

//     abstract function handleRequest(int $request);
// }

// class ConcreteHandler1 extends Handler
// {
//     public function handleRequest(int $request)
//     {
//         if ($request >=0 && $request < 10)
//         {
//             echo "ConcreteHandler1 handle it\n";
//         } else if ($this->successor != null) {
//             $this->successor->handleRequest($request);
//         }
//     }
// }

// class ConcreteHandler2 extends Handler
// {
//     public function handleRequest(int $request)
//     {
//         if ($request >=10 && $request < 20)
//         {
//             echo "ConcreteHandler2 handle it\n";
//         } else if ($this->successor != null) {
//             $this->successor->handleRequest($request);
//         }
//     }
// }

// // client
// $h1 = new ConcreteHandler1();
// $h2 = new ConcreteHandler2();
// $h1->setSuccessor($h2);
// $requests = [1,5,7,16,25];
// foreach ($requests as $value) {
//     $h1->handleRequest($value);
// }

class Request
{
    protected $requestType;
    public function setRequestType($requestType)
    {
        $this->requestType = $requestType;
    }
    public function getRequestType()
    {
        return $this->requestType;
    }

    protected $requestContent;
    public function setRequestContent($requestContent)
    {
        $this->requestContent = $requestContent;
    }
    public function getRequestContent()
    {
        return $this->requestContent;
    }

    protected $number;
    public function setNumber($number)
    {
        $this->number = $number;
    }
    public function getNumber()
    {
        return $this->number;
    }
}



// salary raises
abstract class Manager
{
    protected $name;
    protected $superior;

    function __construct($name)
    {
        $this->name = $name;
    }

    public function setSuperior($superior)
    {
        $this->superior = $superior;
    }

    //apply
    abstract public function requestApplications(Request $request);
}


class CommonManager extends Manager
{
    public function requestApplications(Request $request)
    {
        if ($request->requestType === 'dayoff' && $request->number <=2)
        {
            echo $this->name.":".$request->getRequestContent()." times:".$request->getNumber()."\n";
        } else {
            if ($this->superior != null) {
                $superior->requestApplications($request);
            }
        }
    }
}

class MajaorManager extends Manager
{
    public function requestApplications(Request $request)
    {
        if ($request->requestType === 'dayoff' && $request->number <=5)
        {
            echo $this->name.":".$request->getRequestContent()." times:".$request->getNumber()."\n";
        } else {
            if ($this->superior != null) {
                $superior->requestApplications($request);
            }
        }
    }
}

class GeneralManager extends Manager
{
    public function requestApplications(Request $request)
    {
        if ($request->requestType === 'dayoff')
        {
            echo $this->name.":".$request->getRequestContent()." times:".$request->getNumber()."\n";
        } else if ($request->requestType === 'salary' && $request->number <= 500){
            echo $this->name.":".$request->getRequestContent()." money:".$request->getNumber()."\n";
        } else {
            echo "no way!\n";
        }
    }
}