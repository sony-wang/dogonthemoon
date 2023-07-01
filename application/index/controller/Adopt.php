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
        $mPet = model("Pet")->where("status = 0")->select(); //0=未領養
        if($mPet){
            foreach($mPet as $v){
                $imglist = explode(",", $v->img);
                $v->imgbase = $imglist[0];
            }
        }
        $this->view->assign('mPet', $mPet);
        return $this->view->fetch();
    }

    public function selected($id = 0)
    {
        $mPetAll = model("Pet")->where("status = 0")->select();
        $mPet = model("Pet")->where("status = 0 AND id = ".$id)->find();
        if($mPet){
            $imglist = explode(",", $mPet->img);
            $mPet->imgbase = $imglist[0];
            if($mPet->sex == 0){
                $mPet->sex_str = "母";
            }elseif($mPet->sex == 1){
                $mPet->sex_str = "公";
            }else{
                $mPet->sex_str = "未知";
            }
            $mPet->ligation_str = $mPet->ligation == 1? "Y":"N";
        }
        $this->view->assign('mPet', $mPet);
        $this->view->assign('mPetAll', $mPetAll);
        return $this->view->fetch();
    }
    public function info()
    {
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $id = explode('id/', $actual_link)[1];

        // Log::record($id); 
        $mPet = model("Pet")->where("status = 0 AND id = ".$id)->find();
        // Log::record(parse_url($actual_link));
        Log::record($mPet);

        $this->view->assign('id', $mPet->id);
        $this->view->assign('name', $mPet->name);
        $this->view->assign('img', $mPet->img);
        
        return $this->view->fetch();
    }
    public function done()
    {
        return $this->view->fetch();
    }
}
