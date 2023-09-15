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

        $this->success('已送出義工報名，我們將有專人與您聯繫。<br>請留意信箱或來電，謝謝您的愛心!');
        
    }
}
