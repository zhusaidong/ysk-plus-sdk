<?php
/**
 * device
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

require '../vendor/autoload.php';
$config = require 'config.php';

use Zhusaidong\YskPlus\DeviceExtInfo;
use Zhusaidong\YskPlus\YskPlus;

$ysk = new YskPlus($config['appKey'], $config['secretKey']);
//$ysk->setLog('api.log');

$deviceExtInfo = new DeviceExtInfo();

$apiRes = $ysk->device->update($config['device_sn'], '', $deviceExtInfo);
$apiRes = $ysk->device->syncStatus($config['device_sn']);
if($apiRes->getError() === FALSE)
{
	var_dump('ok', $apiRes->get());
}
else
{
	var_dump('error', $apiRes->getErrorMessage());
}
