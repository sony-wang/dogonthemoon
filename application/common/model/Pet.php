<?php

namespace app\common\model;

use think\Model;
use think\Log;

class Pet extends Model
{

    // 表名
    protected $name = 'pet';
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';

    public function getStatusList()
    {
        return ['0' => __('Status 0'), '1' => __('Status 1')];
    }

}
