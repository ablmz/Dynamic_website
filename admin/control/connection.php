<?php
include ('config.php');
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Bağlantı başarılı";
}
catch(PDOException $e)
{
    echo "Fehler: " . $e->getMessage();
}



