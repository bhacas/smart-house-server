<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

$dbHost = 'localhost';
$dbName = 'sh';
$dbUsername = 'root';
$dbPass = 'a11111';

$db = new PDO('mysql:host=' . $dbHost . ';dbname=' . $dbName . ';charset=utf8', $dbUsername, $dbPass);

