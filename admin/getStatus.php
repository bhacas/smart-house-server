<?php

include_once '../_config.php';
include_once 'inc/helpers.php';

$ip = $_GET['ip'];

$date = new \DateTime('-1 day');
$query = 'SELECT time, value FROM notify WHERE ip = "' . $ip . '" AND type="temp" AND time > "'.$date->format('Y-m-d H:i:s').'" ORDER BY time ASC';
//var_dump($query); die;
$temp = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

$query = 'SELECT id, time, type, value FROM notify WHERE ip = "' . $ip . '" ORDER BY time DESC LIMIT 10';
$notifies = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

foreach ($notifies as &$n) {
    $n['notify'] = typeToText($n['type'], $n['value']);
}

$query = 'SELECT id, time, type, value FROM notify WHERE ip = "' . $ip . '" AND type = "light1" ORDER BY time DESC LIMIT 1';
$light1 = $db->query($query)->fetch();

$query = 'SELECT id, time, type, value FROM notify WHERE ip = "' . $ip . '" AND type = "light2" ORDER BY time DESC LIMIT 1';
$light2 = $db->query($query)->fetch();

$query = 'SELECT id, time, type, value FROM notify WHERE ip = "' . $ip . '" AND type = "outlet1" ORDER BY time DESC LIMIT 1';
$outlet1 = $db->query($query)->fetch();

$query = 'SELECT id, time, type, value FROM notify WHERE ip = "' . $ip . '" AND type = "outlet2" ORDER BY time DESC LIMIT 1';
$outlet2 = $db->query($query)->fetch();

$out = array(
    'outputs' => array(
        'light1' => $light1['value'],
        'light2' => $light2['value'],
        'outlet1' => $outlet1['value'],
        'outlet2' => $outlet2['value']
    ),
    'notifies' => $notifies,
    'temp' => $temp,
);

header('Content-Type: application/json');
echo json_encode($out);

