<?php
/**
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

namespace Zhusaidong\YskPlus\Api;

use Zhusaidong\YskPlus\Api;
use Zhusaidong\YskPlus\Response;

class Access extends Api
{
	/**
	 * 添加授权人员
	 *
	 * @param string $device_sn
	 * @param string $face_lib_code 人脸库编码
	 * @param array  $person_codes
	 *
	 * @return Response
	 */
	public function addPersons(string $device_sn, string $face_lib_code, array $person_codes = [])
	{
		return $this->request('/access_rights/device_grant_persons', [
			'device_sn'     => $device_sn,
			'face_lib_code' => $face_lib_code,
			'person_codes'  => $person_codes,
		]);
	}
	
	/**
	 * 删除授权人员
	 *
	 * @param string $device_sn
	 * @param string $face_lib_code 人脸库编码
	 * @param array  $person_codes
	 *
	 * @return Response
	 */
	public function deletePersons(string $device_sn, string $face_lib_code, array $person_codes = [])
	{
		return $this->request('/access_rights/device_revoke_persons', [
			'device_sn'     => $device_sn,
			'face_lib_code' => $face_lib_code,
			'person_codes'  => $person_codes,
		]);
	}
	
	/**
	 * 查询设备的授权人员
	 *
	 * @param string $device_sn
	 * @param int    $page_num
	 * @param int    $page_size
	 * @param int    $sync_status
	 *
	 * @return Response
	 */
	public function lists(string $device_sn, int $page_num = 1, int $page_size = 50, int $sync_status = 0)
	{
		$data = [
			'device_sn' => $device_sn,
			'page_num'  => $page_num,
			'page_size' => $page_size,
		];
		if(!empty($sync_status))
		{
			$data['sync_status'] = $sync_status;
		}
		
		return $this->request('/access_rights/query_grant_persons', $data);
	}
	
	/**
	 * 查询人的授权设备
	 *
	 * @param string $person_code   人员编码
	 * @param string $face_lib_code 人脸库编码
	 * @param int    $page_num
	 * @param int    $page_size
	 *
	 * @return Response
	 */
	public function personPermissions(string $person_code, string $face_lib_code, int $page_num = 1, int $page_size = 50)
	{
		return $this->request('/access_rights/query_grant_devices', [
			'person_code'   => $person_code,
			'face_lib_code' => $face_lib_code,
			'page_num'      => $page_num,
			'page_size'     => $page_size,
		]);
	}
	
	/**
	 * 设置设备管理理员
	 *
	 * @param string $device_sn
	 * @param string $face_lib_code 人脸库编码
	 * @param array  $person_codes
	 *
	 * @return Response
	 */
	public function setAdmin(string $device_sn, string $face_lib_code, array $person_codes = [])
	{
		return $this->request('/access_rights/set_admin', [
			'device_sn'     => $device_sn,
			'face_lib_code' => $face_lib_code,
			'person_codes'  => $person_codes,
		]);
	}
	
	/**
	 * 删除设备管理理员
	 *
	 * @param string $device_sn
	 * @param string $face_lib_code 人脸库编码
	 * @param array  $person_codes
	 *
	 * @return Response
	 */
	public function deleteAdmin(string $device_sn, string $face_lib_code, array $person_codes = [])
	{
		return $this->request('/access_rights/unset_admin', [
			'device_sn'     => $device_sn,
			'face_lib_code' => $face_lib_code,
			'person_codes'  => $person_codes,
		]);
	}
}
