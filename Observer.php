<?php

//02.观察者模式
/*
 * */

interface IObserver
{
    public  function update($temp,$humidity,$pressure);
}

interface IDisplayElement
{
    public function display();
}

//主题接口定义
 interface ISubject
{
    public function registerObserver(IObserver $iObserverbj);
    public function removeObserver(IObserver $iObserverbj);
    public function notifyObservers();
}

 class WeatherData implements ISubject
 {
     private  $temp,$humidity,$pressure;
     private  $ObArrays = [];

     public function setMeasurements($temp,$humidity,$pressure)
     {
         $this->temp=$temp;
         $this->humidity=$humidity;
         $this->pressure=$pressure;
         $this->measurementsChanged();
     }
     public function registerObserver(IObserver $iObserverbj)
     {
         array_push($this->ObArrays,$iObserverbj);
     }

     public function removeObserver(IObserver $iObserverbj)
     {
         if(in_array($iObserverbj,$this->ObArrays))
         {
             array_pop($iObserverbj);
         }
     }

     public function notifyObservers()
     {
         echo count($this->ObArrays)."\n";
        for ($i=0;$i<count($this->ObArrays);$i++)
        {
            $this->ObArrays[$i]->update($this->temp,$this->humidity,$this->pressure);
        }
     }
     public function measurementsChanged()
    {
        $this->notifyObservers();
    }
}

class CurrentConditionsDisplay implements IObserver,IDisplayElement
{

    public $temp,$humidity,$pressure;
    private $weat;
    public function __construct(WeatherData $weat)
    {

        $this->weat=$weat;
        $this->weat->registerObserver($this);
    }

    public function update($temp, $humidity, $pressure)
    {
        $this->temp=$temp;
        $this->humidity=$humidity;
        $this->pressure=$pressure;
        $this->display();
    }

    public function display()
    {
        echo "\nCurrent display: ".$this->temp." ".$this->humidity." ".$this->pressure;
    }
}


$weatherData=new WeatherData();
new CurrentConditionsDisplay($weatherData);
new CurrentConditionsDisplay($weatherData);
new CurrentConditionsDisplay($weatherData);
new CurrentConditionsDisplay($weatherData);
new CurrentConditionsDisplay($weatherData);
new CurrentConditionsDisplay($weatherData);

$i=2;
while (true)
{
    $weatherData->setMeasurements($i+=6,$i+=1,$i+=3);
    sleep(1);
}

