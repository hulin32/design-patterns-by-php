<?php 

// class Context
// {
//     private $state;

//     function __construct(State $state)
//     {
//         $this->state = $state;
//     }

//     public function setState(State $state)
//     {
//         $this->state = $state;
//     }

//     public function getState(State $state)
//     {
//         return $this->state;
//     }

//     public function request()
//     {
//         $this->state->Handle($this);
//     }
// }


// abstract class State
// {
//     abstract public function Handle(Context $context);
// }

// class ConcreteStateA extends State
// {
//     public function Handle(Context $context)
//     {
//         echo "ConcreteStateA Handler\n";
//         $context->setState(new ConcreteStateB());
//     }
// }

// class ConcreteStateB extends State
// {
//     public function Handle(Context $context)
//     {   
//         echo "ConcreteStateB Handler\n";
//         $context->setState(new ConcreteStateA());
//     }
// }


// //客户端代码
// $context = new Context(new ConcreteStateA());
// $context->request();
// $context->request();
// $context->request();
// $context->request();

//工作状态
abstract class State
{
    abstract public function WriteProgram(Work $w);
}

class ForenoonState extends State
{
    public function WriteProgram(Work $w)
    {
        if ($w->getHour() < 12) {
            echo "当前时间：".$w->getHour()." 上午工作，精神百倍\n";
        } else {
            $w->setState(new NoonState());
            $w->WriteProgram();
        }
    }
}

class NoonState extends State
{
    public function WriteProgram(Work $w)
    {
        if ($w->getHour() < 13) {
            echo "当前时间：".$w->getHour()." 饿了，午饭；犯困，午休\n";
        } else {
            $w->setState(new AfterNoonState());
            $w->WriteProgram();
        }
    }
}

class AfterNoonState extends State
{
    public function WriteProgram(Work $w)
    {
        if ($w->getHour() < 17) {
            echo "当前时间：".$w->getHour()." 下午状态不错，继续努力\n";
        } else {
            $w->setState(new EveningState());
            $w->WriteProgram();
        }
    }
}

class EveningState extends State
{
    public function WriteProgram(Work $w)
    {
        if ($w->getTaskFinishedState()) {
            //如果完成任务，下班
            $w->setState(new RestState());
            $w->WriteProgram();
        } else {
            if ($w->getHour() < 21) {
                echo "当前时间：".$w->getHour()." 加班哦，疲惫之极\n";
            } else {
                //超过21点，则转入睡眠工作状态
                $w->setState(new SleepingState());
                $w->WriteProgram();
            }
        }
    }
}

class SleepingState extends State
{
    public function WriteProgram(Work $w)
    {
        echo "当前时间：".$w->getHour()." 不行了，睡觉\n";
    }
}

class RestState extends State
{
    public function WriteProgram(Work $w)
    {
        echo "当前时间：".$w->getHour()." 下班回家\n";
    }
}

class Work
{
    private $current;

    function __construct()
    {
        $this->current = new ForenoonState();
    }

    private $hour;
    public function getHour()
    {
        return $this->hour;
    }
    public function setHour($hour)
    {
        $this->hour = $hour;
    }

    private $finished = false;
    public function setTaskFinished($bool)
    {
        $this->finished = $bool;
    }
    public function getTaskFinishedState()
    {
        return $this->finished;
    }

    public function setState(State $state)
    {
        $this->current = $state;
    }

    public function WriteProgram()
    {
        $this->current->WriteProgram($this);
    }
}

//客户端代码
$emergencyProjects = new Work();
$emergencyProjects->setHour(9);
$emergencyProjects->WriteProgram();
$emergencyProjects->setHour(10);
$emergencyProjects->WriteProgram();
$emergencyProjects->setHour(12);
$emergencyProjects->WriteProgram();
$emergencyProjects->setHour(13);
$emergencyProjects->WriteProgram();
$emergencyProjects->setHour(14);
$emergencyProjects->WriteProgram();
$emergencyProjects->setHour(17);

$emergencyProjects->setTaskFinished(false);
$emergencyProjects->WriteProgram();

$emergencyProjects->setHour(19);
$emergencyProjects->WriteProgram();
$emergencyProjects->setHour(22);
$emergencyProjects->WriteProgram();













