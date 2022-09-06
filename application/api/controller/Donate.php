<?php

namespace app\api\controller;

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
        $donate_type = $this->request->request('donate_type', 1);
        $exec_times = $this->request->request('exec_times', 2);
        $amount = $this->request->request('amount', 500);
        $phone = $this->request->request('phone', '');
        $donate_name = $this->request->request('donate_name', '');

        if($amount <= 0){
            $this->error('[捐款金額]必須大於0');
        }
        if($phone == ''){
            $this->error('[手機號碼]不得為空');
        }
        if($donate_name == ''){
            $this->error('[捐款人]不得為空');
        }
        
        $order_no = "DT".date('YmdHis');

        $params = [
            'order_no' => $order_no,
            'amount' => $amount,
            'donate_type' => $donate_type,
            'phone' => $phone,
            'donate_name' => $donate_name,
            'ExecTimes' => $exec_times,
            'Frequency' => 1, //週期間隔
            'PeriodType' => 'D', //測試時用天
            'status' => 0,
        ];

        model('Donateorder')::create($params);

        $this->success('訂單產生, 前往結帳', $order_no);
    }
}
