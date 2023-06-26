<?php

namespace app\api\controller;
use think\Log;
use app\common\controller\Api;

class Volunteer extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

    public function add()
    {
        // Log::init(['Donate' => 'File', 'log_name' => 'Donate']);
        $join_time = $this->request->request('join_time');
        $name = $this->request->request('name');
        $number_of_people = $this->request->request('number_of_people');
        $phone = $this->request->request('phone');
        $email = $this->request->request('email');


        $params = [
            'join_time' => $join_time,
            'name' => $name,
            'number_of_people' => $number_of_people,
            'phone' => $phone,
            'email' => $email,
        ];

        model('Volunteer')::create($params);

        $this->success('已送出成功');
        // $exec_times = $this->request->request('exec_times', 2);
        // $amount = $this->request->request('amount', 500);
        // $phone = $this->request->request('phone', '');
        // $donate_name = $this->request->request('donate_name', '');
        
        // Log::notice('donate_type:'. $donate_type);
        // Log::notice('exec_times:'. $exec_times);
        // Log::notice('amount:'. $amount);
        // Log::notice('phone:'. $phone);
        // Log::notice('donate_name:'. $donate_name);

        

        // if($amount <= 0){
        //     $this->error('[捐款金額]必須大於0');
        // }
        // if($phone == ''){
        //     $this->error('[手機號碼]不得為空');
        // }
        // if($donate_name == ''){
        //     $this->error('[捐款人]不得為空');
        // }
        
        // $order_no = "DT".date('YmdHis');

        // $mWebset = model("Webset")->where("`key` = 'donation_project'")->find();
        // if($mWebset){
        //     $donation_project = $mWebset->val;
        // }else{
        //     $donation_project = "尚未設定";
        // }
        // $params = [
        //     'order_no' => $order_no,
        //     'amount' => $amount,
        //     'donate_type' => $donate_type,
        //     'phone' => $phone,
        //     'donate_name' => $donate_name,
        //     'donation_project' => $donation_project,
        //     'status' => 0,
        // ];
        
        // if($donate_type == 2){
        //     $params['ExecTimes'] = $exec_times;
        //     $params['Frequency'] = 1;//週期間隔
        //     $params['PeriodType'] = 'D';//測試時用天
        // }

        // model('Donateorder')::create($params);

        // $this->success('訂單產生, 前往結帳');
    }
}
