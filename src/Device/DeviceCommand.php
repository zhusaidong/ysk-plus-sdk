<?php
/**
 *
 * @author zhusaidong <zhusaidong@gmail.com>
 */

namespace Zhusaidong\YskPlus\Device;

class DeviceCommand
{
	/**
	 * 升级。设备会向服务器请求最新安装包，然后在线升级
	 */
	const UPGRADE = 'UPGRADE';
	/**
	 * 禁⽤设备
	 */
	const DISABLE = 'DISABLE';
	/**
	 * 启⽤设备
	 */
	const ENABLE = 'ENABLE';
	/**
	 * 清空设备上的数据，重新向云端同步数据
	 */
	const CLEAR_DATA = 'CLEAR_DATA';
	/**
	 * 重置设备。清除设备上的数据，恢复设备⾄出⼚设置。设备需要重新绑定
	 */
	const RESET = 'RESET';
	/**
	 * 开⻔
	 */
	const OPEN_DOOR = 'OPEN_DOOR';
	/**
	 * 同步云端最新的设备配置信息
	 */
	const SYNC_CONFIG = 'SYNC_CONFIG';
	/**
	 * 同步云端最新改动的⼈员信息
	 */
	const SYNC_PERSONS = 'SYNC_PERSONS';
	/**
	 * 查询指定的⼈脸照⽚同步状态。command_data需要face_img_id字段
	 */
	const FACE_SYNC_STATUS = 'FACE_SYNC_STATUS';
	/**
	 * 校准时间。使设备时间与服务器端⼀致
	 */
	const CALIBRATE_TIME = 'CALIBRATE_TIME';
}
