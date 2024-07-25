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
        // $currentURL = "http";
        // if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        // $currentURL .= "s";
        // $currentURL .= "://";
        // $currentURL .= $_SERVER['HTTP_HOST'];
        // $currentURL .= $_SERVER['REQUEST_URI'];
        // $currentURL .= "index/index/underconstruction/";

        // $key = request()->param('key', null, 'trim,strip_tags,htmlspecialchars');
        // Log::record($key);
        // if($key !== 'dog'){
        //     header("Location:$currentURL");
        //     // header("Location: https://google.com.tw");
        //     die();
        // }

        $bannerList = [];
        $mWebset = model("Webset")->where("`key` = 'banner' ")->find();
        if($mWebset){
            $bannerList = explode(",", $mWebset->val);
        }
        $this->view->assign('bannerList', $bannerList);
        return $this->view->fetch();
    }

    public function underconstruction()
    {
        $bannerList = [];
        $mWebset = model("Webset")->where("`key` = 'banner' ")->find();
        if($mWebset){
            $bannerList = explode(",", $mWebset->val);
        }
        $this->view->assign('bannerList', $bannerList);
        return $this->view->fetch();
        return $this->view->fetch();
    }
}
