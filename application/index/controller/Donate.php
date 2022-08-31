<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use think\Log;

class Donate extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = 'base';

    public function index()
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

        $TradeDesc = "捐款";
        $TotalAmount = $mOrder->amount;
        $ItemName = "捐款";
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
            'ClientBackURL' => $ClientBackURL,
            'OrderResultURL' => $OrderResultURL,
        ];
        
        ksort($postData);
        $signStr = "";
        foreach($postData as $k => $v){
            $signStr .= $k."=".$v."&";
        }
        $signStr = "HashKey=".$HashKey."&".$signStr."HashIV=".$HashIV;
        $signStr = strtolower(urlencode($signStr));
        $signStr = toDotNetUrlEncode($signStr);
        $CheckMacValue = strtoupper(hash('sha256', $signStr));

        $szHtml = '<!doctype html>';
        $szHtml .= '<html>';
        $szHtml .= '<head>';
        $szHtml .= '<meta charset="utf-8">';
        $szHtml .= '</head>';
        $szHtml .= '<body>';
        $szHtml .= '<form name="ebpay" id="ebpay" method="post" action="' . $url . '" style="display:none;">';
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
        $szHtml .= '<input name="ClientBackURL" value="' . $postData['ClientBackURL'] . '" type="hidden">';
        $szHtml .= '<input name="OrderResultURL" value="' . $postData['OrderResultURL'] . '" type="hidden">';
        $szHtml .= '<input name="CheckMacValue"  value="' . $CheckMacValue . '" type="hidden">';
        $szHtml .= '</form>';
        $szHtml .= '<script type="text/javascript">';
        $szHtml .= 'document.getElementById("ebpay").submit();';
        $szHtml .= '</script>';
        $szHtml .= '</body>';
        $szHtml .= '</html>';

        return $szHtml;
    }
}
