<?php

function debug($val){
    echo "<pre>";
    var_dump($val);
    echo "</pre>";
}

//dump and die
function dd($val){
    echo "<pre>";
    var_dump($val);
    echo "</pre>";
    die();
}

function generateToken(){
    $_SESSION['_csrf'] =md5(time());
    return $_SESSION['_csrf'];
}

function checkedForm(){

    if(!empty($_POST) &&
        isset($_POST['_csrf']) &&
        isset($_SESSION['_csrf']) &&
        $_POST['_csrf'] == $_SESSION['_csrf']) {

        return true;
    }
    return false;
}

function post($key){
    if(isset($_POST[$key])){
        return $_POST[$key];
    }else{
        return FALSE;
    }
}

function SaveImage($img, $width, $height){
    try {
        if (!move_uploaded_file($_FILES['img']['tmp_name'], $img)) {
            throw new RuntimeException('Failed to move uploaded file.');
        }
        $image = new app\Image();
        $image->load($img);
        $image->resize($width, $height);
        $image->save($img);
        chmod($img, 0777);
    }catch (RuntimeException $e) {
        echo $e->getMessage();
    }
}


function deleteImg($img){

    if(!empty($img) && file_exists($img)) {
        unlink($img);
    }
}
// www.site.com/1st_param/2nd-param/etc
function getUrlParam($numParam ){
    $params = explode('/',$_SERVER['REQUEST_URI']);
    return $params[$numParam];
}

function getToken(){
    if(isset($_SESSION['_csrf']) && !empty($_SESSION['_csrf'])){
        return $_SESSION['_csrf'];
    }else{
        $_SESSION['_csrf'] = generateToken();
        return $_SESSION['_csrf'];
    }
}

function redirect($page=NULL){
    header('Location: '.$_SERVER["REQUEST_SCHEME"]."://".$_SERVER["HTTP_HOST"].'/'.$page);
}

function isLogin(){
    if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
        return true;
    }else{
        return false;
    }
}

