<?php
/**
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

namespace Zhusaidong\YskPlus;

trait Singleton
{
	/**
	 * 单例模式获取实例
	 *
	 * @return mixed
	 */
	public static function getInstance()
	{
		static $instances = [];
		
		$className = get_called_class();
		if(!isset($instances[$className]))
		{
			$instances[$className] = new $className;
		}
		
		return $instances[$className];
	}
	
	/**
	 * private constructor.
	 */
	private function __construct()
	{
	}
	
	/**
	 * private clone
	 */
	private function __clone()
	{
	}
}
