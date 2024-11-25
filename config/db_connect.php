<?php

$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "blog_db";

try {
    $connect = new PDO(
        "mysql:host=$sName;
        dbname=$db_name",
        $uName,
        $pass
    );
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed : " . $e->getMessage();
}
