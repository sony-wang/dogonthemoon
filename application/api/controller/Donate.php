<?php

namespace app\api\controller;
use think\Log;
use app\common\controller\Api;

/**
 * 首页接口
 */
class Donate extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

    /**
     * 首页
     *
     */
    public function donate()
    {
        Log::init(['Donate' => 'File', 'log_name' => 'Donate']);
        $donate_type = $this->request->request('donate_type', 1);
        $exec_times = $this->request->request('exec_times', 2);
        $amount = $this->request->request('amount', 0);
        $phone = $this->request->request('phone', '');
        $donate_name = $this->request->request('donate_name', '');
        $address = $this->request->request('address', '');
        $AccNo = $this->request->request('AccNo', '');
        $memo = $this->request->request('memo', '');


        // Log::notice('donate_type:'. $donate_type);
        // Log::notice('exec_times:'. $exec_times);
        // Log::notice('amount:'. $amount);
        // Log::notice('phone:'. $phone);
        // Log::notice('donate_name:'. $donate_name);
        // Log::notice('address:'. $address);
        // Log::AccNo('address:'. $AccNo);


        // 匯款方式
        if($donate_type == '3'){
            if($address == ''){
                $this->error('[地址]不得為空');
            }
            if($AccNo == ''){
                $this->error('[匯款帳號]不得為空');
            }
        }else{
            if($amount <= 0){
                $this->error('[捐款金額]必須大於0');
            }
        }
                
        
        if($phone == ''){
            $this->error('[手機號碼]不得為空');
        }
        if($donate_name == ''){
            $this->error('[捐款人]不得為空');
        }
        
        
        $order_no = "DT".date('YmdHis');

        $mWebset = model("Webset")->where("`key` = 'donation_project'")->find();
        if($mWebset){
            $donation_project = $mWebset->val;
        }else{
            $donation_project = "尚未設定";
        }
        $params = [
            'order_no' => $order_no,
            'amount' => $amount,
            'donate_type' => $donate_type,
            'phone' => $phone,
            'address' => $address,
            'donate_name' => $donate_name,
            'ATMAccNo' => $AccNo,
            'memo' => $memo,
            'donation_project' => $donation_project,
            'receipt' => 0,
            'status' => 0,
        ];
        
        if($donate_type == 2){
            $params['ExecTimes'] = $exec_times;
            $params['Frequency'] = 1;//週期間隔
            $params['PeriodType'] = 'D';//測試時用天
        }
        model('Donateorder')::create($params);

        
        // 匯款方式
        if($donate_type == '3'){
            $this->success('捐款基本資料已送出，將由專人處理將發票郵寄至填寫地址。 謝謝您的愛心', $order_no);
        }else{
            $this->success('訂單產生, 前往結帳', $order_no);
        }
    }
}
