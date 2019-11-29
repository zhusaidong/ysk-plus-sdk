<?php
/**
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

namespace Zhusaidong\YskPlus\Api;

use Zhusaidong\YskPlus\Api;
use Zhusaidong\YskPlus\Response;

class FaceLib extends Api
{
	/**
	 * 添加人脸库
	 *
	 * @param string $face_lib_code 人脸库编码
	 * @param string $face_lib_name 人脸库名称
	 * @param int    $face_lib_size
	 * @param string $notify_url
	 *
	 * @return Response
	 */
	public function create(string $face_lib_code, string $face_lib_name, int $face_lib_size = 10000, string $notify_url = '') : Response
	{
		$data = [
			'face_lib_code' => $face_lib_code,
			'face_lib_name' => $face_lib_name,
			'face_lib_size' => $face_lib_size,
		];
		if(!empty($notify_url))
		{
			$data['face_lib_config'] = ['notify_url' => $notify_url];
		}
		
		return $this->request('/face_lib/create', $data);
	}
	
	/**
	 * 删除人脸库
	 *
	 * @param string $face_lib_code 人脸库编码
	 *
	 * @return Response
	 */
	public function delete(string $face_lib_code) : Response
	{
		return $this->request('/face_lib/delete', ['face_lib_code' => $face_lib_code]);
	}
	
	/**
	 * 更新人脸库
	 *
	 * @param string $face_lib_code 人脸库编码
	 * @param string $face_lib_name 人脸库名称
	 * @param int    $face_lib_size
	 * @param string $notify_url
	 *
	 * @return Response
	 */
	public function update(string $face_lib_code, string $face_lib_name = '', int $face_lib_size = 0, string $notify_url = '') : Response
	{
		$data = [
			'face_lib_code' => $face_lib_code,
		];
		
		if(!empty($face_lib_name))
		{
			$data['face_lib_name'] = $face_lib_name;
		}
		if(!empty($face_lib_size))
		{
			$data['face_lib_size'] = $face_lib_size;
		}
		if(!empty($notify_url))
		{
			$data['face_lib_config'] = ['notify_url' => $notify_url];
		}
		
		return $this->request('/face_lib/update', $data);
	}
	
	/**
	 * 人脸库列表
	 *
	 * @return Response
	 */
	public function lists() : Response
	{
		return $this->request('/face_lib/query');
	}
}
