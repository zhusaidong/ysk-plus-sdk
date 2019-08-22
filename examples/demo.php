<?php
/**
 * demo
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

require '../vendor/autoload.php';

use Zhusaidong\YskPlus\YskPlus;

$ysk = new YskPlus('appKey', 'secretKey');
$ysk->setLog('api.log');

$apiRes = $ysk->faceLib->create("customer_code", "my lib");
$apiRes = $ysk->faceLib->lists();
$apiRes = $ysk->faceLib->delete('customer_code');

if($apiRes->getError() === FALSE)
{
	var_dump('ok', $apiRes->get());
}
else
{
	var_dump('error', $apiRes->getErrorMessage());
}
