<?php

namespace app\api\controller;
use think\Log;
use app\common\controller\Api;

class Contact extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

    public function add()
    {
        // Log::init(['Donate' => 'File', 'log_name' => 'Donate']);
        $name = $this->request->request('name');
        $email = $this->request->request('email');
        $phone = $this->request->request('phone');
        $content = $this->request->request('content');


        $params = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'content' => $content,
        ];

        model('Contact')::create($params);

        $this->success('已送出成功');
    }
}
