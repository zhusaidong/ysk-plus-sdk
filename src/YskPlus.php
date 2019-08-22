<?php
/**
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

namespace Zhusaidong\YskPlus;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Zhusaidong\YskPlus\Api\Access;
use Zhusaidong\YskPlus\Api\Device;
use Zhusaidong\YskPlus\Api\Face;
use Zhusaidong\YskPlus\Api\FaceLib;
use Exception;

/**
 * Class YskPlus
 *
 * @package Zhusaidong\YskPlus
 *
 * @property FaceLib $faceLib 人脸库
 * @property Face    $face    人脸
 * @property Device  $device  设备
 * @property Access  $access  授权访问
 */
class YskPlus
{
	/**
	 * @var string $appKey
	 */
	private $appKey = '';
	/**
	 * @var string $secretKey
	 */
	private $secretKey = '';
	/**
	 * @var array $apis
	 */
	private $apis = [
		FaceLib::class,
		Face::class,
		Device::class,
		Access::class,
	];
	/**
	 * @var array $apiObjs api objects
	 */
	private $apiObjs = [];
	/**
	 * @var Request|null $request
	 */
	private $request = NULL;
	/**
	 * @var null|Logger $logger
	 */
	private $logger = NULL;
	
	/**
	 * YskPlus constructor.
	 *
	 * @param $appKey
	 * @param $secretKey
	 */
	public function __construct($appKey, $secretKey)
	{
		$this->appKey    = $appKey;
		$this->secretKey = $secretKey;
		$this->apiObjs   = [];
		$this->request   = new Request($appKey, $secretKey);
	}
	
	/**
	 * set log
	 *
	 * @param $logPath
	 *
	 * @return $this
	 * @throws Exception
	 */
	public function setLog($logPath)
	{
		$this->logger = new Logger('YskPlusLog');
		$this->logger->pushHandler(new StreamHandler($logPath, Logger::INFO));
		
		return $this;
	}
	
	/**
	 * __get
	 *
	 * @param $param
	 *
	 * @return Api|null
	 */
	public function __get($param)
	{
		$apiObject = 'Zhusaidong\\YskPlus\\Api\\' . ucfirst($param);
		if(!in_array($apiObject, $this->apis))
		{
			return NULL;
		}
		
		if(!isset($this->apiObjs[$param]))
		{
			$api = $apiObject::getInstance();
			$api->setRequest($this->request);
			$api->setLogger($this->logger);
			$this->apiObjs[$param] = $api;
		}
		
		return $this->apiObjs[$param];
	}
	
	/**
	 * get file url
	 *
	 * @param $file_path
	 *
	 * @return string
	 */
	public function fileUrl($file_path)
	{
		$signature = md5(http_build_query([
			'file_path'  => $file_path,
			'app_key'    => $this->appKey,
			'secret_key' => $this->secretKey,
		]));
		
		return 'https://img.yskplus.com/download/app/' . $this->appKey . '/' . $file_path . '?signature=' . $signature;
	}
}
