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

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id || $id===0 ){
    $product = json_decode($crud->Details($id));    //$crud->Details($id) returns the product in json code, that is why we use json_decode
    $languages = json_decode($crud->getLanguages());
    ?>
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

    <style>
        label {
            width: 100px !important;
            display: inline-block !important;
            vertical-align: top !important;
        }
        textarea {
            width: 450px !important;
            height: 150px !important;
        }
        input, textarea {
            margin: 0 0 10px 0 !important;
            border: 1px solid black !important;
        }
        .form {
            width: 481px !important;
            float: left !important;
        }
    </style>
    <?php
    $action="../extra/update.php";   //som standard kommer det til at være update
    if ($id===0){           //men hvis id'et er lig med 0 kommer det til at være
        $action="../extra/insert.php";//                                     insert
    }

    ?>

        <form method="post" class=form" action="<?php echo $action; ?>">
            <input type="hidden" name="products_id" value="<?php echo $product->products_id; ?>">
            <label>Varenummer:</label>  <input type="text" name="products_reference" value="<?php echo $product->products_reference; ?>"><br>
            <label>Pris:</label> <input type="number" name="products_price" value="<?php echo $product->products_price; ?>"><br>

            <?php
            foreach ($languages as $language){
                include '../extra/_description.php';
            }
            ?>
            <div style="clear: both"></div>
            <button style="width: 200px; height: 70px; display: block; margin: auto">Submit</button>
        </form>

<?php } else{ ?>
    <h1>Ugyldigt produkt</h1>
<?php }  ?>

<?php include('../extra/footer.php'); ?>

