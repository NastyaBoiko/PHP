<?php

require_once 'autoload.php';
require_once 'config.php';

$menu = new Menu($config);
$request = new Request();
$mysql = new MySql($sql);

$user = new User($request, $mysql);


