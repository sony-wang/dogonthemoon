<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Log;
use think\Db;
use think\exception\PDOException;
use think\exception\ValidateException;
use Exception;

/**
 * 接收回調接口
 */
class Notify extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        Log::init(['type' => 'File', 'log_name' => 'Notify']);
    }

    public function donateorder()
    {
        $post = $this->request->post();
        Log::notice("[".__METHOD__."]".json_encode($post));
        $r = false;

        if (isset($post['MerchantID']) && $post['MerchantID'] == $this->ecpay_MerchantID) {

            $postData = $post;
            unset($postData['CheckMacValue']);
            ksort($postData);
            $signStr = "";
            foreach($postData as $k => $v){
                $signStr .= $k."=".$v."&";
            }
            $signStr = "HashKey=".$this->ecpay_HashKey."&".$signStr."HashIV=".$this->ecpay_HashIV;
            $signStr = strtolower(urlencode($signStr));
            $signStr = toDotNetUrlEncode($signStr);
            $CheckMacValue = strtoupper(hash('sha256', $signStr));

            if($post['CheckMacValue'] == $CheckMacValue){
                $mDonateorder = model('Donateorder')->get(['order_no' => $post['MerchantTradeNo']]);
                if($mDonateorder){
                    if($post['TradeAmt'] == $mDonateorder->amount){
                        try {
                            if($post['RtnCode'] == 1){
                                $status = 1;
                            }else{
                                $status = 2;
                            }
                            $params = [
                                'trans_order_no' => $post['TradeNo']??"",
                                'RtnCode' => $post['RtnCode']??null,
                                'RtnMsg' => $post['RtnMsg']??"",
                                'SimulatePaid' => $post['SimulatePaid']??null,
                                'PaymentDate' => $post['PaymentDate']??"",
                                'PaymentDate_strtotime' => strtotime($post['PaymentDate'])??null,
                                'PaymentType' => $post['PaymentType']??"",
                                'CheckMacValue' => $post['CheckMacValue']??"",
                                'result' => json_encode($post),
                                'status' => $status
                            ];
                            Log::notice("[".__METHOD__."] params:". json_encode($params));
                            $r = $mDonateorder->allowField(true)->save($params);
                        } catch (ValidateException $e) {
                            Log::notice("[".__METHOD__."] ValidateException :".$e->getMessage());
                        } catch (PDOException $e) {
                            Log::notice("[".__METHOD__."] PDOException :".$e->getMessage());
                        } catch (Exception $e) {
                            Log::notice("[".__METHOD__."] Exception :".$e->getMessage());
                        }
                    }else{
                        Log::notice("[".__METHOD__."] 金額不符: ".$post['TradeAmt']);
                    }
                }else{
                    Log::notice("[".__METHOD__."] 訂單不存在 : order_no:".$Result['MerchantTradeNo']);
                }
            }else{
                Log::notice("[".__METHOD__."] 檢查碼不符 CheckMacValue:".$CheckMacValue." | post CheckMacValue:".$post['CheckMacValue']);
            }
        }else{
            Log::notice("[".__METHOD__."] MerchantID 錯誤: ".$post['MerchantID']??"-");
        }
        
        if ($r !== false) {
            Log::notice("[".__METHOD__."] 回調成功");
            return "1|OK";
        }else{
            Log::notice("[".__METHOD__."] 回調失敗");
            return "回調失敗";
        }
    }
    
    public function donateorder_period()
    {
        $post = $this->request->post();
        Log::notice("[".__METHOD__."]".json_encode($post));
    }
}
