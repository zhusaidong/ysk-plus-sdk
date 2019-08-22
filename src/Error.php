<?php
/**
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

namespace Zhusaidong\YskPlus;

class Error
{
	const PARAMS_NOT_SET_ERROR = '000001';
	const PARAMS_CHECK_ERROR = '000002';
	const RECORD_NOT_EXIST = '000003';
	const RECORD_DUPLICATE_ERROR = '000004';
	const FILE_OVER_MAX_SIZE = '000006';
	const INVALID_APP_KEY = '002001';
	const INVALID_SERVICE_CODE = '002002';
	const INVALID_SIGNATURE = '002003';
	const INVALID_REQUEST_IP = '002004';
	const TOO_MANY_REQUESTS = '002007';
	const INVALID_ACCESS = '002008';
	const UNKNOWN_ERROR = '999999';
	const PERSON_NUM_OVER_LIMIT_ERROR = '100001';
	const FACE_NUM_OVER_LIMIT_ERROR = '100002';
	const FACE_RECOGNITION_ERROR = '100003';
	const IMAGE_OVER_SIZE_ERROR = '100004';
	const RECORD_NUM_OVER_LIMIT_ERROR = '100005';
	const IMAGE_QUALITY_ERROR = '100006';
	const INVALID_DEVICE_SN = '200001';
	const DEVICE_SN_HAS_BINDED = '200002';
	const INVALID_DEVICE_KEY = '200003';
	const FACE_LIB_HAS_PERSON = '300001';
	const FACE_LIB_SIZE_TOO_SMALL = '300002';
	private static $errorMessage = [
		'000001' => '参数[paraName]缺失',
		'000002' => '参数[paraName]值[paraValue]错误',
		'000003' => '数据不存在',
		'000004' => 'paraName[paraValue]已存在相同的记录',
		'000006' => '文件大小不能超过[X]KB',
		'002001' => 'app_key无效',
		'002002' => '服务未开通',
		'002003' => '签名校验不通过',
		'002004' => '请求ip不在ip白名单列表',
		'002007' => '请求TPS超过最大限制',
		'002008' => '禁止非法访问[原因描述]',
		'999999' => '未知错误',
		'100001' => '人员数量超出限制',
		'100002' => '人脸数量超出限制',
		'100003' => '上传图片中人脸检测异常',
		'100004' => '上传图片大小超过限定值[X]KB',
		'100005' => '一次上传记录超过限定值[X]条',
		'100006' => '上传照片的质量不合格',
		'200001' => '设备序列号无效',
		'200002' => '设备序列号已被绑定',
		'200003' => '设备动态码无效',
		'300001' => '人脸库存在人员，不能删除',
		'300002' => '当前人员数量超过人脸库待设置容量',
	];
	
	/**
	 * get message
	 *
	 * @param string $code
	 *
	 * @return string
	 */
	public static function getMessage(string $code) : string
	{
		return self::$errorMessage[$code] ?? '';
	}
}