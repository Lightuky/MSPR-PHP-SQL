<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/env.php';


define("DBHOST", $database['host']);
define("DBUSER", $database['username']);
define("DBPASS", $database['password']);
define("DBNAME", "mspr");

try {
    $conn = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME, DBUSER, DBPASS, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
    ));
}
catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}

