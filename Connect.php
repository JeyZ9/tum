<?php
    $servername = 'localhost';
    $dbname = 'tum_sur';
    $username = 'root';
    $password = '';

    try{
        $conn = new PDO("mysql:host=$servername; dbname=$dbname;",
        $username,$password
    );
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo 'connect success!';
    }catch(Exception $e){
        echo $e;
    }


?>