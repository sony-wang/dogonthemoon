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
        // $donetSerchCate = $this->request->request('donetSerchCate');
        $donate_name = $this->request->request('donate_name',"");
        $phone = $this->request->request('phone',"");
        $AccNo = $this->request->request('AccNo',"");
        $card4no = $this->request->request('card4no',"");

        if($donate_name == "" && $phone == "" && $AccNo == "" && $card4no == ""){
            $this->error('至少填一項');
        }

        $whereList = [];
        if($donate_name != ""){
            $whereList[] = " donate_name = '".$donate_name."' ";
        }
        if($phone != ""){
            $whereList[] = " phone = '".$phone."' ";
        }
        if($AccNo != ""){
            $whereList[] = " (WebATMAccNo = '".$AccNo."' OR ATMAccNo = '".$AccNo."') ";
        }
        if($card4no != ""){
            $whereList[] = " card4no = '".$card4no."' ";
        }
        $beforeSix = strtotime('-6 month');
        $whereList[] = " createtime > ".$beforeSix." AND `status` = 1";
        $mOrder = model("Orders")->where(implode(" AND ", $whereList))->select();
        // switch($donetSerchCate) {
        //     case '1':
        //         //姓名
        //         $mOrder = model("Orders")->where("donate_name = '" . $username."'")->where($where)->select();
        //         break;
        //     case '2':
        //         //電話
        //         $mOrder = model("Orders")->where("phone = '" . $username."'")->where($where)->select();
        //         break;
        //     case '3':
        //         //轉帳後5碼
        //         $mOrder = model("Orders")->where("phone = '" . $username."'")->where($where)->select();
        //         break;
        //     case '4':
        //         //信用卡後4碼
        //         $mOrder = model("Orders")->where("phone = '" . $username."'")->where($where)->select();
        //         break;
        // }

        
        if($mOrder){
            $this->success('已送出成功', $mOrder);
        }else{
            $this->error('查無資料');
        }
    }
}
