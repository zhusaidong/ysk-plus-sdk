<?php
/**
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

namespace Zhusaidong\YskPlus;

use Monolog\Logger;

class Api
{
	use Singleton;
	/**
	 * @var Request|null $request
	 */
	private $request = NULL;
	/**
	 * @var null|Logger $logger
	 */
	private $logger = NULL;
	
	/**
	 * set request
	 *
	 * @param Request $request
	 *
	 * @return $this
	 */
	public function setRequest(Request $request)
	{
		$this->request = $request;
		
		return $this;
	}
	
	/**
	 * set logger
	 *
	 * @param Logger $logger
	 *
	 * @return $this
	 */
	public function setLogger(Logger $logger = NULL)
	{
		$this->logger = $logger;
		
		return $this;
	}
	
	/**
	 * 请求
	 *
	 * @param string $url
	 * @param array  $data
	 * @param array  $otherData
	 *
	 * @return Response
	 */
	public function request(string $url, array $data = [], array $faceImageData = [])
	{
		$response = new Response();
		$response->setOriginal($this->request->post($url, $data, $faceImageData));
		
		//log
		if($this->logger != NULL)
		{
			$this->logger->info('request[' . $url . '].' . $this->request->getTraceId(), $data + $faceImageData);
			$this->logger->info('response.' . $response->getZqznTraceId(), $response->info());
		}
		
		return $response;
	}
}
