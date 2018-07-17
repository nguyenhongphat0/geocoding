<?php
    error_reporting(E_ERROR | E_PARSE);
    $config = json_decode(file_get_contents('config.json'));
    $conn = new mysqli($config->servername, $config->username, $config->password, $config->dbname);
    if ($conn->connect_error) die('no');
    $sql = "SELECT * FROM `location__geolocation` WHERE 1";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) die ('done');
    die('yes');