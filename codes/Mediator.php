<?php

abstract class Mediator
{
	abstract public send($message, Colleague $colleague);
}

abstract class Colleague
{
	protected $mediator;

	function __construct(Mediator $mediator)
	{
		$this->mediator = $mediator;
	}
}

class ConcreteMediator extends Mediator
{
	private $colleague1;
	private $colleague2;

	public function setColleague1(Colleague $colleague)
	{
		$this->colleague1 = $colleague1;
	}

	public function setColleague2(Colleague $colleague)
	{
		$this->colleague2 = $colleague2;
	}

	public function send($message, Colleague $colleague)
	{
		if($this->colleague1 == $colleague)
		{
			$this->colleague2->notify();
		} else {
			$this->colleague1->notify();
		}
	}
}

class ConcreteColleague1 extends Colleague
{
	public function send($message)
	{
		$this->mediator->send($message, this);
	}

	public function notify($message)
	{
		echo "ConcreteColleague1\n";;
	}
}

class ConcreteColleague2 extends Colleague
{
	public function send($message)
	{
		$this->mediator->send($message, this);
	}

	public function notify($message)
	{
		echo "ConcreteColleague2\n";;
	}
}

//client

$mediator = new ConcreteMediator();
$c1 = new ConcreteColleague1($mediator);
$c2 = new ConcreteColleague2($mediator);

$mediator->setColleague1($c1);
$mediator->setColleague2($c2);

$c1->send('do you eat?');
$c2->send('no, do you want to invite me to dinner?');