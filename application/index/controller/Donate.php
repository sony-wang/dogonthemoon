<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use think\Log;

class Donate extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    // protected $layout = 'base';

    public function index()
    {
        $mWebset = model('Webset')->where("`key` = 'donation_project' ")->find();
        if($mWebset){
            $donation_project = explode(",", $mWebset->val);
        }
        // Log::record($mWebset);
        // Log::record($donation_project[0]);

        $DonetSerchCate = [
            '1' => __('DonetSerchCate 1'), 
            '2' => __('DonetSerchCate 2'),
        ];
        $this->view->assign('donation_project', $donation_project[0]);
        $this->view->assign('DonetSerchCate', $DonetSerchCate);
        return $this->view->fetch();
        
    }

    public function onlinepayment()
    {
        $donate_type_list = [
            '1' => "單筆捐款",
            '2' => "定期捐款",
        ];
        $donate_amount_list = [
            '500' => "500",
            '1000' => "1000",
            '2000' => "2000",
            '3000' => "3000",
            '4000' => "4000",
            '5000' => "5000",
            '0' => "自訂金額",
        ];

        $this->view->assign('donate_type_list', $donate_type_list);
        $this->view->assign('donate_amount_list', $donate_amount_list);
        return $this->view->fetch();
    }
    
    public function orderpage($number = '')
    {
        $mOrder = model('Donateorder')->get(['order_no'=> $number, 'status' => 0]);
        if(!$mOrder){
            $this->error('查無訂單');
        }

        $TradeDesc = "捐款項目:".$mOrder->donation_project;
        $TotalAmount = $mOrder->amount;
        $ItemName = "捐款項目:".$mOrder->donation_project;
        $ReturnURL = $this->site_url['api'].'/notify/donateorder';
        $CheckMacValue = "";
        $ClientBackURL = $this->site_url['furl'].'';
        $OrderResultURL = "";
        $postData = [
            'MerchantID' => $this->ecpay_MerchantID,
            'MerchantTradeNo' => $mOrder->order_no,
            'MerchantTradeDate' => date("Y/m/d H:i:s"),
            'PaymentType' => 'aio',
            'TotalAmount' => $TotalAmount,
            'TradeDesc' => $TradeDesc,
            'ItemName' => $ItemName,
            'ReturnURL' => $ReturnURL,
            'ChoosePayment' => 'ALL',
            'EncryptType' => 1,
            'NeedExtraPaidInfo' => 'Y',
            'ClientBackURL' => $ClientBackURL,
            'OrderResultURL' => $OrderResultURL,
        ];
        
        if($mOrder->donate_type == 2){
            $postData['ChoosePayment'] = 'Credit';
            $postData['PeriodAmount'] = $TotalAmount;
            $postData['PeriodType'] = $mOrder->PeriodType; //間隔單位 
            $postData['Frequency'] = $mOrder->Frequency; //間隔
            $postData['ExecTimes'] = $mOrder->ExecTimes; //次數
            $postData['PeriodReturnURL'] = $this->site_url['api'].'/notify/donateorder_period';
        }

        ksort($postData);
        $signStr = "";
        foreach($postData as $k => $v){
            $signStr .= $k."=".$v."&";
        }
        $signStr = "HashKey=".$this->ecpay_HashKey."&".$signStr."HashIV=".$this->ecpay_HashIV;
        $signStr = strtolower(urlencode($signStr));
        $signStr = toDotNetUrlEncode($signStr);
        $CheckMacValue = strtoupper(hash('sha256', $signStr));
        Log::notice("[".__METHOD__."] CheckMacValue:".$CheckMacValue);

        $szHtml = '<!doctype html>';
        $szHtml .= '<html>';
        $szHtml .= '<head>';
        $szHtml .= '<meta charset="utf-8">';
        $szHtml .= '</head>';
        $szHtml .= '<body>';
        $szHtml .= '<form name="ebpay" id="ebpay" method="post" action="' . $this->ecpay_url . '" style="display:none;">';
        $szHtml .= '<input name="MerchantID" value="' . $postData['MerchantID'] . '" type="hidden">';
        $szHtml .= '<input name="MerchantTradeNo" value="' . $postData['MerchantTradeNo'] . '"   type="hidden">';
        $szHtml .= '<input name="MerchantTradeDate" value="' . $postData['MerchantTradeDate'] . '"   type="hidden">';
        $szHtml .= '<input name="PaymentType" value="' . $postData['PaymentType'] . '" type="hidden">';
        $szHtml .= '<input name="TotalAmount" value="' . $postData['TotalAmount'] . '" type="hidden">';
        $szHtml .= '<input name="TradeDesc" value="' . $postData['TradeDesc'] . '" type="hidden">';
        $szHtml .= '<input name="ItemName" value="' . $postData['ItemName'] . '" type="hidden">';
        $szHtml .= '<input name="ReturnURL" value="' . $postData['ReturnURL'] . '" type="hidden">';
        $szHtml .= '<input name="ChoosePayment" value="' . $postData['ChoosePayment'] . '" type="hidden">';
        $szHtml .= '<input name="EncryptType" value="' . $postData['EncryptType'] . '" type="hidden">';
        $szHtml .= '<input name="NeedExtraPaidInfo" value="' . $postData['NeedExtraPaidInfo'] . '" type="hidden">';
        $szHtml .= '<input name="ClientBackURL" value="' . $postData['ClientBackURL'] . '" type="hidden">';
        $szHtml .= '<input name="OrderResultURL" value="' . $postData['OrderResultURL'] . '" type="hidden">';
        if($mOrder->donate_type == 2){
            $szHtml .= '<input name="PeriodAmount" value="' . $postData['PeriodAmount'] . '" type="hidden">';
            $szHtml .= '<input name="PeriodType" value="' . $postData['PeriodType'] . '" type="hidden">';
            $szHtml .= '<input name="Frequency" value="' . $postData['Frequency'] . '" type="hidden">';
            $szHtml .= '<input name="ExecTimes" value="' . $postData['ExecTimes'] . '" type="hidden">';
            $szHtml .= '<input name="PeriodReturnURL" value="' . $postData['PeriodReturnURL'] . '" type="hidden">';
        }
        $szHtml .= '<input name="CheckMacValue"  value="' . $CheckMacValue . '" type="hidden">';
        $szHtml .= '</form>';
        $szHtml .= '<script type="text/javascript">';
        $szHtml .= 'document.getElementById("ebpay").submit();';
        $szHtml .= '</script>';
        $szHtml .= '</body>';
        $szHtml .= '</html>';

        return $szHtml;
    }

    public function orders()
    {

        $mWebset = model('Webset')->where("`key` = 'donation_project' ")->find();
        if($mWebset){
            $donation_project = explode(",", $mWebset->val);
        }
        Log::record($mWebset);
        Log::record($donation_project[0]);

        $DonetSerchCate = [
            '1' => __('DonetSerchCate 1'), 
            '2' => __('DonetSerchCate 2'),
        ];
        $this->view->assign('donation_project', $donation_project[0]);
        $this->view->assign('DonetSerchCate', $DonetSerchCate);

        return $this->view->fetch();
    }
    public function transfer()
    {
        $mWebset = model('Webset')->where("`key` = 'donation_project' ")->find();
        if($mWebset){
            $donation_project = explode(",", $mWebset->val);
        }
        $this->view->assign('donation_project', $donation_project[0]);
        return $this->view->fetch();
    }
    public function receipt()
    {
        return $this->view->fetch();
    }
    public function credit()
    {
        $creditList = model('Credit')->where("status = 1")->select();
        $this->view->assign('creditList', $creditList);
        return $this->view->fetch();
    }

}
