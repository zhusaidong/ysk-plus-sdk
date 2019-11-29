<?php
/**
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

namespace Zhusaidong\YskPlus\Device;

class DeviceInfo extends Info
{
	/**
	 * @var DeviceExtInfo $device_ext_info 设备扩展信息
	 */
	public $device_ext_info = '';
	/**
	 * @var int $save_log_days 终端识别⽇志保存天数,默认60天
	 */
	public $save_log_days = 60;
	/**
	 * @var int $recognize_accuracy_type 识别精度,类型 1-⾼；2-中；3-低。默认2
	 */
	public $recognize_accuracy_type = 2;
	/**
	 * @var int $recognize_distance_type 设备识别,距离 1-远；2-中；3-近。默认2
	 */
	public $recognize_distance_type = 2;
	/**
	 * @var int $play_voice_type 语⾳播报类型,1-不播报；2-铃声1（默认值）；3-铃声2；4-开⻔成功；5-认证通过;6-播报姓名；7-⾃定义播报内容
	 */
	public $play_voice_type = 2;
	/**
	 * @var string $play_voice_content ⾃定义语⾳播报内容,当语⾳播报类型为6或7时使⽤，中⽂限制10个字符，英⽂20个字符以内
	 */
	public $play_voice_content = '';
	/**
	 * @var string $open_time 开⻔时间 格式：HH:mm-HH:mm,默认为： 00:00-24:00
	 */
	public $open_time = '00:00-24:00';
	/**
	 * @var string $open_days 开⻔⽇期 以逗号分隔，默认为：1,2,3,4,5,6,7，表示周⼀⾄周⽇都需要开⻔
	 */
	public $open_days = '1,2,3,4,5,6,7';
	/**
	 * @var bool $liveness_detect 活体检测开关,false-关闭活体检测；true-开启活体检测 ，默认为：true
	 */
	public $liveness_detect = true;
	/**
	 * @var int $rec_time_frequency 识别频率 单位：秒。最⼩值30秒，默认180秒，即：在该时间窗内同⼀⼈员多次被识别，只上传⼀次识别记录
	 */
	public $rec_time_frequency = 180;
	
	/**
	 * set device_ext_info
	 *
	 * @param $device_ext_info
	 *
	 * @return DeviceExtInfo
	 */
	protected function setDeviceExtInfo($device_ext_info) : DeviceExtInfo
	{
		return new DeviceExtInfo(is_array($device_ext_info) ? $device_ext_info : json_decode($device_ext_info, true));
	}
}
