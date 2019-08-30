<?php
/**
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

namespace Zhusaidong\YskPlus\Device;

class Info
{
	/**
	 * constructor.
	 *
	 * @param array $info
	 */
	public function __construct(array $info = [])
	{
		$this->set($info);
	}
	
	/**
	 * set
	 *
	 * @param array $deviceInfo
	 */
	public function set(array $infos = [])
	{
		foreach($infos as $property => $info)
		{
			if(property_exists($this, $property))
			{
				$func              = 'set' . str_replace('_', '', ucwords($property, '_'));
				$this->{$property} = method_exists($this, $func) ? call_user_func([$this, $func], $info) : $info;
			}
		}
	}
	
	/**
	 * get
	 *
	 * @return array
	 */
	public function get()
	{
		$properties = [];
		foreach(get_object_vars($this) as $property => $attr)
		{
			$attr instanceof Info and $attr = $attr->get();
			$properties[$property] = $attr;
		}
		
		return $properties;
	}
}
