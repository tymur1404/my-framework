<?php
namespace app;

class View{


    public static function render($name, $params=null, $layoutName = 'default'){

        require_once (ROOT."/views/layouts/$layoutName-header.php");
        require_once (ROOT."/views/$name.php");
        require_once (ROOT."/views/layouts/$layoutName-footer.php");

    }
}