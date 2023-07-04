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

        switch($donetSerchCate) {
            case '1':
                //姓名
                Log::record('112233');
                Log::record($donetSerchCate);
                Log::record($username);
                $mOrder = model("Orders")->where("donate_name = '" . $username."'")->select();
                break;
            case '2':
                //電話
                $mOrder = model("Orders")->where("phone = '" . $username."'")->select();
                break;
            case '3':
                //轉帳後5碼
                $mOrder = model("Orders")->where("phone = '" . $username."'")->select();
                break;
            case '4':
                //信用卡後4碼
                $mOrder = model("Orders")->where("phone = '" . $username."'")->select();
                break;
        }

        
        

        $this->success('已送出成功', $mOrder);
    }
}
