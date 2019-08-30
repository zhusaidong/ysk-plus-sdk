<?php
/**
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

namespace Zhusaidong\YskPlus\Device;

class DeviceExtInfo extends Info
{
	/**
	 * @var string $realtime_notify_url 实时推送URL地址
	 */
	public $realtime_notify_url = '';
	/**
	 * @var int $location_type 设备上显示的信息自定义类型，支持：1-不显示；2-显示设备名称；3-显示设备序列列号；4-自定义，不超过20个字符
	 */
	public $location_type = 2;
	/**
	 * @var string $location_desc 自定义显示设备信息的内容，当location_type值为4时，可设置该值，不可超过20个字符
	 */
	public $location_desc = '';
	/**
	 * @var int $door_delay_close_seconds 控制设备关门延时时间，单位为秒。如果设置时间小于5秒，将仍然保持上一次的时间配置不变
	 */
	public $door_delay_close_seconds = 5;
	/**
	 * @var string $recognize_success 自定义识别成功文本提示语,不超过8个字符，默认${name}欢迎您。${name} 表示被识别到人员的名称
	 */
	public $recognize_success = '${name}欢迎您';
	/**
	 * @var string $recognize_failed 自定义识别失败文本提示语，不超过8个字符。默认暂无权限
	 */
	public $recognize_failed = '暂无权限';
	/**
	 * @var string $standby_text 自定义待机文本提示语，不超过8个字符.默认欢迎光临
	 */
	public $standby_text = '欢迎光临';
	/**
	 * @var string $play_recognize_failed_voice_content 自定义识别失败提示语音,不超过10个中文
	 */
	public $play_recognize_failed_voice_content = '';
}
