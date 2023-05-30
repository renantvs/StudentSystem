<?php

    $dsn = "mysql:host=localhost;dbname=alunostest";
    $user = "test";
    $passwd = "test123";
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
    ); 

    $conn = new PDO($dsn, $user, $passwd);

?>