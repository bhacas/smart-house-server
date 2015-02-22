<?php

try {

    require_once '_config.php';

    $ips = array('192.168.1.112', '192.168.1.113', '192.168.1.114', '192.168.1.115', '192.168.1.116', '192.168.1.117', '192.168.1.118', '192.168.1.119', '192.168.1.120', '192.168.1.121');

    $type = 'light1';

    $begin = new DateTime('-30 days');
    $end = new DateTime('now');

    $interval = DateInterval::createFromDateString('1 hour');
    $period = new DatePeriod($begin, $interval, $end);

    $lastTemp = 2200;
    $value = false;

    foreach ($ips as $ip) {
        foreach ($period as $p) {
            $time = $p->format('Y-m-d H:i:s');
            $value = !$value;
            $query = "INSERT INTO sh.notify (ip, type, time, value) VALUES ('" . $ip . "', '" . $type . "', '".$time."', " . (int)$value . ")";
            $db->query($query);
        }
    }



    die('ok');
} catch (Exception $e) {
    die($e->getMessage());
}

