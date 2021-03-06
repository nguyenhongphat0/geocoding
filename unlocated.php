<?php
    header('Content-Type: application/json');
    error_reporting(E_ERROR | E_PARSE);
    $config = json_decode(file_get_contents('config.json'));
    $conn = new mysqli($config->servername, $config->username, $config->password, $config->dbname);
    if ($conn->connect_error) die('error');

    $sql = "SELECT id, address, postal_code FROM organisation__organisation WHERE type_clinic = true";
    $res = $conn->query($sql);
    $rows = array();
    while ($row = $res->fetch_assoc()) {
        $id = $row['id'];
        $sub_sql = "SELECT * FROM organisation__organisation_location WHERE id_organisation = $id";
        if (!$conn->query($sub_sql)->fetch_assoc()) {
            $rows[] = $row;
        }
    }
    die(json_encode($rows));
    $conn->close();