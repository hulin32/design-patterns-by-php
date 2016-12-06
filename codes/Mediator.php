<?php

abstract class Mediator
{
	abstract public function send($message, Colleague $colleague);
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
		$this->colleague1 = $colleague;
	}

	public function setColleague2(Colleague $colleague)
	{
		$this->colleague2 = $colleague;
	}

	public function send($message, Colleague $colleague)
	{
		if($this->colleague1 == $colleague)
		{
			$this->colleague2->notify($message);
		} else {
			$this->colleague1->notify($message);
		}
	}
}

class ConcreteColleague1 extends Colleague
{
	public function send($message)
	{
		$this->mediator->send($message, $this);
	}

	public function notify($message)
	{
		echo "ConcreteColleague1 ".$message."\n";
	}
}

class ConcreteColleague2 extends Colleague
{
	public function send($message)
	{
		$this->mediator->send($message, $this);
	}

	public function notify($message)
	{
		echo "ConcreteColleague2 ".$message."\n";;
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