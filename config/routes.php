<?php

return [

    'banner/changePosition' => ['banner/changePosition', 'auth'],
    'banner/delete' => ['banner/delete', 'auth'],
    'banner/update/([0-9]+)' => ['banner/update/$1', 'auth'],
    'banner/list' => ['banner/list', 'auth'],
    'banner/create' => ['banner/create', 'auth'],
    'banner' => ['banner/index', 'auth'],

    'login/login' => ['login/login'],
    'login/logout' => ['login/logout'],
    'login' => ['login/index'],

    '' => ['home/index']

];