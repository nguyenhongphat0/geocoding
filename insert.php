<?php
    error_reporting(E_ERROR | E_PARSE);
    $config = json_decode(file_get_contents('config.json'));
    $conn = new mysqli($config->servername, $config->username, $config->password, $config->dbname);
    if ($conn->connect_error) die();
    
    $orgid = $_GET['orgid'];
    $name = $_GET['name'];
    $address = $_GET['address'];
    $country = $_GET['country'];
    $street = $_GET['street'];
    $number = $_GET['number'];
    $place_id = $_GET['place_id'];
    $latitude = $_GET['latitude'];
    $longtitude = $_GET['longtitude'];
    $logs = '';

    $sql = "INSERT INTO `location__geolocation`(`name`, `address`, `country`, `street`, `number`, `place_id`, `latitude`, `longitude`) VALUES ('".$name."','".$address."','".$country."','".$street."','".$number."','".$place_id."','".$latitude."','".$longtitude."')";
    $res = $conn->query($sql);
    if ($res === TRUE) $logs .= $address.' => INSERT SUCCESS';
    else $logs .= $address.' => INSERT ERROR';

    $sql = "INSERT INTO `organisation__organisation_location`(`id_organisation`, `id_geolocation`) VALUES ('".$orgid."','".$conn->insert_id."')";
    $res = $conn->query($sql);
    if ($res === TRUE) $logs .= ' => MAP KEY LSUCCESS';
    else $logs .= ' => MAP KEY ERROR';

    $conn->close();
    die($logs);