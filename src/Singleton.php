<?php
/**
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

namespace Zhusaidong\YskPlus;

trait Singleton
{
	/**
	 * get instance
	 *
	 * @return Api
	 */
	public static function getInstance() : Api{
		static $instances = [];
		
		$className = static::class;
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
