<?php

/* Save the current directory. */
if (!defined('XIPHE_DYNAMIC_PROXY_BASEDIR')) {
	define('XIPHE_DYNAMIC_PROXY_BASEDIR', dirname(__FILE__).'/');
}

/* Enable autoloading. */
include "vendor/autoload.php";

/* Initiate the logger. */
$log = new KLogger(XIPHE_DYNAMIC_PROXY_BASEDIR.'log/', KLogger::DEBUG);

/* Check if func is set and allowed. */
if (!isset($_GET['func']) || !in_array($_GET['func'], array('get', 'set'))) {
	$log->logNotice('Incomplete request from '.$_SERVER['REMOTE_ADDR'], $_REQUEST);
	exit('0');
}

/* Get the current ip from file. */
$current_ip = file_get_contents(XIPHE_DYNAMIC_PROXY_BASEDIR.'private/ip.txt');

switch ($_GET['func']) {
case 'get':
	/* Just print the ip and die. */
	echo $current_ip;
	exit;
case 'set':

	/* Check if required login data is passed. */
	if (!isset($_REQUEST['name']) || !isset($_REQUEST['pass'])) {
		$log->logNotice('Incomplete request from '.$_SERVER['REMOTE_ADDR'], $_REQUEST);
		exit('0');
	}

	/* Include the user-data. */ 
	include XIPHE_DYNAMIC_PROXY_BASEDIR.'private/user.php';

	/* And compare it with the passed data. */
	if ($_REQUEST['name'] !== $user['name'] || $_REQUEST['pass'] !== $user['pass']) {
		$log->logWarn('Unauthorized request from '.$_SERVER['REMOTE_ADDR'], $_REQUEST);
		exit('0');
	}

	/* Get the new IP */
	$ip = isset($_REQUEST['ip']) ? $_REQUEST['ip'] : $_SERVER['REMOTE_ADDR'];

	/* Write ip into file, if it's new. */
	if ($ip !== $current_ip) {
		file_put_contents(XIPHE_DYNAMIC_PROXY_BASEDIR.'private/ip.txt', $ip);
		$log->logInfo('Updated IP Address to '.$ip);
	}

	exit('1');
}

exit('0');