<?php
/**
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

namespace Zhusaidong\YskPlus\Api;

use Zhusaidong\YskPlus\Api;
use Zhusaidong\YskPlus\Response;

class Device extends Api
{
	/**
	 * 添加设备
	 *
	 * @param string $device_sn
	 * @param string $device_name
	 * @param array  $device_ext_info
	 *
	 * @return Response
	 */
	public function create(string $device_sn, string $device_name, array $device_ext_info = [])
	{
		return $this->request('/device/create', [
			'device_sn'       => $device_sn,
			'device_name'     => $device_name,
			'device_ext_info' => $device_ext_info,
		]);
	}
	
	/**
	 * 更新设备配置
	 *
	 * @param string $device_sn
	 * @param array  $deviceData
	 *
	 * @return Response
	 */
	public function updateConfig(string $device_sn, array $deviceData = [])
	{
		return $this->request('/device/update_config', [
				'device_sn' => $device_sn,
			] + $deviceData);
	}
	
	/**
	 * 更新设备信息
	 *
	 * @param string $device_sn
	 * @param string $device_name
	 * @param array  $device_ext_info
	 *
	 * @return Response
	 */
	public function update(string $device_sn, string $device_name = '', array $device_ext_info = [])
	{
		$data = [
			'device_sn' => $device_sn,
		];
		
		if(!empty($device_name))
		{
			$data['device_name'] = $device_name;
		}
		if(!empty($device_ext_info))
		{
			$data['device_ext_info'] = $device_ext_info;
		}
		
		return $this->request('/device/update', $data);
	}
	
	/**
	 * 删除设备
	 *
	 * @param string $device_sn
	 *
	 * @return Response
	 */
	public function delete(string $device_sn)
	{
		return $this->request('/device/delete', ['device_sn' => $device_sn]);
	}
	
	/**
	 * 设备详情
	 *
	 * @param string $device_sn
	 *
	 * @return Response
	 */
	public function get(string $device_sn)
	{
		return $this->request('/device/get', ['device_sn' => $device_sn]);
	}
	
	/**
	 * 设备列列表
	 *
	 * @param int    $page_num
	 * @param int    $page_size
	 * @param string $device_name
	 *
	 * @return Response
	 */
	public function lists(int $page_num, int $page_size, string $device_name = '')
	{
		$data = [
			'page_num'  => $page_num,
			'page_size' => $page_size,
		];
		if(!empty($device_name))
		{
			$data['device_name'] = $device_name;
		}
		
		return $this->request('/device/query', $data);
	}
	
	/**
	 * 配置同步状态
	 *
	 * @param string $device_sn
	 *
	 * @return Response
	 */
	public function syncStatus(string $device_sn)
	{
		return $this->request('/device/get_config_sync_status', ['device_sn' => $device_sn]);
	}
	
	/**
	 * 重置设备动态码
	 *
	 * @param string $device_sn
	 * @param string $device_key
	 *
	 * @return Response
	 */
	public function resetKey(string $device_sn, string $device_key)
	{
		return $this->request('/device/reset_key', [
			'device_sn'  => $device_sn,
			'device_key' => $device_key,
		]);
	}
}
