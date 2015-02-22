<?php

try {

    require_once '../_config.php';
    
    $get = $_GET;
    
    if (!is_array($get) || !array_key_exists('type', $get) || !array_key_exists('value', $get)) {
        throw new LogicException('Invalid GET parameters');
    }

    $ip = $_SERVER['REMOTE_ADDR'];
    $type = $_GET['type'];
    $value = $_GET['value'];

    $db->query("INSERT INTO sh.notify (ip, type, time, value) VALUES ('".$ip."', '".$type."', CURRENT_TIMESTAMP, '".$value."')");
    
    die('ok');
} catch (Exception $e) {
    die($e->getMessage());
}

