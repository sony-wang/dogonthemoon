<?php

namespace app\common\model;

use think\Model;
use think\Log;

class Donateorder extends Model
{

    // 表名
    protected $name = 'donate_order';
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';

    public function getStatusList()
    {
        return ['0' => '等待付款', '1' => '付款完成', '2' => '付款失敗'];
    }

}
