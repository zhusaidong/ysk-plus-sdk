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
	 * @param array $infos
	 */
	public function set(array $infos = [])
	{
		foreach($infos as $property => $info)
		{
			if(property_exists($this, $property))
			{
				$func              = 'set' . str_replace('_', '', ucwords($property, '_'));
				$this->{$property} = method_exists($this, $func) ? $this->$func($info) : $info;
			}
		}
	}
	
	/**
	 * get
	 *
	 * @return array
	 */
	public function get() : array
	{
		$properties = [];
		foreach(get_object_vars($this) as $property => $attr)
		{
			$properties[$property] = $attr instanceof self ? $attr->get() : $attr;
		}
		
		return $properties;
	}
}
