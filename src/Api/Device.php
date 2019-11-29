<?php
/**
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

namespace Zhusaidong\YskPlus\Api;

use Zhusaidong\YskPlus\Api;
use Zhusaidong\YskPlus\Device\DeviceExtInfo;
use Zhusaidong\YskPlus\Device\DeviceInfo;
use Zhusaidong\YskPlus\Response;

class Device extends Api
{
	/**
	 * 添加设备
	 *
	 * @param string        $device_sn
	 * @param string        $device_name
	 * @param DeviceExtInfo $device_ext_info
	 *
	 * @return Response
	 */
	public function create(string $device_sn, string $device_name, DeviceExtInfo $device_ext_info = null) : Response
	{
		return $this->request('/device/create', [
			'device_sn'       => $device_sn,
			'device_name'     => $device_name,
			'device_ext_info' => $device_ext_info === null ? [] : $device_ext_info->get(),
		]);
	}
	
	/**
	 * 更新设备配置
	 *
	 * @param string          $device_sn
	 * @param DeviceInfo|null $deviceInfo
	 *
	 * @return Response
	 */
	public function updateConfig(string $device_sn, DeviceInfo $deviceInfo = null) : Response
	{
		$data = [
			'device_sn' => $device_sn,
		];
		if($deviceInfo !== null)
		{
			$data = array_merge($data, $deviceInfo->get());
		}
		
		return $this->request('/device/update_config', $data);
	}
	
	/**
	 * 更新设备信息
	 *
	 * @param string        $device_sn
	 * @param string        $device_name
	 * @param DeviceExtInfo $device_ext_info
	 *
	 * @return Response
	 */
	public function update(string $device_sn, string $device_name = '', DeviceExtInfo $device_ext_info = null) : Response
	{
		$data = [
			'device_sn' => $device_sn,
		];
		
		if(!empty($device_name))
		{
			$data['device_name'] = $device_name;
		}
		if($device_ext_info !== null)
		{
			$data['device_ext_info'] = $device_ext_info->get();
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
	public function delete(string $device_sn) : Response
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
	public function get(string $device_sn) : Response
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
	public function lists(int $page_num = 1, int $page_size = 50, string $device_name = '') : Response
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
	public function syncStatus(string $device_sn) : Response
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
	public function resetKey(string $device_sn, string $device_key) : Response
	{
		return $this->request('/device/reset_key', [
			'device_sn'  => $device_sn,
			'device_key' => $device_key,
		]);
	}
	
	/**
	 * 发送命令
	 *
	 * @param string $device_sn
	 * @param string $command
	 * @param array  $command_data
	 *
	 * @return Response
	 * @deprecated 暂未开放
	 */
	public function sendCommand(string $device_sn, string $command, array $command_data = []) : Response
	{
		return $this->request('/device/send_command', [
			'device_sn'    => $device_sn,
			'command'      => $command,
			'command_data' => $command_data,
		]);
	}
}
