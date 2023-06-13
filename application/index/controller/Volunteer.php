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
            Log::record('112233');
            Log::record($params);
            if ($params) {
            //     $params = $this->preExcludeFields($params);

            //     if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
            //         $params[$this->dataLimitField] = $this->auth->id;
            //     }


            //     $result = false;
            //     Db::startTrans();
            //     try {
            //         //是否采用模型验证
            //         if ($this->modelValidate) {
            //             $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
            //             $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
            //             $this->model->validateFailException(true)->validate($validate);
            //         }

            //         $params['join_time'] = strtotime($params['join_time']);
            //         $params['birthday'] = strtotime($params['birthday']);

            //         $result = $this->model->allowField(true)->save($params);
            //         Db::commit();
            //     } catch (ValidateException $e) {
            //         Db::rollback();
            //         $this->error($e->getMessage());
            //     } catch (PDOException $e) {
            //         Db::rollback();
            //         $this->error($e->getMessage());
            //     } catch (Exception $e) {
            //         Db::rollback();
            //         $this->error($e->getMessage());
            //     }
            //     if ($result !== false) {
            //         $this->success();
            //     } else {
            //         $this->error(__('No rows were inserted'));
            //     }
            // }
            // $this->error(__('Parameter %s can not be empty', ''));
            }
        }
    }
}
