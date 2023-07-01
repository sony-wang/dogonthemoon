<?php

namespace app\api\controller;
use think\Log;
use app\common\controller\Api;

class Adopt extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

    public function add()
    {
        // Log::init(['Donate' => 'File', 'log_name' => 'Donate']);
        $name = $this->request->request('name');
        $family = $this->request->request('family');
        $room = $this->request->request('room');
        $hadpet = $this->request->request('hadpet');
        $email = $this->request->request('email');
        $phone = $this->request->request('phone');
        $img = $this->request->request('img');


        $params = [
            'name' => $name,
            'family' => $family,
            'room' => $room,
            'hadpet' => $hadpet,
            'email' => $email,
            'phone' => $phone,
            'img' => $img,
        ];

        model('Adopt')::create($params);

        $this->success('已送出成功');
    }
}
