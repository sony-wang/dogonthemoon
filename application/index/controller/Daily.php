<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use think\Log;

class Daily extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function index()
    {
        return $this->view->fetch();
    }
}
