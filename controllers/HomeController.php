<?php

use app\View;
use models\Login;

class HomeController
{
    public function actionIndex()
    {

        View::render('home/index','','login');
    }


}