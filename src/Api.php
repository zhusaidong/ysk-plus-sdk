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
	private $request = null;
	/**
	 * @var null|Logger $logger
	 */
	private $logger = null;
	
	/**
	 * set request
	 *
	 * @param Request $request
	 *
	 * @return $this
	 */
	public function setRequest(Request $request) : self
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
	public function setLogger(Logger $logger = null) : self
	{
		$this->logger = $logger;
		
		return $this;
	}
	
	/**
	 * 请求
	 *
	 * @param string $url
	 * @param array  $data
	 * @param array  $faceImageData
	 *
	 * @return Response
	 */
	public function request(string $url, array $data = [], array $faceImageData = []) : Response
	{
		$response = new Response();
		$response->setOriginal($this->request->post($url, $data, $faceImageData));
		
		//log
		if($this->logger !== null)
		{
			$this->logger->info('request[' . $url . '].' . $this->request->getTraceId(), array_merge($data, $faceImageData));
			$this->logger->info('response.' . $response->getZqznTraceId(), $response->info());
		}
		
		return $response;
	}
}
