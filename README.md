ysk-plus-sdk
===

ysk-plus sdk

### usage

> composer require zhusaidong/ysk-plus-sdk

### config

```php
return [
	'appKey'    => 'appKey',
	'secretKey' => 'secretKey',
	'device_sn' => 'device_sn',
]
```

### Available methods

```php
$ysk->faceLib;//人脸库
$ysk->face;//人脸
$ysk->device;//设备
$ysk->access;//下发
```

### demo

```php
require 'vendor/autoload.php';

use Zhusaidong\YskPlus\YskPlus;

$ysk = new YskPlus('appKey', 'secretKey');
$apiRes = $ysk->faceLib->create('customer_code', 'my lib');
if($apiRes->getError() === FALSE)
{
	var_dump('ok', $apiRes->get());
}
else
{
	var_dump('error', $apiRes->getErrorMessage());
}
```

### log

```php
$ysk = setLog($logPath);
```

### device_ext_info

```php
$device_ext_info = new DeviceExtInfo();
$apiRes = $ysk->device->create('device_sn', 'device_name', $device_ext_info);
```
