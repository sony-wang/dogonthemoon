<?php

namespace app\api\controller;
use think\Log;
use app\common\controller\Api;

class Orders extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

    public function add()
    {
        $donetSerchCate = $this->request->request('donetSerchCate');
        $username = $this->request->request('username');
        $beforeSix = date(strtotime('-6 month'));
        $where['createtime'] = ['>', $beforeSix];
        $where['status'] = ['=', '1'];
        switch($donetSerchCate) {
            case '1':
                //姓名
                $mOrder = model("Orders")->where("donate_name = '" . $username."'")->where($where)->select();
                break;
            case '2':
                //電話
                $mOrder = model("Orders")->where("phone = '" . $username."'")->where($where)->select();
                break;
            case '3':
                //轉帳後5碼
                $mOrder = model("Orders")->where("phone = '" . $username."'")->where($where)->select();
                break;
            case '4':
                //信用卡後4碼
                $mOrder = model("Orders")->where("phone = '" . $username."'")->where($where)->select();
                break;
        }

        Log::record('121212');
        Log::record($mOrder);
        

        $this->success('已送出成功', $mOrder);
    }
}
