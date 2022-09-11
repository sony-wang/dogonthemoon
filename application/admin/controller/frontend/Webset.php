<?php

namespace app\admin\controller\frontend;

use app\common\controller\Backend;
use app\common\library\Auth;
use think\Log;
use think\Db;
use think\exception\PDOException;
use think\exception\ValidateException;
use Exception;
use think\Config;

class Webset extends Backend
{

    protected $relationSearch = true;
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('Webset');
    }

    /**
     * 查看
     */
    public function index()
    {

        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                foreach($params as $k=>$v){
                    $m = $this->model->where("`key` ='".$k."' ")->find();
                    if($m){
                        $m->val = $v;
                        $m->save();
                    }
                }
                $this->success();
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $mModel = $this->model->all();
        $this->view->assign("mModel", $mModel);
        return $this->view->fetch();
    }

}
