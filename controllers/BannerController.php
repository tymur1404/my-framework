<?php

use models\Banner;
use app\View;


class BannerController
{
    public function actionList()
    {
        $banner = new Banner();
        $arrBanner = $banner->getAll($banner::POSITION,'', 'asc');

        View::render('banner/list', $arrBanner);
    }

    public function actionIndex(){

        $banner = new Banner();
        $arrBanner = $banner->getAll($banner::POSITION, 'status=1','asc');

        View::render('banner/index', $arrBanner);
    }

    public function actionChangePosition(){
        // curPos - current position
        // nPos - neighborhoodPos position
        $post = $_POST;

        array_walk($post, function(&$e) { // note the reference (&)
            $e = intval(htmlentities($e));
        });

        if($post['curID'] &&
            $post['nID'] &&
            $post['curPos'] &&
            $post['nPos']
        ){
            $banner = new Banner();

            $banner->update(['position' => $post['nPos']], $post['curID']);
            $banner->update(['position' => $post['curPos']], $post['nID']);
        }

    }

    public function actionUpdate($id)
    {
        $banner = new Banner();

        if(checkedForm()) {

            if($id != NULL) {
                //dd($_POST);
                unset($_POST['_csrf']);
                $arrPost = $_POST;
                $banner->update($arrPost, $id);
                //$this->actionList();
            }
            generateToken();
        }

        $bannerArr = $banner->getItemByID($id);
        View::render('banner/update', $bannerArr);
    }

    public function actionDelete()
    {
        $banner = new Banner();
        if(!empty($_POST)) {

            $_csrf = $_POST['_csrf'];
            $id = intval($_POST['id']);

            if($_csrf == $_SESSION['_csrf'] &&
                !empty($id)){
                $banner->delete($id);
            }
        }

        return true;
    }

    public function actionCreate()
    {
        if(checkedForm()) {

            unset($_POST['_csrf']);
            $arrPost = $_POST;
            $banner = new Banner();
            $banner->create($arrPost);
            generateToken();
        }

        View::render('banner/create');
    }
}