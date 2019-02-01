<?php
/**
 * Created by PhpStorm.
 * User: FK
 * Date: 1/31/2019
 * Time: 9:21 AM
 */

require("../extra/CRUD.php");
//inkluder/kræv filer
$title = "Produkter";
include("../extra/UI/header.php");

$object = new CRUD();

// Design table header skabelon
$data = '<table width=\'80%\' border=1">
                        <tr>
                            <th>Navn</th>
                            <th>Varenummer</th>
                            <th>Pris</th>
                            <th>ID</th>
                            <th>Rediger</th>
                            <th>Slet</th>
                        </tr>';



$products = $object->Read();

//Loop til at gå igennem produkter
if (count($products) > 0) {
    foreach ($products as $product) {

        $data .= '<tr bgcolor=\'#CCCCCC\'>
                <td>' . $product['products_description_name'] . '</td>
                <td>' . $product['products_reference'] . '</td>
                <td>' . $product['products_price'] . '</td>
                <td>' . $product['products_id'] . '</td>
                <td>
                <a href="pages/edit.php?id='.$product['products_id'].'" class="btn btn-warning">Rediger</a></td>
                <td>
                <a href="extra/delete.php?id='.$product['products_id'].'" class="btn btn-danger">Slet</a></td>
            </tr>';
    }
} else {
    // Data ikke fundet
    $data .= '<tr><td >Data ikke fundet!</td></tr>';
}

$data .= '</table>';

echo $data;

?>
<br>
<br>
<br>
<a href="create.php?id=0">Tilføj produkt</a>