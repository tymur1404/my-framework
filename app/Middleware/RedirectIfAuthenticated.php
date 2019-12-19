<?php
namespace app\Middleware;

class RedirectIfAuthenticated{

    const KEY = 'auth';


    public static function handle($param)
    {
        if ($param == self::KEY && !isLogin()) {
            redirect('login');
        }

        return true;
    }
}