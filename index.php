<?php

/* Save the current directory. */
define('XIPHE_DYNAMIC_PROXY_BASEDIR', dirname(__FILE__).'/');

/* Enable autoloading. */
include XIPHE_DYNAMIC_PROXY_BASEDIR.'vendor/autoload.php';

/* Get the configuration. */
include XIPHE_DYNAMIC_PROXY_BASEDIR.'private/config.php';

/* Inject the current IP into configuration */
$config['server'] = file_get_contents(XIPHE_DYNAMIC_PROXY_BASEDIR.'private/ip.txt');

/* Initiate the proxy. */
$proxy = new \phpproxy\Proxy($config);
$proxy->forward($_SERVER['REQUEST_URI']);
exit;