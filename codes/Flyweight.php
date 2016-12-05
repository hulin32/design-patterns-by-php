<?php

abstract class Flyweight
{
	abstract public function operation($extringsicState);
}

class ConcreteFlyweight extends Flyweight
{
	public function operation($extringsicState)
	{
		echo "ConcreteFlyweight:".$extringsicState."\n";
	}
}

class UnsharedConcreteFlyweight extends Flyweight
{
	public function operation($extringsicState)
	{
		echo "Unshared ConcreteFlyweight:".$extringsicState."\n";
	}
}

class FlyweightFactory
{
	private $flyweights = [];

	function __construct()
	{	
		$this->flyweights['x'] = new ConcreteFlyweight();
		$this->flyweights['y'] = new ConcreteFlyweight();
		$this->flyweights['z'] = new ConcreteFlyweight();
	}

	public function getFlyweight($key)
	{
		return $this->flyweights[$key];
	}
}

//client 

$state = 22;
$f = new FlyweightFactory();
$fx =  $f->getFlyweight('x');
$fx->operation(--$state);

$fx =  $f->getFlyweight('y');
$fx->operation(--$state);

$fx =  $f->getFlyweight('z');
$fx->operation(--$state);

$uf = new UnsharedConcreteFlyweight();
$uf->operation(--$state);