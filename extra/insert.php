<?php
/**
 * Created by PhpStorm.
 * User: FK
 * Date: 1/31/2019
 * Time: 9:23 AM
 */
//inkluder/kræv filer
require('CRUD.php');
//Indsæt data hvis $_POST indeholder products_reference
if (isset($_POST['products_reference'])) {
    $crud = new CRUD();
    $products_id = $crud->insertProduct($_POST['products_reference'],$_POST['products_price']);
    foreach ($_POST['desc'] as $key => $prodDesc){
        $crud->insertProductDescription($products_id, $prodDesc['languages_id'],
            $prodDesc['products_description_name'], $prodDesc['products_description_short_description'],
            $prodDesc['products_description_description']);
    }
    //Gå til read.php
    header('location:../pages/read.php');
}