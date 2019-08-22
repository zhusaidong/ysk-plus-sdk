<?php
/**
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

namespace Zhusaidong\YskPlus\Api;

use Zhusaidong\YskPlus\Api;
use Zhusaidong\YskPlus\Response;

class Face extends Api
{
	/**
	 * 添加人脸
	 *
	 * @param string $person_code   人员编码
	 * @param string $face_lib_code 人脸库编码
	 * @param string $person_name   人员名称
	 * @param array  $ext_info
	 * @param null   $face_img1
	 *
	 * @return Response
	 */
	public function create(string $person_code, string $face_lib_code, string $person_name, array $ext_info = [], $face_img1 = NULL)
	{
		return $this->request('/face/create', [
			'person_code'   => $person_code,
			'face_lib_code' => $face_lib_code,
			'person_name'   => $person_name,
			'ext_info'      => $ext_info,
		], ['face_img1' => $face_img1]);
	}
	
	/**
	 * 删除人脸
	 *
	 * @param string $person_code   人员编码
	 * @param string $face_lib_code 人脸库编码
	 * @param bool   $del_face_img1
	 *
	 * @return Response
	 */
	public function delete(string $person_code, string $face_lib_code, bool $del_face_img1 = FALSE)
	{
		return $this->request('/face/delete', [
			'person_code'   => $person_code,
			'face_lib_code' => $face_lib_code,
			'del_face_img1' => $del_face_img1,
		]);
	}
	
	/**
	 * 更新人脸
	 *
	 * @param string $person_code   人员编码
	 * @param string $face_lib_code 人脸库编码
	 * @param string $person_name   人员名称
	 * @param array  $ext_info
	 * @param null   $face_img1
	 *
	 * @return Response
	 */
	public function update(string $person_code, string $face_lib_code, string $person_name = '', array $ext_info = [], $face_img1 = NULL)
	{
		$data = [
			'person_code'   => $person_code,
			'face_lib_code' => $face_lib_code,
		];
		if(!empty($person_name))
		{
			$data['person_name'] = $person_name;
		}
		if(!empty($ext_info))
		{
			$data['ext_info'] = $ext_info;
		}
		
		if(!empty($face_img1))
		{
			$otherData = ['face_img1' => $face_img1];
		}
		else
		{
			$otherData = [];
		}
		
		return $this->request('/face/update', $data, $otherData);
	}
	
	/**
	 * 人脸详情
	 *
	 * @param string $person_code   人员编码
	 * @param string $face_lib_code 人脸库编码
	 *
	 * @return Response
	 */
	public function get(string $person_code, string $face_lib_code)
	{
		return $this->request('/face/get', [
			'person_code'   => $person_code,
			'face_lib_code' => $face_lib_code,
		]);
	}
}
