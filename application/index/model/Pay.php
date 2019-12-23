<?php
/**
 * 易优CMS
 * ============================================================================
 * 版权所有 2016-2028 海南赞赞网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.eyoucms.com
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 陈风任 <491085389@qq.com>
 * Date: 2019-2-20
 */
namespace app\index\model;

use think\Model;
use think\Config;
use think\Db;
use think\Request;
/**
 * 会员
 */
class Pay extends Model
{
    private $home_lang = 'cn';
    private $key = ''; // key密钥

    //初始化
    protected function initialize()
    {
        // 需要调用`Model`的`initialize`方法
        parent::initialize();
        $this->home_lang = get_home_lang();
    }

    // 处理充值订单，超过指定时间修改为已取消订单，针对未付款订单
    public function UpdateOrderData($users_id){
        $time  = getTime() - Config::get('global.get_order_validity');
        $where = array(
            'users_id'  => $users_id,
            'status'   => 1,
            'add_time' => array('<',$time),
        );
        $data = [
            'status'        => 4, // 订单取消
            'update_time'   => getTime(),
        ];
        Db::name('users_money')->where($where)->update($data);
    }

    private function GetOpenid()
    {
        //通过code获得openid
        if (!isset($_GET['code'])){
            //触发微信返回code码
            $baseUrl = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
            $url = $this->__CreateOauthUrlForCode($baseUrl);
            Header("Location: $url");
            exit();
        } else {
            //获取code码，以获取openid
            $code = $_GET['code'];
            $openid = $this->getOpenidFromMp($code);
            return $openid;
        }
    }
    /**
     * 
     * 构造获取code的url连接
     * @param string $redirectUrl 微信服务器回跳的url，需要url编码
     * 
     * @return 返回构造好的url
     */
    private function __CreateOauthUrlForCode($redirectUrl)
    {
        $urlObj["appid"] =  $this->appid;
        $urlObj["redirect_uri"] = "$redirectUrl";
        $urlObj["response_type"] = "code";
        $urlObj["scope"] = "snsapi_base";
        $urlObj["state"] = "STATE"."#wechat_redirect";
        $bizString = $this->ToUrlParams($urlObj);
        //dump($bizString);die;
        return "https://open.weixin.qq.com/connect/oauth2/authorize?".$bizString;
    }
    /**
     * 
     * 通过code从工作平台获取openid机器access_token
     * @param string $code 微信跳转回来带上的code
     * 
     * @return openid
     */
    public function GetOpenidFromMp($code)
    {   
      
        $url = $this->__CreateOauthUrlForOpenid($code);
        //初始化curl
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT,30);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        // if(WxPayConfig::CURL_PROXY_HOST != "0.0.0.0" 
        //     && WxPayConfig::CURL_PROXY_PORT != 0){
        //     curl_setopt($ch,CURLOPT_PROXY, WxPayConfig::CURL_PROXY_HOST);
        //     curl_setopt($ch,CURLOPT_PROXYPORT, WxPayConfig::CURL_PROXY_PORT);
        // }
        //运行curl，结果以jason形式返回
        $res = curl_exec($ch);
        curl_close($ch);
        //取出openid
        $data = json_decode($res,true);
        $this->data = $data;
        $openid = $data['openid'];
        return $openid;
    }


    /**
     * 
     * 构造获取open和access_toke的url地址
     * @param string $code，微信跳转带回的code
     * 
     * @return 请求的url
     */
    private function __CreateOauthUrlForOpenid($code)
    {
        $urlObj["appid"] = $this->appid;
        $urlObj["secret"] = $this->appsecret
        $urlObj["code"] = $code;
        $urlObj["grant_type"] = "authorization_code";
        $bizString = $this->ToUrlParams($urlObj);
        return "https://api.weixin.qq.com/sns/oauth2/access_token?".$bizString;
    }
    /**
     * 
     * 拼接签名字符串
     * @param array $urlObj
     * 
     * @return 返回已经拼接好的字符串
     */
    private function ToUrlParams($urlObj)
    {
        $buff = "";
        foreach ($urlObj as $k => $v)
        {
            if($k != "sign"){
                $buff .= $k . "=" . $v . "&";
            }
        }
        
        $buff = trim($buff, "&");
        return $buff;
    }

    /*
     *   微信端H5支付，手机微信直接调起微信支付
     *   @params string $openid : 用户的openid
     *   @params string $out_trade_no : 商户订单号
     *   @params number $total_fee : 订单金额，单位分
     *   return string  $ReturnData : 微信支付所需参数数组
     */
    public function getWechatPay($out_trade_no,$total_fee,$transaction_type,$level,$body="支付",$attach="微信端H5支付")
    {

        // 获取微信配置信息
        $pay_wechat_config = getUsersConfigData('pay.pay_wechat_config');
        if (empty($pay_wechat_config)) {
            return false;
        }
        $wechat = unserialize($pay_wechat_config);
        $this->key = $wechat['key'];
        $this->appid = $wechat['appid'];
        $this->appsecret = $wechat['appsecret'];


        $openid = $this->GetOpenid();
        // dump($openid);die;
        //支付数据
        $data['body']             = $body;
        $data['attach']           = $attach.'_'.$transaction_type.'_'.$level;
        $data['out_trade_no']     = $out_trade_no;
        $data['total_fee']        = $total_fee * 100;
        $data['nonce_str']        = getTime();
        $data['spbill_create_ip'] = $this->get_client_ip();
        $data['appid']            = $wechat['appid'];
        $data['mch_id']           = $wechat['mchid'];
        $data['trade_type']       = "JSAPI";
        $data['notify_url']       = Request::instance()->domain().'/wechat_qrpay_notify';
        $data['openid']           = $openid;

        $sign = $this->getParam($data);
        $dataXML = "<xml>
           <appid>".$data['appid']."</appid>
           <attach>".$data['attach']."</attach>
           <body>".$data['body']."</body>
           <mch_id>".$data['mch_id']."</mch_id>
           <nonce_str>".$data['nonce_str']."</nonce_str>
           <notify_url>".$data['notify_url']."</notify_url>
           <openid>".$data['openid']."</openid>
           <out_trade_no>".$data['out_trade_no']."</out_trade_no>
           <spbill_create_ip>".$data['spbill_create_ip']."</spbill_create_ip>
           <total_fee>".$data['total_fee']."</total_fee>
           <trade_type>".$data['trade_type']."</trade_type>
           <sign>".$sign."</sign>
        </xml>";

        $url    = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $result =  $this->https_post($url,$dataXML);
        $ret    =  $this->xmlToArray($result);
        if($ret['return_code'] == 'SUCCESS' && $ret['return_msg'] == 'OK') {
            $timeStamp  = getTime();
            $ReturnData = [
                'appId'     => $wechat['appid'],
                'timeStamp' => "$timeStamp",
                'nonceStr'  => $this->GetRandomString(12),
                'package'   => 'prepay_id='.$ret['prepay_id'],
                'signType'  => 'MD5',
            ];
            $ReturnSign = $this->getParam($ReturnData);
            $ReturnData['paySign'] = $ReturnSign;
            return $ReturnData;
        }else{
            return false;
        }

    }

    /*
     *   微信H5支付，手机浏览器调起微信支付
     *   @params string $openid : 用户的openid
     *   @params string $out_trade_no : 商户订单号
     *   @params number $total_fee : 订单金额，单位分
     *   return string $mweb_url : 二维码URL链接
     */
    public function getMobilePay($out_trade_no,$total_fee,$transaction_type,$level,$body="支付",$attach="手机浏览器微信H5支付")
    {

        // 获取微信配置信息
        $pay_wechat_config = getUsersConfigData('pay.pay_wechat_config');
        if (empty($pay_wechat_config)) {
            return false;
        }
        $wechat = unserialize($pay_wechat_config);
        $this->key = $wechat['key'];

        //支付数据
        $data['out_trade_no']     = $out_trade_no;
        $data['total_fee']        = $total_fee * 100;
        $data['spbill_create_ip'] = $this->get_client_ip();
        $data['attach']           = $attach.'_'.$transaction_type.'_'.$level;
        $data['body']             = $body;
        $data['appid']            = $wechat['appid'];
        $data['mch_id']           = $wechat['mchid'];
        $data['nonce_str']        = getTime();
        $data['trade_type']       = "MWEB";
        $data['scene_info']       = '{"h5_info":{"type":"Wap","wap_url":'.Request::instance()->domain().'/wechat_qrpay_notify,"wap_name":"支付"}}';
        $data['notify_url']       = Request::instance()->domain().'/wechat_qrpay_notify';

        $sign = $this->getParam($data);
        $dataXML = "<xml>
           <appid>".$data['appid']."</appid>
           <attach>".$data['attach']."</attach>
           <body>".$data['body']."</body>
           <mch_id>".$data['mch_id']."</mch_id>
           <nonce_str>".$data['nonce_str']."</nonce_str>
           <notify_url>".$data['notify_url']."</notify_url>
           <out_trade_no>".$data['out_trade_no']."</out_trade_no>
           <scene_info>".$data['scene_info']."</scene_info>
           <spbill_create_ip>".$data['spbill_create_ip']."</spbill_create_ip>
           <total_fee>".$data['total_fee']."</total_fee>
           <trade_type>".$data['trade_type']."</trade_type>
           <sign>".$sign."</sign>
        </xml>";

        $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $result =  $this->https_post($url,$dataXML);
        $ret = $this->xmlToArray($result);

        Db::name('linshi')->insert(['info'=>json_encode($ret),'time'=>date('Y-m-d H:i:s')]);
        if($ret['return_code'] == 'SUCCESS' && $ret['return_msg'] == 'OK') {
            if (!empty($ret['err_code'])) {
                return $ret['err_code_des'];
            }
            header('Location:'.$ret['mweb_url']);

        } else {
        	echo '<script>alert("'.$ret['return_msg'].'");window.history.back(-1);</script>';exit;
            //return $ret;
        }
    }

    /*
     *   微信二维码支付
     *   @params string $openid : 用户的openid
     *   @params string $out_trade_no : 商户订单号
     *   @params number $total_fee : 订单金额，单位分
     *   return string $code_url : 二维码URL链接
     */
    public function payForQrcode($out_trade_no,$total_fee,$transaction_type,$level,$body="支付",$attach="微信扫码支付")
    {
        // 获取微信配置信息
        $pay_wechat_config = getUsersConfigData('pay.pay_wechat_config');
        if (empty($pay_wechat_config)) {
            return false;
        }
        $wechat = unserialize($pay_wechat_config);
        $this->key = $wechat['key'];

        //支付数据
        $data['out_trade_no']     = $out_trade_no;
        $data['total_fee']        = $total_fee * 100;
        $data['spbill_create_ip'] = $this->get_client_ip();
        $data['attach']           = $attach.'_'.$transaction_type.'_'.$level;
        $data['body']             = $body;
        $data['appid']            = $wechat['appid'];
        $data['mch_id']           = $wechat['mchid'];
        $data['nonce_str']        = getTime();
        $data['trade_type']       = "NATIVE";
        $data['notify_url']       = Request::instance()->domain().'/wechat_qrpay_notify';

        $sign = $this->getParam($data);
     
        $dataXML = "<xml>
           <appid>".$data['appid']."</appid>
           <attach>".$data['attach']."</attach>
           <body>".$data['body']."</body>
           <mch_id>".$data['mch_id']."</mch_id>
           <nonce_str>".$data['nonce_str']."</nonce_str>
           <notify_url>".$data['notify_url']."</notify_url>
           <out_trade_no>".$data['out_trade_no']."</out_trade_no>
           <spbill_create_ip>".$data['spbill_create_ip']."</spbill_create_ip>
           <total_fee>".$data['total_fee']."</total_fee>
           <trade_type>".$data['trade_type']."</trade_type>
           <sign>".$sign."</sign>
        </xml>";
       // dump($data);die;
        $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $result =  $this->https_post($url,$dataXML);
        $ret = $this->xmlToArray($result);
        Db::name('linshi')->insert(['info'=>json_encode($ret),'time'=>date('YmdHis')]);
        if($ret['return_code'] == 'SUCCESS' && $ret['return_msg'] == 'OK') {
            return $ret;
        } else {
            return $ret;
        }
    }

    // 获取客户端IP
    private function get_client_ip() {
        //获取ip
    $ip=false;
    if(!empty($_SERVER["HTTP_CLIENT_IP"])){
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
        if ($ip) { 
            array_unshift($ips, $ip); $ip = FALSE; 
        }
        for ($i = 0; $i < count($ips); $i++) {
            if (!preg_match ("/^(10│172.16│192.168)./", $ips[$i])) {
                $ip = $ips[$i];
                break;
            }
        }
    }
    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
    }

    //对参数排序，生成MD5加密签名
    private function getParam($paramArray, $isencode=false)
    {
        $paramStr = '';
        ksort($paramArray);
        $i = 0;

        foreach ($paramArray as $key => $value)
        {
            if ($key == 'Signature'){
                continue;
            }
            if ($i == 0){
                $paramStr .= '';
            }else{
                $paramStr .= '&';
            }
            $paramStr .= $key . '=' . ($isencode ? urlencode($value) : $value);
            ++$i;
        }

        $stringSignTemp=$paramStr."&key=".$this->key;
        $sign=strtoupper(md5($stringSignTemp));
        return $sign;

    }

    //POST提交数据
    private function https_post($url,$data)
    {
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
        // curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, 1 );
        curl_setopt ( $ch, CURLOPT_AUTOREFERER, 1 );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return 'Errno: '.curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }

    /*
    * XML转array
    * @params xml $xml : xml 数据
    * return array $data : 转义后的array数组
    */
    private function xmlToArray($xml)
    {
        libxml_disable_entity_loader(true);
        $xmlstring = (array)simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $val = json_decode(json_encode($xmlstring),true);
        return $val;
    }

    //支付宝官方H5支付
    public function alipay_wap($data){

        header("Content-type: text/html; charset=utf-8");

        vendor('alipay.pagepay.service.AlipayTradeService');
        require_once dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'alipaywap/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php';

        $pay_alipay_config = getUsersConfigData('pay.pay_alipay_config');
        // dump($pay_alipay_config);die;
        if (empty($pay_alipay_config)) {
            return false;
        }

        $alipay = unserialize($pay_alipay_config);
        unset($data['accept_time']);
        unset($data['id']);
        $type = $data['transaction_type'];
        $level = $data['level'];
       
        $config = array (
        //应用ID,您的APPID。
        'app_id' => $alipay['app_id'],
        //商户私钥
        'merchant_private_key' => $alipay['merchant_private_key'],
        //异步通知地址
        'notify_url' => url('index/Pay/alipay_return', ['transaction_type'=>$type,'is_ailpay_notify'=>2,'level'=>$level], true, true),
        //同步跳转
        'return_url' => url('index/Pay/alipay_return', ['transaction_type'=>$type,'is_ailpay_notify'=>2,'level'=>$level], true, true),
        //编码格式
        'charset' => "UTF-8",
        //签名方式
        'sign_type'=>"RSA2",
        //支付宝网关
        'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
        'alipay_public_key' => $alipay['alipay_public_key']
    );
       
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = $data['order_code'];
        //订单名称，必填
        $subject = '订单支付';
        //付款金额，必填
        $total_amount = $data['order_total_amount'];
        //商品描述，可空
        $body = '支付宝支付';
        $timeout_express="1m";
        $payRequestBuilder = new AlipayTradeWapPayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setOutTradeNo($out_trade_no);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setTimeExpress($timeout_express);
        // dump($payRequestBuilder);die;
        $payResponse = new \AlipayTradeService($config);
        $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);
    }
    /*
     *   支付宝新版支付，生成支付链接方法。
     *   @params string $data   : 订单表数据，必须传入
     *   return string $alipay_url : 支付宝支付链接
     */
    public function getNewAliPayPayUrl($data){
        // 引入SDK文件

        vendor('alipay.pagepay.service.AlipayTradeService');

        vendor('alipay.pagepay.buildermodel.AlipayTradePagePayContentBuilder');
        // 获取支付宝配置信息
        $pay_alipay_config = getUsersConfigData('pay.pay_alipay_config');
        if (empty($pay_alipay_config)) {
            return false;
        }
        $alipay = unserialize($pay_alipay_config);
        $type = $data['transaction_type'];
        // 参数拼装
        $config['app_id'] = $alipay['app_id'];
        $config['merchant_private_key'] = $alipay['merchant_private_key'];
        $config['transaction_type'] = $type;
        $level = $data['level'];
        // 异步地址
        $notify_url = url('index/Pay/alipay_return', ['transaction_type'=>$type,'is_ailpay_notify'=>1,'level'=>$level], true, true);
        $config['notify_url'] = $notify_url;

        // 同步地址
        $return_url = url('index/Pay/alipay_return', ['transaction_type'=>$type,'is_ailpay_notify'=>2,'level'=>$level], true, true);
        $config['return_url'] = $return_url;

        $config['charset']    = 'UTF-8';
        $config['sign_type']  = 'RSA2';
        $config['gatewayUrl'] = 'https://openapi.alipay.com/gateway.do';
        $config['alipay_public_key'] = $alipay['alipay_public_key'];
       
        // 实例化
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder;
        $aop               = new \AlipayTradeService($config);

        $out_trade_no = trim($data['order_code']);//商户订单号，商户网站订单系统中唯一订单号，必填
        $subject      = trim('订单支付');//订单名称，必填
        $total_amount = trim($data['order_total_amount']);//付款金额，必填
        $body         = trim('支付宝支付');//商品描述，可空
        //构造参数
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);
        // dump($payRequestBuilder);
        //  dump($data);
        // dump($config);die;
        // 调用SDK进行支付宝支付
        $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);
    }

    /*
     *   支付宝旧版支付，生成支付链接方法。
     *   @params string $data   : 订单表数据，必须传入
     *   @params string $alipay : 支付宝配置信息，通过 getUsersConfigData 方法调用数据
     *   return string $alipay_url : 支付宝支付链接
     */
    public function getOldAliPayPayUrl($data,$alipay){
        // 重要参数，支付宝配置信息
        if (empty($alipay)) {
            return false;
        }
        
        // 参数设置
        $order['out_trade_no'] = $data['unified_number']; //订单号
        $order['price']        = $data['unified_amount']; //订单金额
        $charset               = 'utf-8';  //编码格式
        $real_method           = '2';      //调用方式
        $agent                 = 'C4335994340215837114'; //代理机构
        $seller_email          = $alipay['account'];//支付宝用户账号
        $security_check_code   = $alipay['code'];   //交易安全校验码
        $partner               = $alipay['id'];     //合作者身份ID

        switch ($real_method){
            case '0':
                $service = 'trade_create_by_buyer';
                break;
            case '1':
                $service = 'create_partner_trade_by_buyer';
                break;
            case '2':
                $service = 'create_direct_pay_by_user';
                break;
        }

        $type       = $data['transaction_type']; //自定义，用于验证
        // 异步地址
        $notify_url = request()->domain().'/index.php?transaction_type='.$type.'&is_ailpay_notify=1';
        // 同步地址
        $return_url = url('user/Pay/alipay_return', ['transaction_type'=>$type,'is_ailpay_notify'=>2], true, true);
        // 参数拼装
        $parameter = array(
          'agent'             => $agent,
          'service'           => $service,
          //合作者ID
          'partner'           => $partner,
          '_input_charset'    => $charset,
          'notify_url'        => $notify_url,
          'return_url'        => $return_url,
          /* 业务参数 */
          'subject'           => "支付订单号:".$order['out_trade_no'],
          'out_trade_no'      => $order['out_trade_no'],
          'price'             => $order['price'],
          'quantity'          => 1,
          'payment_type'      => 1,
          /* 物流参数 */
          'logistics_type'    => 'EXPRESS',
          'logistics_fee'     => 0,
          'logistics_payment' => 'BUYER_PAY_AFTER_RECEIVE',
          /* 买卖双方信息 */
          'seller_email'      => $seller_email,
        );

        ksort($parameter);
        reset($parameter);
        $param = '';
        $sign  = '';

        foreach ($parameter AS $key => $val)
        {
            $param .= "$key=" .urlencode($val). "&";
            $sign  .= "$key=$val&";
        }
        
        $param = substr($param, 0, -1);
        $sign  = substr($sign, 0, -1). $security_check_code;
        $alipay_url = 'https://www.alipay.com/cooperate/gateway.do?'.$param. '&sign='.MD5($sign).'&sign_type=MD5';
        return $alipay_url;
    }



    // 获取随机字符串
    // 长度 length
    // 结果 str
    public function GetRandomString($length){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str   = "";
        for ($i = 0; $i < $length; $i++) {
          $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
}