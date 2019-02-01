<?php
/**
 * Created by PhpStorm.
 * User: FK
 * Date: 1/31/2019
 * Time: 2:41 AM
 */

define('HOST', 'localhost'); // Database host f.eks localhost
define('USER', 'root'); // Database bruger f.eks root ( hvis du er på en lokal dev server)
define('PASSWORD', 'JimmyDong123b'); // Database bruger password  ( hvis der ikke benyttes kode til bruger så hold den tom )
define('DATABASE', 'shop'); // Database navn
define('CHARSET', 'utf8');

function DB()
{
    //Har valgt at benytte PDO til at tilslutte databasen og prepared statements
    static $instance;
    if ($instance === null) {
        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => FALSE,
        );
        $dsn = 'mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=' . CHARSET;
        $instance = new PDO($dsn, USER, PASSWORD, $opt);
    }
    return $instance;
}
?>