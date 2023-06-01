<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use think\Log;

class Index extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function index()
    {
        $bannerList = [];
        $mWebset = model("Webset")->where("`key` = 'banner' ")->find();
        if($mWebset){
            $bannerList = explode(",", $mWebset->val);
        }
        $this->view->assign('bannerList', $bannerList);
        return $this->view->fetch();
    }
}
