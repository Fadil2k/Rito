<hr>
<?php
$desc = json_decode($crud->getProductDescriptions($product->products_id,$language->languages_id));

if($desc->products_description_id==null){
    $currId++;
} else {
    $currId = $desc->products_description_id;
}
?>
<h2><?php echo $language->languages_name; ?></h2>
<input type="hidden" name="desc[<?php echo $currId; ?>][languages_id]" value="<?php echo $language->languages_id; ?>">
<label>Varenavn:</label> <input type="text" name="desc[<?php echo $currId; ?>][products_description_name]" value="<?php echo $desc->products_description_name; ?>"><br>
<label>Korttekst:</label> <textarea name="desc[<?php echo $currId; ?>][products_description_short_description]"><?php echo $desc->products_description_short_description  ; ?></textarea><br>
<label>Langtekst:</label> <textarea name="desc[<?php echo $currId; ?>][products_description_description]"><?php echo $desc->products_description_description; ?></textarea><br>
