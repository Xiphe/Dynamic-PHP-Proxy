<?php

error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

include "vendor/autoload.php";

$log = new KLogger('log/', KLogger::DEBUG);

if (!isset($_GET['func']) || !in_array($_GET['func'], array('get', 'set'))) {
	$log->logNotice('Incomplete request from '.$_SERVER['REMOTE_ADDR'], $_REQUEST);
	exit('0');
}

switch ($_GET['func']) {
case 'get':
	echo file_get_contents('private/ip.txt');
	exit;
case 'set':
	if (!isset($_GET['name']) || !isset($_GET['pass'])) {
		$log->logNotice('Incomplete request from '.$_SERVER['REMOTE_ADDR'], $_REQUEST);
		exit('0');
	}

	include 'private/user.php';
	if ($_GET['name'] !== $user['name'] || $_GET['pass'] !== $user['pass']) {
		$log->logWarn('Unauthorized request from '.$_SERVER['REMOTE_ADDR'], $_REQUEST);
		exit('0');
	}

	$ip = isset($_REQUEST['ip']) ? $_REQUEST['ip'] : $_SERVER['REMOTE_ADDR'];

	file_put_contents('private/ip.txt', $ip);
	$log->logInfo('Updated IP Address to '.$ip);

	exit('1');
}

exit('0');