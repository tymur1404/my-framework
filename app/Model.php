<?php

namespace app;

use PDO;
use PDOException;

abstract class Model implements IModel
{
    public $db;
    public static $folder;
    public static $width = 600;
    public static $height = 600;

    public function __construct()
    {
        $this->db = DB::getConnection();
    }

    public static function table()
    {
        return 'table';
    }

    public static function imgFolder(){
        return static::table() ? static::table().'/' : '';
    }

    public function getItemBy($cond){

        try {
            if(!empty($cond)){
                $cond = ' WHERE '.$cond;
            }

            $sql = 'SELECT * from ' . static::table().$cond;
            $result = $this->db->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            return $result->fetch();
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function getItemByID($id)
    {
        $id = intval($id);
        if ($id) {
            try {
                $sql = 'SELECT * from ' . static::table() . ' WHERE id =' . $id;
                $result = $this->db->query($sql);
                $result->setFetchMode(PDO::FETCH_ASSOC);
                $newsItem = $result->fetch();

                return $newsItem;
            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
        }
        return false;
    }

    public function getAll($field='', $cond='' , $order='ASC' )
    {
        try {
            if(!empty($field)){
                $order = " ORDER BY $field $order";
            }
            if(!empty($cond)){
                $cond = ' WHERE '.$cond;
            }

            $sql = 'SELECT * from ' . static::table().$cond.$order;
            $result = $this->db->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            return $result->fetchAll();
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function create($valuesArr)
    {
        $fields = '(';
        $values = '(';
        $folder = static::imgFolder();
        $img = NULL;
        foreach ($valuesArr as $k => $v) {
            $fields .= $k . ", ";
            $values .= "'" . $v . "', ";
        }
        if(isset($_FILES['img']['name'])){
            $img = time() . "_" .basename($_FILES['img']["name"]);
            $fields.= " img ";
            $values.= " '$img' ";

        }
        $fullPathImg = ROOT.'/web/images/'.$folder.$img;
        $fields = substr($fields, 0, -1) . ")";
        $values = substr($values, 0, -1) . ")";

        try {

            $sql = "INSERT INTO " . static::table() . " $fields VALUES $values";
            if($img != NULL) {
                SaveImage($fullPathImg, static::$width, static::$width);

            }
            $this->db->exec($sql);
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    //Array key and name fields tables of database must be equal
    public function update($values, $id)
    {
        $fields = '';
        $img =NULL;
        $imgOld=NULL;
        $fullPathImg=NULL;
        $fullPathImgOld=NULL;
        $folder = static::imgFolder();

        foreach ($values as $k => $v) {
            $fields .= "$k='".$values[$k]."', ";
        }
        $fields = substr($fields, 0, -2);
        if(isset($_FILES['img']['name'])){
            $img = time() . "_" .basename($_FILES['img']["name"]);
            $fields.= ", img='". $img ."'";

            $banner = $this->getItemByID($id);
            $imgOld = $banner['img'];
            $fullPathImg = ROOT.'/web/images/'.$folder.$img;
            $fullPathImgOld = ROOT.'/web/images/'.$folder.$imgOld;
        }
        try {
            $sql = "UPDATE " . static::table() . " SET $fields WHERE id=$id";
            $this->db->exec($sql);
            if($img != NULL) {
                SaveImage($fullPathImg, static::$width, static::$width);
            }
            if($imgOld != NULL) {
                deleteImg($fullPathImgOld);
            }

        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage()." <br> SQL: ". $sql;
        }

    }

    public function delete($id)
    {
        $fullPathImg=NULL;
        $folder=static::imgFolder();
        $item = $this->getItemByID($id);
        if(isset($item['img']))
        {
            $fullPathImg = ROOT.'/web/images/'.$folder.$item['img'];
            deleteImg($fullPathImg);
        }
        try {
            $sql = "DELETE FROM " . static::table() . " WHERE id = $id";
            $this->db->exec($sql);
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }


}