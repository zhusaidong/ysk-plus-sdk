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
$ysk->device->create('device_sn', 'device_name', $device_ext_info);
```

### add face image

```php
//if image is a file
$face_images = [new CURLFile($face_image)];
//if image is a url
$face_images = [file_get_contents($face_image)];

$ysk->face->create('person_code', 'face_lib_code', 'person_name', [], $face_images);
```