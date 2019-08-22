<?php
/**
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

namespace Zhusaidong\YskPlus;

trait Singleton
{
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
	
	private function __construct()
	{
	}
	
	private function __clone()
	{
	}
}
