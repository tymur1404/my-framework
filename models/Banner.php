<?php

namespace models;
use app\Model;

class Banner extends Model
{
    //fields
    const ID = 'id';
    const NAME = 'name';
    const URL = 'url';
    const IMG = 'img';
    const STATUS = 'status';
    const POSITION = 'position';
    public static $folder = 'banner';

    public static function table()
    {
        return 'banner';
    }



}