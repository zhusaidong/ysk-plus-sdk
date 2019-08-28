<?php
/**
 *face
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

require '../vendor/autoload.php';
$config = require 'config.php';

use Zhusaidong\YskPlus\YskPlus;

$ysk = new YskPlus($config['appKey'], $config['secretKey']);
//$ysk->setLog('api.log');

$apiRes = $ysk->face->create('test_person_code', 'customer_code', 'person_name', [], [new CURLFile(__DIR__ . '/face.png')]);
$apiRes = $ysk->face->delete('test_person_code', 'customer_code');
if($apiRes->getError() === FALSE)
{
	var_dump('ok', $apiRes->get());
}
else
{
	var_dump('error', $apiRes->getErrorMessage());
}
