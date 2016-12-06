<?php 

// abstract class Handler
// {
//     protected $successor;
    
//        设置继承者
//     public function setSuccessor(Handler $successor)
//     {
//         $this->successor = $successor;
//     }
//        处理请求的抽象方法
//     abstract function handleRequest(int $request);
// }
    
//     如果可以处理请求，就处理之，否者转发给它的后继者
// class ConcreteHandler1 extends Handler
// {
//     public function handleRequest(int $request)
//     {
//         if ($request >=0 && $request < 10)
//         {
//             echo "ConcreteHandler1 handle it\n";
//         } else if ($this->successor != null) {
//              // 转移
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
// 设置职责链上下家
// $h1->setSuccessor($h2);
// $requests = [1,5,7,16,25];
// 循环给最小处理者提交请求，不同的数额，由不同权限处理者处理
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
        if ($request->getRequestType() === 'dayoff' && $request->getNumber() <=2)
        {
            echo $this->name.":".$request->getRequestContent()." times:".$request->getNumber()."\n";
        } else {
            if ($this->superior != null) {
                $this->superior->requestApplications($request);
            }
        }
    }
}

class MajaorManager extends Manager
{
    public function requestApplications(Request $request)
    {
        if ($request->getRequestType() === 'dayoff' && $request->getNumber() <=5)
        {
            echo $this->name.":".$request->getRequestContent()." times:".$request->getNumber()."\n";
        } else {
            if ($this->superior != null) {
                $this->superior->requestApplications($request);
            }
        }
    }
}

class GeneralManager extends Manager
{
    public function requestApplications(Request $request)
    {
        if ($request->getRequestType() === 'dayoff')
        {
            echo $this->name.":".$request->getRequestContent()." times:".$request->getNumber()."\n";
        } else if ($request->getRequestType() === 'salary' && $request->getNumber() <= 500){
            echo $this->name.":".$request->getRequestContent()." money:".$request->getNumber()."\n";
        } else {
            echo "no way!\n";
        }
    }
}

$jinli = new CommonManager('jinli');
$zongjian = new MajaorManager('zongjian');
$zhongjinli = new GeneralManager('zhongjinli');

$jinli->setSuperior($zongjian);
$zongjian->setSuperior($zhongjinli);

$request = new Request();
$request->setRequestType('dayoff');
$request->setRequestContent('xiaocai dayoff');
$request->setNumber(1);
$jinli->requestApplications($request);

$request2 = new Request();
$request2->setRequestType('dayoff');
$request2->setRequestContent('xiaocai dayoff');
$request2->setNumber(4);
$jinli->requestApplications($request2);

$request3 = new Request();
$request3->setRequestType('salary');
$request3->setRequestContent('xiaocai add salary');
$request3->setNumber(500);
$jinli->requestApplications($request3);

$request4 = new Request();
$request4->setRequestType('salary');
$request4->setRequestContent('xiaocai add salary');
$request4->setNumber(10000);
$jinli->requestApplications($request4);












