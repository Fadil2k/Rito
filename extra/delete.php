<?php
/**
 * Created by PhpStorm.
 * User: FK
 * Date: 1/31/2019
 * Time: 7:27 AM
 */
//inkluder/kræv filer
require 'CRUD.php';

if (isset($_GET['id']) && $_GET['id']) {

    $object = new CRUD();
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id){
        $object->Delete($id);
        header('location:index.php');
    }

}
?>