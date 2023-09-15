<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use think\Db;
use think\Log;

class Volunteer extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function index()
    {
        return $this->view->fetch();
    }

    public function add()
    {
        if ($this->request->isPost()) {
            $params = $this->request->post("b/a");
            if ($params) {}
        }
    }
}
