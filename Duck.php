<?php
//no.1 设计模式入门 （策略模式StrategyPattern） Davidcao626@foxmail.com
/*
 * 名词概念
 * 基础：抽象、封装、多态、继承。
 * 原则：封装变化、多用组合少用继承。针对接口编程，不针对实现编程。
 * 模式：策略模式-定义算法族，分别封装起来，让他们之间可以互相替换，此模式让算法的变化独立与使用算法的客户。
 * */



//飞行为抽象接口
interface IFlyBehavior
{
    function fly();
}

class FlyWithWings implements IFlyBehavior
{
    function fly()
    {
        echo '我会飞';
    }
}

class FlyNoway implements IFlyBehavior
{
    function fly()
    {
        echo '我不会飞';
    }
}
class FlyYecgaa implements IFlyBehavior
{
    function fly()
    {
        echo ' -> 一个火箭飞行助力动作';
    }
}

//叫行为抽象接口
interface IQuackBehavior
{
    function quack();
}

class  Squeask implements IQuackBehavior
{
    function quack()
    {
        echo '吱吱叫';
    }
}

class MuteQuack implements IQuackBehavior
{
    function quack()
    {
        echo '我不会叫';
    }
}
class Quacks implements IQuackBehavior
{
    function quack()
    {
        echo('呱呱叫');
    }
}

class ModelQuack implements IQuackBehavior
{
    function quack()
    {
        echo('模拟鸭叫');
    }
}

trait FlyAndQuackTrait{
    protected $flybehavior;
    protected $quackBehavior;
    public function __construct(IFlyBehavior $flybehvior,IQuackBehavior $quackBehavior)
    {
        $this->flybehavior=$flybehvior;
        $this->quackBehavior=$quackBehavior;
    }
    /**
     * @param IFlyBehavior $flybehavior
     */
    public function setFlybehavior(IFlyBehavior $flybehavior)
    {
        $this->flybehavior = $flybehavior;
    }
    /**
     * @param IQuackBehavior $quackBehavior
     */
    public function setQuackBehavior(IQuackBehavior $quackBehavior)
    {
        $this->quackBehavior = $quackBehavior;
    }
    public function performFly()
    {
        $this->flybehavior->fly();
    }
    public function performQuack()
    {
        $this->quackBehavior->quack();
    }
}

abstract class Duck
{
    use FlyAndQuackTrait;

    public function swim(){}

    public abstract function display();
}


 class MallardDuck extends  Duck
{
    public function __construct()
    {
        parent::__construct(new FlyWithWings(),new Quacks());
    }

     function display()
    {
        echo ("我是绿头鸭子");
    }
}

class RedheadDuck extends Duck
{
    public function __construct()
    {
        parent::__construct(new FlyWithWings(),new Quacks());
    }

    function display()
    {
        echo ("\n我是红头鸭子");
    }
}

class RubberDuck extends Duck
{
    public function __construct()
    {
        parent::__construct(new FlyNoway(),new Squeask());
    }

    function display()
    {
        echo ("\n我是橡皮鸭。");
    }
}

class  DecoyDuck extends Duck
{
    public function __construct()
    {
        parent::__construct(new FlyNoway(),new MuteQuack());
    }

    function display()
    {
        echo ("\n我是假木头鸭。");
    }
}


class DuckCall
{
    use FlyAndQuackTrait;
    function display()
    {
        echo "\n我是鸭鸣器";
    }
}
/*$duck=new Duck();
$duck->display();*/

$duck=new MallardDuck();
$duck->display();

$duck->performQuack();
$duck->performFly();

$duck=new RedheadDuck();
$duck->display();
$duck->performQuack();
$duck->performFly();

$duck=new RubberDuck();
$duck->display();
$duck->performQuack();
$duck->performFly();

$duck=new DecoyDuck();
$duck->display();

$duck->performQuack();
$duck->performFly();
$duck->setFlybehavior(new FlyYecgaa());//动态改变行为
$duck->performFly();


$duckcall=new DuckCall(new FlyNoway(),new ModelQuack());//依赖注入，动态改变行为。
$duckcall->display();
$duckcall->performQuack();
$duckcall->performFly();