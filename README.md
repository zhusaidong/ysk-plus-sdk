ysk-plus-sdk
===

the ysk-plus sdk

### usage

> composer require zhusaidong/ysk-plus-sdk -vvv

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
$ysk->faceLib;	//face lib
$ysk->face;	//face
$ysk->device;	//device
$ysk->access;	//device access
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
//if the image is a file
$face_images = [new CURLFile($face_image)];
//if the image is a url
$face_images = [file_get_contents($face_image)];

$ysk->face->create('person_code', 'face_lib_code', 'person_name', [], $face_images);
```
