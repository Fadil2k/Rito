<?php
// Værdierne er baseret på product id og sprog
$desc = json_decode($crud->getProductDescriptions($product->products_id,$language->languages_id));

//Hvis værdien 0 blev sendt, bliver resultatet null
// Det betyder at det kommet til at være et insert ikke en update
if($desc->products_description_id==null){
    $currId++;  // så vi skal oprette identifikation for at kunne gruppere dem
} else {
    $currId = $desc->products_description_id;   //eller vi skal bruge det nuværende id for at vide, hvad vi skal opdatere
}

// Inputs er i array format som:
// desc[10][products_description_name]
// Dette eksempel betyder, at products_description_name vil blive ændret for beskrivelsen med id 10
// Denne fil vil blive tilføjet afhængigt af antallet af sprog, hvis der er 8 vil den blive tilføjet 8 gange.
?>
<link rel="stylesheet" href="../extra/UI/form.css">

   <div class="panel">
   <div class="panel-header">
    <div class="panel-title"><span class="label label-rounded label-primary"><?php echo $language->languages_name; ?></span></div>
    </div>
    <div class="panel-body">
   
    <div class="form">

    
    <input type="hidden" name="desc[<?php echo $currId; ?>][languages_id]" value="<?php echo $language->languages_id; ?>"> <br>

    <label>Varenavn</label>
    <input type="text" name="desc[<?php echo $currId; ?>][products_description_name]" value="<?php echo $desc->products_description_name; ?>">
    <br>


     <textarea name="desc[<?php echo $currId; ?>][products_description_short_description]"><?php echo $desc->products_description_short_description  ; ?></textarea>
     <span class="label">Kort tekst</span>
     <br>

     <textarea name="desc[<?php echo $currId; ?>][products_description_description]"><?php echo $desc->products_description_description; ?></textarea>
      <span class="label">Lang tekst</span>
      <br><br>

</div>
  </div>
</div>
