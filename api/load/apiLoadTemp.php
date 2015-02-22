<?php

try {

    require_once '_config.php';

    $ips = array('192.168.1.112', '192.168.1.113', '192.168.1.114', '192.168.1.115', '192.168.1.116', '192.168.1.117', '192.168.1.118', '192.168.1.119', '192.168.1.120', '192.168.1.121');

    $type = 'temp';

    $begin = new DateTime('-30 days');
    $end = new DateTime('now');

    $interval = DateInterval::createFromDateString('10 min');
    $period = new DatePeriod($begin, $interval, $end);

    $lastTemp = 2200;

    foreach ($ips as $ip) {
        foreach ($period as $p) {
            $time = $p->format('Y-m-d H:i:s');
            $from = $lastTemp - 50 < 1800 ? 1800 : $lastTemp - 50;
            $to = $lastTemp + 50 > 2600 ? 2600 : $lastTemp + 50;
            $value = rand($from, $to) / 100;
            $lastTemp = $value * 100;
            $query = "INSERT INTO sh.notify (ip, type, time, value) VALUES ('" . $ip . "', '" . $type . "', '".$time."', " . $value . ")";
            //var_dump($query); die;
            $db->query($query);
        }
    }



    die('ok');
} catch (Exception $e) {
    die($e->getMessage());
}

