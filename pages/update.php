<?php
/**
 * Created by PhpStorm.
 * User: FK
 * Date: 1/31/2019
 * Time: 9:23 AM
 */
//inkluder/kræv filer
require '../extra/CRUD.php';
if (isset($_POST['products_id'])) {
    $crud = new CRUD();
    $crud->UpdateProduct($_POST['products_id'],$_POST['products_reference'],$_POST['products_price']);
    foreach ($_POST['desc'] as $key => $prodDesc){
        $crud->UpdateProductDescription($key, $_POST['products_id'], $prodDesc['languages_id'],
        $prodDesc['products_description_name'], $prodDesc['products_description_short_description'],
        $prodDesc['products_description_description'], $prodDesc['products_description_description']);
    }
    //Gå til read.php
    header('location:read.php');
}