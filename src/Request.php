<?php
/**
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

namespace Zhusaidong\YskPlus;

class Request
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
	 * @var string $host
	 */
	private $host = 'https://openapi.yskplus.com/face/1.0/';
	/**
	 * @var string $trace_id trace_id
	 */
	private $trace_id = '';
	
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
	}
	
	/**
	 * 请求签名
	 *
	 * @param int    $request_time
	 * @param string $signature_nonce
	 *
	 * @return string
	 */
	private function sign(int $request_time, string $signature_nonce)
	{
		$signData = [
			'trace_id'        => $this->getTraceId(),
			'request_time'    => $request_time,
			'signature_nonce' => $signature_nonce,
			'app_key'         => $this->appKey,
			'secret_key'      => $this->secretKey,
		];
		
		return md5(http_build_query($signData));
	}
	
	/**
	 * 生成post请求数据
	 *
	 * @param array $reqData
	 * @param array $otherData
	 *
	 * @return array
	 */
	private function getPostFields(array $reqData, array $otherData = [])
	{
		$this->setTraceId(uniqid() . '_' . date('YmdHis'));
		$request_time    = intval(microtime(TRUE) * 1000);//毫秒
		$signature_nonce = md5($this->getTraceId());
		
		return [
				'app_key'  => $this->appKey,
				'req_data' => json_encode([
						'trace_id'        => $this->getTraceId(),
						'request_time'    => $request_time,
						'signature_nonce' => $signature_nonce,
						'signature'       => $this->sign($request_time, $signature_nonce),
					] + $reqData, JSON_UNESCAPED_UNICODE),
			] + $otherData;
	}
	
	/**
	 * post
	 *
	 * @param string $url
	 * @param array  $reqData
	 * @param array  $otherData
	 *
	 * @return bool|string
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function post(string $url, array $reqData = [], array $otherData = [])
	{
		$fullUrl = $this->host . $this->appKey . $url;
		
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $fullUrl);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $this->getPostFields($reqData, $otherData));
		$response = curl_exec($curl);
		curl_close($curl);
		
		return $response;
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
