<?php

include "vendor/autoload.php";
include "private/config.php";

$config['server'] = file_get_contents('private/ip.txt');

$proxy = new \phpproxy\Proxy($config);
$proxy->forward($_SERVER['REQUEST_URI']);