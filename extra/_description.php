<?php
// Værdierne er baseret på prod id og sprog
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
<div class="form">
<h2><?php echo $language->languages_name; ?></h2>
<input type="hidden" name="desc[<?php echo $currId; ?>][languages_id]" value="<?php echo $language->languages_id; ?>">
<label>Varenavn:</label> <input type="text" name="desc[<?php echo $currId; ?>][products_description_name]" value="<?php echo $desc->products_description_name; ?>"><br>
<label>Korttekst:</label> <textarea name="desc[<?php echo $currId; ?>][products_description_short_description]"><?php echo $desc->products_description_short_description  ; ?></textarea><br>
<label>Langtekst:</label> <textarea name="desc[<?php echo $currId; ?>][products_description_description]"><?php echo $desc->products_description_description; ?></textarea><br>
</div>