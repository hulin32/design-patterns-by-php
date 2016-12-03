<?php 

abstract class Subject
{
    private $observers = [];

    public function attach(Observer $observer)
    {
        array_push($this->observers, $observer);
    }

    public function detatch($observer)
    {
        foreach ($this->observers as $key => $value) {
            if ($observer === $value) {
                unset($this->observers[$key]);
            }
        }
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }
}

abstract class Observer
{
    abstract function update();
}

class ConcreteSubject extends Subject
{
    private $subjectState;
    public function setState($state)
    {
        $this->subjectState = $state;
    }

    public function getState()
    {
        return $this->subjectState;
    }
}

class ConcreteObserver extends Observer
{
    private $name;
    private $subject;

    function __construct(ConcreteSubject $subject, $name)
    {
        $this->subject = $subject;
        $this->name = $name;
    }

    public function update()
    {
        echo "观察者 ".$this->name."的新状态是:".$this->subject->getState()."\n";
    }
}

$s = new ConcreteSubject();
$s->attach(new ConcreteObserver($s, "x"));
$s->attach(new ConcreteObserver($s, "y"));
$z = new ConcreteObserver($s, "z");
$s->attach($z);
$s->detatch($z);
$s->setState('ABC');
$s->notify();




















