<?php
/**
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

namespace Zhusaidong\YskPlus;

use Symfony\Component\HttpFoundation\Request;
use Closure;

class NotifyUrl
{
	/**
	 * get input
	 *
	 * @return array
	 */
	public function input()
	{
		$request = new Request();
		
		return $request->input();
	}
	
	/**
	 * notify url
	 *
	 * @return array
	 */
	public function notify_url(Closure $closure = NULL)
	{
		return $this->input();
	}
	
	/**
	 * realtime notify url
	 *
	 * @return array
	 */
	public function realtime_notify_url()
	{
		return $this->input();
	}
	
	/**
	 * receive success
	 */
	public function receiveSuccess()
	{
		http_response_code(200);
	}
	
	/**
	 * receive error
	 */
	public function receiveError()
	{
		http_response_code(404);
	}
}
