<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use think\Log;

class Adopt extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function index()
    {
        return $this->view->fetch();
    }

    public function selected()
    {
        return $this->view->fetch();
    }
    public function info()
    {
        return $this->view->fetch();
    }
    public function done()
    {
        return $this->view->fetch();
    }
}
