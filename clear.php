<?php
    die('This script is deprecated!');

    error_reporting(E_ERROR | E_PARSE);
    $config = json_decode(file_get_contents('config.json'));
    $conn = new mysqli($config->servername, $config->username, $config->password, $config->dbname);
    if ($conn->connect_error) die('error');

    $sql = "DELETE FROM `organisation__organisation_location` WHERE 1";
    $res = $conn->query($sql);
    $sql = "DELETE FROM `location__geolocation` WHERE 1";
    $res = $conn->query($sql);

    die('Finish clearing old data. Click <a href="index.html">here</a> to start a new run.');