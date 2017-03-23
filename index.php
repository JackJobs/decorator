<?php

//装饰着模式

interface Decorator
{
    public function display();
}

class Person implements Decorator
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function display()
    {
        echo "我是" . $this->name . " 我出门了<br />";
    }
}

class Finery implements Decorator
{
    private $component;

    public function __construct(Decorator $decorator)
    {
        $this->component = $decorator;
    }

    public function display()
    {
        $this->component->display();
    }
}

class Shoe extends Finery
{
    public function display()
    {
        echo "穿上鞋子<br />";
        parent::display();
    }
}

class Skirt extends Finery
{
    public function display()
    {
        echo "穿上裙子<br />";
        parent::display();
    }
}

class Fire extends Finery
{
    public function display()
    {
        echo '出门前先整理头发<br />';
        parent::display();
        echo '出门后在整理一下头发<br />';
    }
}

//在小明打扮过程中，可以随时增加新的打扮类
//只要类继承Finery类（装饰类）并条用父类的同名方法
//就可以实现随时重新组织打扮过程

$person = new Person('小明');
$skirt = new Skirt($person);
$shoe = new Shoe($skirt);
$fire = new Fire($shoe);
$fire->display();



