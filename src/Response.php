<?php
/**
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

namespace Zhusaidong\YskPlus;

class Response
{
	/**
	 * @var array $response
	 */
	private $response = [];
	/**
	 * @var bool $error_code
	 */
	private $error_code = FALSE;
	/**
	 * @var bool $error_message
	 */
	private $error_message = FALSE;
	/**
	 * @var string $zqzn_trace_id
	 */
	private $zqzn_trace_id = '';
	
	/**
	 * set original response data
	 *
	 * @param string $data
	 *
	 * @return $this
	 */
	public function setOriginal(string $data)
	{
		$response = json_decode($data, TRUE);
		
		$this->zqzn_trace_id = $response['zqzn_trace_id'];
		if(isset($response['success']) and $response['success'] === FALSE)
		{
			$this->error_code = $response['error_code'];
			preg_match('/(.*):\[(?P<message>.*)]/i', $response['message'], $match);
			$this->error_message = $match['message'] ?? Error::getMessage($this->error_code);
		}
		else
		{
			$this->response = $response['data'];
		}
		
		return $this;
	}
	
	/**
	 * get error
	 *
	 * @return bool
	 */
	public function getError()
	{
		return $this->error_code;
	}
	
	/**
	 * get error message
	 *
	 * @return bool|null
	 */
	public function getErrorMessage()
	{
		return $this->error_code === FALSE ? NULL : $this->error_message;
	}
	
	/**
	 * get response data
	 *
	 * @return array
	 */
	public function get()
	{
		return $this->response;
	}
	
	/**
	 * get info
	 *
	 * @return array
	 */
	public function info()
	{
		return [
			'error_code'    => $this->getError(),
			'error_message' => $this->getErrorMessage(),
			'data'          => $this->get(),
		];
	}
	
	/**
	 * get zqzn_trace_id
	 *
	 * @return string
	 */
	public function getZqznTraceId() : string
	{
		return $this->zqzn_trace_id;
	}
}
