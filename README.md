ysk-plus-sdk
===

ysk-plus sdk

### usage

> composer require zhusaidong/ysk-plus-sdk

### demo

```php
require 'vendor/autoload.php';

use Zhusaidong\YskPlus\YskPlus;

$ysk = new YskPlus('appKey', 'secretKey');
$apiRes = $ysk->faceLib->create("customer_code", "my lib");
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
$ysk = setLog($logPath)
```