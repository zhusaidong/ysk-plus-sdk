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
	 * @param array  $face_imgs
	 *
	 * @return Response
	 */
	public function create(string $person_code, string $face_lib_code, string $person_name, array $ext_info = [], array $face_imgs = [])
	{
		switch(count($face_imgs))
		{
			case 0:
				$otherData = [];
				break;
			case 1:
				$otherData = ['face_img1' => $face_imgs[0]];
				break;
			case 2:
				$otherData = ['face_img1' => $face_imgs[0], 'face_img2' => $face_imgs[1]];
				break;
		}
		
		return $this->request('/face/create', [
			'person_code'   => $person_code,
			'face_lib_code' => $face_lib_code,
			'person_name'   => $person_name,
			'ext_info'      => $ext_info,
		], $otherData);
	}
	
	/**
	 * 删除人脸
	 *
	 * @param string $person_code   人员编码
	 * @param string $face_lib_code 人脸库编码
	 * @param bool   $del_face_img1
	 * @param bool   $del_face_img2
	 *
	 * @return Response
	 */
	public function delete(string $person_code, string $face_lib_code, bool $del_face_img1 = TRUE, bool $del_face_img2 = FALSE)
	{
		return $this->request('/face/delete', [
			'person_code'   => $person_code,
			'face_lib_code' => $face_lib_code,
			'del_face_img1' => $del_face_img1,
			'del_face_img2' => $del_face_img2,
		]);
	}
	
	/**
	 * 更新人脸
	 *
	 * @param string $person_code   人员编码
	 * @param string $face_lib_code 人脸库编码
	 * @param string $person_name   人员名称
	 * @param array  $ext_info
	 * @param array  $face_imgs
	 *
	 * @return Response
	 */
	public function update(string $person_code, string $face_lib_code, string $person_name = '', array $ext_info = [], array $face_imgs = [])
	{
		$data = [
			'person_code'   => $person_code,
			'face_lib_code' => $face_lib_code,
		];
		
		!empty($person_name) and $data['person_name'] = $person_name;
		!empty($ext_info) and $data['ext_info'] = $ext_info;
		
		switch(count($face_imgs))
		{
			case 0:
				$otherData = [];
				break;
			case 1:
				$otherData = ['face_img1' => $face_imgs[0]];
				break;
			case 2:
				$otherData = ['face_img1' => $face_imgs[0], 'face_img2' => $face_imgs[1]];
				break;
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
