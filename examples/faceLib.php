<?php
/**
 * face lib
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

require '../vendor/autoload.php';
$config = require 'config.php';

use Zhusaidong\YskPlus\YskPlus;

$ysk = new YskPlus($config['appKey'], $config['secretKey']);
//$ysk->setLog('api.log');

$apiRes = $ysk->faceLib->create('customer_code', 'my lib');
$apiRes = $ysk->faceLib->lists();
if($apiRes->getError() === FALSE)
{
	var_dump('ok', $apiRes->get());
}
else
{
	var_dump('error', $apiRes->getErrorMessage());
}
