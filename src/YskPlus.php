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
 * @property FaceLib $faceLib face lib
 * @property Face    $face    face
 * @property Device  $device  device
 * @property Access  $access  device access
 */
class YskPlus
{
	/**
	 * @var string $appKey
	 */
	private $appKey;
	/**
	 * @var string $secretKey
	 */
	private $secretKey;
	/**
	 * @var Api[] $apis
	 */
	private $apis = [
		'faceLib' => FaceLib::class,
		'face'    => Face::class,
		'device'  => Device::class,
		'access'  => Access::class,
	];
	/**
	 * @var Request $request
	 */
	private $request;
	/**
	 * @var null|Logger $logger
	 */
	private $logger;
	
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
		$this->request   = new Request($appKey, $secretKey);
	}
	
	/**
	 * set log
	 *
	 * @param string $logPath
	 *
	 * @return $this
	 * @throws Exception
	 */
	public function setLog(string $logPath = 'YskPlus.log') : self
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
		if(($apiObject = ($this->apis[$param] ?? null)) !== null)
		{
			return $apiObject::getInstance()->setRequest($this->request)->setLogger($this->logger);
		}
		
		return null;
	}
	
	public function __set($k, $v){
	}
	
	public function __isset($v){
	}
	
	/**
	 * get file url
	 *
	 * @param $file_path
	 *
	 * @return string
	 */
	public function fileUrl($file_path) : string
	{
		$signature = strtoupper(md5(urldecode(http_build_query([
			'file_path'  => $file_path,
			'app_key'    => $this->appKey,
			'secret_key' => $this->secretKey,
		]))));
		
		return 'https://img.yskplus.com/download/app/' . $this->appKey . '/' . $file_path . '?signature=' . $signature;
	}
}
