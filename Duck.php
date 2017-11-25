<?php
//no.1 设计模式入门


interface IFlyble{
    function fly();
}
interface IQuackable{
    function quack();
}



class Duck
{


    function swim(){}

    function  display()
    {
        echo("鸭类。");
    }

}


 class MallardDuck extends  Duck implements
    IFlyble,
    IQuackable
{
     function quack()
     {
         echo("呱呱叫。");
     }

    function display()
    {
        echo ("\n我是绿头鸭子");
    }
    function fly()
    {
        echo("我会飞");
    }
}

class RedheadDuck extends Duck implements IFlyble ,IQuackable
{
    function quack()
    {
        echo("呱呱叫。");
    }

    function display()
    {
        echo ("\n我是红头鸭子。");
    }
    function fly()
    {
        echo("我会飞");
    }
}

class RubberDuck extends Duck
{
    function quack()
    {
        echo ("吱吱叫");
    }

    function display()
    {
        echo ("\n我是橡皮鸭。");
    }

    function fly()
    {
       // echo ("我不会飞");
    }
}

class  DecoyDuck extends Duck
{
    function quack()
    {
        //echo ("不回飞");
    }

    function display()
    {
        echo ("\n我是假木头鸭。");
    }

    function fly()
    {
        // echo ("我不会飞");
    }
}
$duck=new Duck();
$duck->display();

$duck=new MallardDuck();
$duck->display();
$duck->quack();
$duck->fly();

$duck=new RedheadDuck();
$duck->display();
$duck->quack();
$duck->fly();

$duck=new RubberDuck();
$duck->display();

$duck=new DecoyDuck();
$duck->display();
