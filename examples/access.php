<?php
/**
 * access
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

require '../vendor/autoload.php';
$config = require 'config.php';

use Zhusaidong\YskPlus\YskPlus;

$ysk = new YskPlus($config['appKey'], $config['secretKey']);
//$ysk->setLog('api.log');

$apiRes = $ysk->access->addPersons($config['device_sn'], 'customer_code', ['test_person_code']);
if($apiRes->getError() === FALSE)
{
	var_dump('ok', $apiRes->get());
}
else
{
	var_dump('error', $apiRes->getErrorMessage());
}
