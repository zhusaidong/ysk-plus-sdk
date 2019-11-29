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
	 * max face image number
	 */
	const MAX_IMAGE_NUMBER = 2;
	
	/**
	 * get face image data
	 *
	 * @param array $faceImages
	 *
	 * @return array
	 */
	private function getFaceImageData(array $faceImages = []) : array
	{
		$faceImageData = [];
		$faceImages    = array_slice(array_values($faceImages), 0, self::MAX_IMAGE_NUMBER);
		foreach($faceImages as $index => $faceImage)
		{
			$faceImageData['face_img' . ($index + 1)] = $faceImage;
		}
		
		return $faceImageData;
	}
	
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
	public function create(string $person_code, string $face_lib_code, string $person_name, array $ext_info = [], array $face_imgs = []) : Response
	{
		return $this->request('/face/create', [
			'person_code'   => $person_code,
			'face_lib_code' => $face_lib_code,
			'person_name'   => $person_name,
			'nick_name'     => $person_name,
			'ext_info'      => $ext_info,
		], $this->getFaceImageData($face_imgs));
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
	public function delete(string $person_code, string $face_lib_code, bool $del_face_img1 = true, bool $del_face_img2 = false) : Response
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
	public function update(string $person_code, string $face_lib_code, string $person_name = '', array $ext_info = [], array $face_imgs = []) : Response
	{
		$data = [
			'person_code'   => $person_code,
			'face_lib_code' => $face_lib_code,
		];
		
		if(!empty($person_name))
		{
			$data['person_name'] = $person_name;
			$data['nick_name']   = $person_name;
		}
		if(!empty($ext_info))
		{
			$data['ext_info'] = $ext_info;
		}
		
		return $this->request('/face/update', $data, $this->getFaceImageData($face_imgs));
	}
	
	/**
	 * 人脸详情
	 *
	 * @param string $person_code   人员编码
	 * @param string $face_lib_code 人脸库编码
	 *
	 * @return Response
	 */
	public function get(string $person_code, string $face_lib_code) : Response
	{
		return $this->request('/face/get', [
			'person_code'   => $person_code,
			'face_lib_code' => $face_lib_code,
		]);
	}
}
