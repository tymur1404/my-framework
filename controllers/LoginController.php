<?php

use app\View;
use models\Login;

class LoginController
{
    public function actionIndex()
    {
        if(isLogin()){
            redirect('banner/list');
        }

        View::render('login/index','', 'login');
    }

    public function actionLogin(){
        $user = new Login();
        if($user->login()){
            redirect('banner/list');
        }else{
            $error = 'Login and password do not match';
            View::render('login/index',$error, 'login');
        }
    }

    public function actionLogout(){
        unset($_SESSION['user']);
        redirect('login');
    }

}