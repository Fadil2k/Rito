<?php
/**
 * Created by PhpStorm.
 * User: FK
 * Date: 1/31/2019
 * Time: 9:07 AM
 */

require __DIR__ . '/conf/dbconf.php';

class CRUD
{

    protected $db;

    function __construct()
    {
        $this->db = DB();
    }

    function __destruct()
    {
        $this->db = null;
    }

    /*
     *
     *  new Record
     *
     * @param $first_name
     * @param $last_name
     * @param $email
     * @return $mixed
     * */
    public function Create($first_name, $last_name, $email)
    {
        $query = $this->db->prepare("INSERT INTO users(first_name, last_name, email) VALUES (:first_name,:last_name,:email)");
        $query->bindParam("first_name", $first_name, PDO::PARAM_STR);
        $query->bindParam("last_name", $last_name, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);

        $query->execute();
        return $this->db->lastInsertId();
    }

    /*
     * Read all records
     *
     * @return $mixed
     * */
    public function Read()
    {
        $query = $this->db->prepare("SELECT * FROM products p inner join products_description d on (p.products_id = d.products_id) WHERE d.languages_id=1");
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /*
     * Delete Record
     *
     * @param $user_id
     * */
    public function Delete($products_id)
    {
        $query = $this->db->prepare("DELETE FROM products WHERE products_id = :id");
        $query->bindParam("id", $products_id, PDO::PARAM_STR);
        $query->execute();

        $query = $this->db->prepare("DELETE FROM products_description WHERE products_id = :id");
        $query->bindParam("id", $products_id, PDO::PARAM_STR);
        $query->execute();

    }

    /**
     * @param $products_id
     * @param $products_reference
     * @param $products_price
     */
    public function UpdateProduct($products_id, $products_reference, $products_price)
    {
        $query = $this->db->prepare("UPDATE products SET products_reference=:products_reference, products_price=:products_price WHERE products_id=:products_id");
        $query->bindParam("products_id", $products_id, PDO::PARAM_INT);
        $query->bindParam("products_reference", $products_reference, PDO::PARAM_STR);
        $query->bindParam("products_price", $products_price, PDO::PARAM_INT);
        $query->execute();
    }

    public function UpdateProductDescription($products_description_id, $products_id, $languages_id, $products_description_name, $products_description_short_description, $products_description_description)
    {
        $query = $this->db->prepare("UPDATE products_description SET 
                                              products_id=:products_id, 
                                              languages_id=:languages_id, 
                                              products_description_name=:products_description_name, 
                                              products_description_short_description=:products_description_short_description, 
                                              products_description_description=:products_description_description 
                                              WHERE products_description_id=:products_description_id");
        $query->bindParam("products_description_id", $products_description_id, PDO::PARAM_INT);
        $query->bindParam("products_id", $products_id, PDO::PARAM_INT);
        $query->bindParam("languages_id", $languages_id, PDO::PARAM_INT);
        $query->bindParam("products_description_name", $products_description_name, PDO::PARAM_STR);
        $query->bindParam("products_description_short_description", $products_description_short_description, PDO::PARAM_STR);
        $query->bindParam("products_description_description", $products_description_description, PDO::PARAM_STR);
        $query->execute();
    }

    /*
     * Get Details
     *
     * @param $user_id
     * */
    public function Details($products_id)
    {
        $query = $this->db->prepare("SELECT * FROM products WHERE products_id = :id");
        $query->bindParam("id", $products_id, PDO::PARAM_STR);
        $query->execute();
        return json_encode($query->fetch(PDO::FETCH_ASSOC));
    }

    /*
     * Get Details
     * */
    public function getLanguages(){
        $query = $this->db->prepare("SELECT * FROM rito.languages");
        $query->execute();
        return json_encode($query->fetchAll(PDO::FETCH_ASSOC));
    }


    public function getProductDescriptions($products_id, $languageId)
    {
        $query = $this->db->prepare("SELECT * FROM products_description where products_id=:products_id and languages_id=:languageId");
        $query->bindParam("products_id", $products_id, PDO::PARAM_INT);
        $query->bindParam("languageId", $languageId, PDO::PARAM_INT);
        $query->execute();
        return json_encode($query->fetch(PDO::FETCH_ASSOC));
    }

    public function insertProduct($products_reference, $products_price)
    {
        $query = $this->db->prepare("INSERT INTO products (products_reference, products_price) VALUES (:products_reference, :products_price);
");
        $query->bindParam("products_reference", $products_reference, PDO::PARAM_STR);
        $query->bindParam("products_price", $products_price, PDO::PARAM_INT);
        $query->execute();
        return $this->db->lastInsertId();
    }
    public function insertProductDescription($products_id, $languages_id, $products_description_name, $products_description_short_description, $products_description_description)
    {
        $query = $this->db->prepare("INSERT INTO products_description (products_id, languages_id, products_description_name, products_description_short_description, products_description_description) 
VALUES (:products_id, :languages_id, :products_description_name, :products_description_short_description, :products_description_description)");

        $query->bindParam("products_id", $products_id, PDO::PARAM_INT);
        $query->bindParam("languages_id", $languages_id, PDO::PARAM_INT);
        $query->bindParam("products_description_name", $products_description_name, PDO::PARAM_STR);
        $query->bindParam("products_description_short_description", $products_description_short_description, PDO::PARAM_STR);
        $query->bindParam("products_description_description", $products_description_description, PDO::PARAM_STR);
        $query->execute();
        header('location:read.php');
    }

}

?>