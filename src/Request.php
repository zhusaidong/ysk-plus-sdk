<?php
/**
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

namespace Zhusaidong\YskPlus;

use GuzzleHttp\Client;

class Request
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
	 * @var string $host
	 */
	private $host = 'https://openapi.yskplus.com/face/1.0/';
	/**
	 * @var string $trace_id trace_id
	 */
	private $trace_id = '';
	/**
	 * @var Client $client
	 */
	private $client;
	
	/**
	 * Request constructor.
	 *
	 * @param $appKey
	 * @param $secretKey
	 */
	public function __construct($appKey, $secretKey)
	{
		$this->appKey    = $appKey;
		$this->secretKey = $secretKey;
		$this->client    = new Client(['base_uri' => $this->host . $this->appKey . '/']);
	}
	
	/**
	 * get base sign data
	 *
	 * @return array
	 */
	private function getSignData() : array
	{
		$this->setTraceId(uniqid('', true) . '_' . date('YmdHis'));
		$request_time    = (int)(microtime(true) * 1000);//毫秒
		$signature_nonce = md5($this->getTraceId());
		
		return [
			'trace_id'        => $this->getTraceId(),
			'request_time'    => $request_time,
			'signature_nonce' => $signature_nonce,
			'signature'       => md5(http_build_query([
				'trace_id'        => $this->getTraceId(),
				'request_time'    => $request_time,
				'signature_nonce' => $signature_nonce,
				'app_key'         => $this->appKey,
				'secret_key'      => $this->secretKey,
			])),
		];
	}
	
	/**
	 * 生成post请求数据
	 *
	 * @param array $reqData
	 * @param array $faceImageData
	 *
	 * @return array
	 */
	private function getPostFields(array $reqData, array $faceImageData = []) : array
	{
		$multipart = [
			[
				'name'     => 'req_data',
				'contents' => json_encode(array_merge($this->getSignData(), $reqData), JSON_UNESCAPED_UNICODE),
			],
		];
		foreach($faceImageData as $key => $faceImage)
		{
			$multipart[] = [
				'name'     => $key,
				'contents' => @file_get_contents($faceImage),
			];
		}
		
		return $multipart;
	}
	
	/**
	 * post
	 *
	 * @param string $url
	 * @param array  $reqData
	 * @param array  $faceImageData
	 *
	 * @return bool|string
	 */
	public function post(string $url, array $reqData = [], array $faceImageData = [])
	{
		return $this->client->post(trim($url, '/'), ['multipart' => $this->getPostFields($reqData, $faceImageData)])
			->getBody()
			->getContents();
	}
	
	/**
	 * @return string
	 */
	public function getTraceId() : string
	{
		return $this->trace_id;
	}
	
	/**
	 * @param string $trace_id
	 *
	 * @return Request
	 */
	private function setTraceId(string $trace_id) : Request
	{
		$this->trace_id = $trace_id;
		
		return $this;
	}
}
