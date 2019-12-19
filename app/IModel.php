<?php

namespace app;

Interface IModel{

    public static function table();

    public function getItemByID($id);
    public function getAll($field, $order);

    public function create($values);
    public function update($values, $id);
    public function delete($id);

}