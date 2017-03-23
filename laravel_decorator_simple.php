<?php

// 简化版的装饰者模式
// 模仿laravel middleware

interface Step
{
    public static function go(Closure $next);
}

class FirstStep implements Step
{
    public static function go(Closure $next)
    {
        echo "开启session， 获取数据<br />";
        $next();
        echo "保存数据，关闭session<br />";
    }
}

class NextStep implements Step
{
    public static function go(Closure $next)
    {
        echo 'Next Step<br />';
        $next();
    }
}

function goFun($step, $className)
{
    return function() use ($step, $className)
    {
        return $className::go($step);
    };
}

function then()
{
    $steps = ["FirstStep", "NextStep"];
    $prepare = function () {
        echo "请求行路由器传递，返回响应<br />";
    };
    $go = array_reduce($steps, "goFun", $prepare);
    $go();
}

then();

