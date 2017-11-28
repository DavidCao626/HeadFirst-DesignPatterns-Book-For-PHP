<?php

//03.装饰者模式
/*
 * 基础：
 * 原则：对扩展开放，对修改关闭
 * 概念：动态地将责任加到对象上。想要扩展功能，装饰着提供有有别与继承到另外一种选择
 * */


abstract class Beverage
{
    protected $descriptiopn="类描述"; //需要子类去继承此字段

    public function getDescription()
    {
        return $this->descriptiopn;
    }

    public abstract function cost();
}
class Espresso extends Beverage
{
    public function __construct()
    {
        $this->descriptiopn="特浓咖啡";
    }

    public function cost()
    {
        return 12.00;//价格
    }
}

class HouseBlend extends Beverage
{
    public function __construct()
    {
        $this->descriptiopn="House Blend coffee";
    }
    public function cost()
    {
       return 18;
    }
}

abstract class CondimentDecorator extends Beverage
{
    //JAVA代码里这里是个抽象类，PHP不允许这么做
    public function getDescription() {
        return $this->descriptiopn;
    }
}


class Mocha extends CondimentDecorator
{
    private $Beverage;
    public function __construct(Beverage $beverage)
    {
        $this->Beverage=$beverage;
    }
    public function cost()
    {
        return 0.50 + $this->Beverage->cost();
    }

    public function getDescription()
    {
      return $this->Beverage->getDescription().", Mocha";
    }
}

class Soy extends CondimentDecorator
{
    private $Beverage;
    public function __construct(Beverage $beverage)
    {
        $this->Beverage=$beverage;
    }
    public function cost()
    {
        return 1.20 + $this->Beverage->cost();
    }

    public function getDescription()
    {
        return $this->Beverage->getDescription().", Soy";
    }
}
class Whip extends CondimentDecorator
{
    private $Beverage;
    public function __construct(Beverage $beverage)
    {
        $this->Beverage=$beverage;
    }
    public function cost()
    {
        return 1.50 + $this->Beverage->cost();
    }

    public function getDescription()
    {
        return $this->Beverage->getDescription().", Whip";
    }
}


$beverage=new Espresso();
$beverage=new Mocha($beverage);
$beverage=new whip($beverage);
$beverage=new soy($beverage);

echo ($beverage->getDescription()."价格：".$beverage->cost());
