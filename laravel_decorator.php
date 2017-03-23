<?php

// 装饰者模式
// 模仿laravel middleware

interface Middleware
{
    public static function handle(Closure $next);
}

class VerifyCsrfToken implements Middleware
{
    public static function handle(Closure $next)
    {
        echo 'check csrf<br />';
        $next();
    }
}

class StartSession implements Middleware
{
    public static function handle(Closure $next)
    {
        echo 'start session<br />';
        $next();
    }
}

function getSlice()
{
    return function ($stack, $pipe)
    {
        return function () use ($stack, $pipe)
        {
            return $pipe::handle($stack);
        };
    };
}

function then()
{
    $pipes = [
        'VerifyCsrfToken',
        'StartSession'
    ];
    $firstSlice = function () {
        echo '请求向路由传递，返回响应<br />';
    };
    $pipes = array_reverse($pipes);
    call_user_func(array_reduce($pipes, getSlice(), $firstSlice));
}

then();



