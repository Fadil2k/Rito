<?php
/**
 * Created by PhpStorm.
 * User: FK
 * Date: 1/31/2019
 * Time: 7:25 AM
 */

$title = "Rediger Produkter";
//inkluder/kræv filer
include('../extra/UI/header.php');
require('../extra/CRUD.php');
$crud = new CRUD();

//WYSIWYG - nicEdit der er lavet i Javascript er benyttet
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id || $id===0 ){
    $product = json_decode($crud->Details($id));    //$crud->Details($id) returnerer produktet i json kode derfor bruger vi json_decode

    $languages = json_decode($crud->getLanguages());
    ?>
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

    <style>
        label {
            width: 100px;
            display: inline-block;
            vertical-align: top;
        }
        textarea {
            width: 450px;
            height: 150px;
        }
        input, textarea {
            margin: 0 0 10px 0;
            border: 1px solid black;
        }
    </style>
    <?php
    $action="../extra/update.php";   //som standard bliver det opdateret
    if ($id===0){           //men hvis id'et er 0 så vil den
        $action="../extra/insert.php";//indsætte istedet
    }

    ?>
    <form method="post" action="<?php echo $action; ?>">
        <input type="hidden" name="products_id" value="<?php echo $product->products_id; ?>">
        <label>Varenummer:</label>  <input type="text" name="products_reference" value="<?php echo $product->products_reference; ?>"><br>
        <label>Pris:</label> <input type="number" name="products_price" value="<?php echo $product->products_price; ?>"><br>

        <?php
        foreach ($languages as $language){
            include '../extra/_description.php';
        }
        ?>
        <button style="width: 200px; height: 70px; display: block; margin: auto">Send</button>
    </form>
<?php } else{ ?>
    <h1>Ugyldigt product</h1>
<?php }  ?>

<?php include('../extra/footer.php'); ?>
