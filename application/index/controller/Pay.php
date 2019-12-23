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
 * Date: 2019-2-25
 */

namespace app\index\controller;

use think\Db;
// use think\Session;
use think\Config;
use think\Page;
use app\index\logic\PayLogic;
use think\Controller;

class Pay extends Controller
{
    public $php_version = '';
    public $users_id;
    public function _initialize() {
        parent::_initialize();
        $this->users_db       = Db::name('users');      // 会员数据表
        $this->users_money_db = Db::name('users_money');// 会员金额明细表
        $this->shop_order_db = Db::name('shop_order'); // 订单主表
        $this->shop_order_details_db = Db::name('shop_order_details'); // 订单明细表
        if(session('users_info')){
           $this->users_id = session('users_info')['users_id']; 
       }
        
        
        // 支付功能是否开启
        $redirect_url = '';
        $pay_open = getUsersConfigData('pay.pay_open');
        $web_users_switch = tpCache('web.web_users_switch');
        if (empty($pay_open)) { 
            // 支付功能关闭，立马跳到会员中心
            $redirect_url = url('/member');
            $msg = '支付功能尚未开启！';
            $this->error($msg, $redirect_url);
        }
    }

    //发起订单
    public function paycourse(){


        $data = input();
        $url = input('callback');
        $orderid = input('orderid');

        $sign = get_sign($url.$orderid);
        //dump($data);
        //dump($sign);die;
        if($sign != input('token')){
            $this->redirect('/');die;
        } 

        //查询订单信息
        $order['order_info'] = Db::table('hw_shop_order')
            ->alias('s')
            ->field('s.order_code,s.order_total_amount,hs.prom_type,hs.litpic,hs.product_id,hs.single_cou_id,hs.product_name,hs.add_time')
            ->join('hw_shop_order_details hs','hs.order_id = s.order_id')
            ->where('s.order_code',$orderid)
            ->find();
        if($order['order_info']['add_time']+24*60*60 < time()){
            echo '<script>alert("订单已超时,请重新下单");window.history.go(-1);</script>';die;
        }
        //查询课程信息
        $order['course'] = Db::table('hw_download_content')
            ->field('hours,lecturer')
            ->where('aid',$order['order_info']['product_id'])
            ->limit(1)
            ->find();
        // dump($order);

        $order['pay_wechat_config'] = unserialize(getUsersConfigData('pay.pay_wechat_config'));

        $order['pay_alipay_config'] = unserialize(getUsersConfigData('pay.pay_alipay_config'));
        $token = get_sign($orderid);
        $this->assign('token',$token);

        $this->assign('order',$order);
        if(isMobile()){
            return $this->fetch('mpaycourse');exit;
        }
        return $this->fetch();
         
    }

    public function activation(){

        if(!session('activation_id')){
            $this->redirect('/login?tab=1');
        }
        $users_id = session('activation_id');
        $user_moneyModel = Db::name('users_money');
        $money = Db::table('hw_users_type_manage')
            ->where('level_id',1)
            ->limit(1)
            ->value('price');
        $user_money = cookie('user_money'.$users_id);

        if(empty($user_money)){
            $addData = [
                'users_id'=>$users_id,
                'money'=>$money,
                'cause'=>'激活会员',
                'cause_type'=>0,
                'order_number'=>date('YmdHis').time().mt_rand(100,1000),
                'add_time'=>time(),
            ];
            $id = $user_moneyModel->insertGetId($addData);
            $user_money = $user_moneyModel->where('moneyid',$id)->limit(1)->find();
            cookie('user_money'.$users_id,$user_money,20);
        }
        $user_money['level'] = 1;
        $user_money['pay_wechat_config'] = unserialize(getUsersConfigData('pay.pay_wechat_config'));
        $user_money['pay_alipay_config'] = unserialize(getUsersConfigData('pay.pay_alipay_config'));

        $token = get_sign($user_money['order_number']);
        $this->assign('token',$token);
        $this->assign('user_money',$user_money);
        if(isMobile()){
            return $this->fetch('mactivation');exit;
        }

        return $this->fetch();

    }

//会员升级
    public function mem_activation(){


        $order_code = input('order_code');
        $user_moneyModel = Db::name('users_money');
        $user_money = $user_moneyModel->where('order_number',$order_code)->limit(1)->find();

    
        $user_money['pay_wechat_config'] = unserialize(getUsersConfigData('pay.pay_wechat_config'));

        $user_money['pay_alipay_config'] = unserialize(getUsersConfigData('pay.pay_alipay_config'));

        $user_money['level'] = input('level');
        $token = get_sign($user_money['order_number']);

        $this->assign('token',$token);
        $this->assign('user_money',$user_money);
        if(isMobile()){
            return $this->fetch('mactivation');exit;
        }

        return $this->fetch('activation');

    }

//生成会员升级订单
    public function mem_level_order(){
        $data = input();
        $result = $this->validate($data,
            [   
                'level|等级'  => 'require|token',
            ]);
        if(true !== $result){
            // 验证失败 输出错误信息
            return ['code'=>3,'msg'=>$result,'token'=>get_token()];
        }
        $users_id = $this->users_id;
        $user_moneyModel = Db::name('users_money');
        if($data['level'] == 5){

            //查询已经开通的会员
            $view_rights = DB::name('users')
                ->where('users_id',$this->users_id)
                ->limit(1)
                ->value('view_rights');


            $level5money = Db::table('hw_users_type_manage')
                ->where('level_id','in',$view_rights)
                ->where('level_id','<>',1)
                ->select();
            $money =Db::table('hw_users_type_manage')
                ->where('level_id',$data['level'])
                ->limit(1)
                ->find();
            $levelOtherMoney = 0;
            foreach ($level5money as $k => $v) {
                $levelOtherMoney += $v['price'];
            }

            $money['price'] = $money['price']-$levelOtherMoney;

        }else{
            $money = Db::table('hw_users_type_manage')
                ->where('level_id',$data['level'])
                ->limit(1)
                ->find();
        }

        $addData = [
            'users_id'=>$users_id,
            'money'=>$money['price'],
            'cause'=>$money['type_name'],
            'cause_type'=>0,
            'order_number'=>date('YmdHis').time().mt_rand(100,1000),
            'add_time'=>time(),
        ];
        $id = $user_moneyModel->insert($addData);

        
        if($id){
            return ['code'=>1,'msg'=>'前往支付','data'=>$addData['order_number']];
        }else{
            return ['code'=>3,'msg'=>'生成订单失败，请稍候再试','token'=>get_token()];
        }

    }




    // 选择付款方式，目前用于微信，支付宝方式已直接调用链接
    public function pay_method()
    {
        // 付款方式，跳转至微信支付还是支付宝支付。
        // $pay_method = input('param.pay_method/s');
        // 订单交易类型
        $transaction_type = input('param.transaction_type/s');
        // 订单号
        $unified_number   = input('param.unified_number/s');
        // 订单ID
        $unified_id       = input('param.unified_id/d');

        // 升级会员支付
        $level_pay = input('get.level_pay/d');
        $WeChatUrl = '';
        if (isset($level_pay) && !empty($level_pay)) {
           // 生成回调URL
            $WeChatUrl = url('user/Level/wechat_order_inquiry',['_ajax'=>1]);
        }
        $this->assign('WeChatUrl',$WeChatUrl);
        $this->assign('unified_number',$unified_number);
        $this->assign('transaction_type',$transaction_type);

        // 执行跳转
        return $this->fetch('users/pay_wechat');
    }

    // 微信支付，获取订单信息并调用微信接口，生成二维码用于扫码支付
    public function pay_wechat_png(){

        $token = input('token');
        $orderid = input('order_code');
        $transaction_type = input('transaction_type');
        $level = input('level');
        if($token != get_sign($orderid)){
            $this->redirect('/');die;
        }

        $users_id = $this->users_id;

        if (empty($users_id)) {
            $users_id = session('activation_id');
            if(empty($users_id)){
                $this->redirect('/');die;
            }
        }

            //会员升级
            if($transaction_type == 1){
                $where  = array(
                    'users_id'   => $users_id,
                    'order_number' => $orderid,
                );
                $data = $this->users_money_db->where($where)->find();
                $data['order_code'] = $data['order_number'];
                $data['order_total_amount'] = $data['money'];
                //dump($where);die;
            }elseif($transaction_type == 2){
                //购买视频

                 $where  = array(
                    'users_id'   => $users_id,
                    'order_code' => $orderid,
                );
               
                $data  = $this->shop_order_db->where($where)->find();

                $out_trade_no = $data['order_code'];
                $total_fee    = $data['order_total_amount'];

            }

            $img = session('s'.$data['order_code']);
            if(empty($img)){
                $payUrl = model('Pay')->payForQrcode($data['order_code'],$data['order_total_amount'],$transaction_type,$level);// PC调用
                // 生成二维码加载在页面上
                if($payUrl['return_code'] == 'SUCCESS'){
                    vendor('wechatpay.phpqrcode.phpqrcode');
                    $qrcode = new \QRcode;
                    $pngurl = $payUrl['code_url'];
                    // $pngurl = 'http://www.baidu.com';
                    ob_start();
                    $qrcode->png($pngurl);
                    $img = ob_get_contents();//获取缓冲区内容
                    ob_end_clean();//清除缓冲区内容
                    $imgstr = 'data:png;base64,' . chunk_split(base64_encode($img));//转base64
                    session('s'.$data['order_code'],$imgstr);

                    // return $imgstr;die;
                    // dump($png);
                    return ['code'=>'0000','data'=>$imgstr,'num'=>1];
                    
                    }else{
                        return ['code'=>'3333'];
                    }
                }else{

                    return ['code'=>'0000','data'=>$img,'num'=>2];
                
                }
            exit();
            //dump($data);die;
            // 调取微信支付链接

    }

    public function pay_status(){
        $order_code = input('order_code');
        $transaction_type = input('transaction_type');
        if($transaction_type == 2){
            $order_status = Db::name('shop_order')
                ->where('order_code',$order_code)
                ->limit(1)
                ->value('order_status');
            if($order_status == 1){
                return ['code'=>1];
            }

        }elseif($transaction_type == 1){
            $order_status = Db::name('users_money')
                ->where('order_number',$order_code)
                ->limit(1)
                ->value('status');
            if($order_status == 2){
                return ['code'=>1];
            }
        }

        return ['code'=>2];
    }


    //微信扫码支付回调

  public function wechat_qrpay_notify(){

        
        $xml = file_get_contents("php://input");
        //将服务器返回的XML数据转化为数组 
        //$data = json_decode(json_encode(simplexml_load_string($xml,'SimpleXMLElement',LIBXML_NOCDATA)),true); 
        $data = $this->xmlToArray($xml); 
        // $data = input();
         // 保存微信服务器返回的签名sign 
         $data_sign = $data['sign']; 

         // sign不参与签名算法 
         unset($data['sign']); 
         $sign = $this->makeSign($data);

         // 判断签名是否正确 判断支付状态
         if (($sign===$data_sign) && ($data['return_code']=='SUCCESS') && ($data['result_code']=='SUCCESS') ) { 
                $result = $data; 

                Db::name('linshi')->insert(['info'=>json_encode($result),'time'=>'1_'.date('Y-m-d H:i:s')]);
                $pay_logic = new PayLogic();
      
                $result    = $pay_logic->wechat_return($data);
                Db::name('linshi')->insert(['info'=>json_encode($result),'time'=>'2_'.date('Y-m-d H:i:s')]);
                if ($result != 'success') {
                    $result = false; 
                }
         }else{ 
          $result = false; 
          
         } 
         // 返回状态给微信服务器 
         if ($result) { 
          $str='<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>'; 
         }else{ 
          $str='<xml><return_code><![CDATA[FAIL]]></return_code><return_msg><![CDATA[签名失败]]></return_msg></xml>'; 
         } 
   // Db::name('linshi')->insert(['info'=>$str,'time'=>'end_'.date('Y-m-d H:i:s')]);
     echo $str;exit;
     return $result; 
    }
    public function xmlToArray($xml)
    {    
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);        
        return $values;
    }
    protected function makeSign($data){ 
       //获取微信支付秘钥
        vendor('wechatpay.lib.WxPayApi');
        vendor('wechatpay.lib.WxPayConfig');

        // 处理微信配置数据
        $pay_wechat_config = getUsersConfigData('pay.pay_wechat_config');
        $pay_wechat_config = unserialize($pay_wechat_config);
        $config_data['app_id'] = $pay_wechat_config['appid'];
        $config_data['mch_id'] = $pay_wechat_config['mchid'];
        $config_data['key']    = $pay_wechat_config['key'];
        Db::name('linshi')->insert(['info'=>json_encode($config_data),'time'=>'2_'.date('Y-m-d H:i:s')]);
    // 去空
       $data=array_filter($data); 
       //签名步骤一：按字典序排序参数
       ksort($data); 
       $string_a=http_build_query($data);
       $string_a=urldecode($string_a); 
       //签名步骤二：在string后加入KEY 
       //$config=$this->config;;
       $string_sign_temp=$string_a."&key=".$config_data['key']; 
       //签名步骤三：MD5加密 
       $sign = md5($string_sign_temp);;
       // 签名步骤四：所有字符转为大写 
       $result=strtoupper($sign); 
       return $result; 
  }

   
    // 微信支付成功后跳转到此页面
    public function pay_success(){
        if ('1' == input('param.transaction_type')) {
            $url = urldecode(url('user/Pay/pay_consumer_details'));
        }else if ('2' == input('param.transaction_type')) {
            $url = urldecode(url('user/Shop/shop_centre'));
        }
        $this->assign('url',$url);
        return $this->fetch('users/pay_success');
    }

    // 新版支付宝支付
    public function new_alipay_pay_url(){

        $token = input('token');
        $orderid = input('order_code');
        $transaction_type = input('transaction_type');
        $level = input('level');

        if($token != get_sign($orderid)){
            $this->redirect('/');die;
        }

        $users_id = $this->users_id;

        if (empty($users_id)) {
            $users_id = session('activation_id');
            if(empty($users_id)){
                $this->redirect('/');die;
            }
        }

        //会员升级
        if($transaction_type == 1){
            $where  = array(
                'users_id'   => $users_id,
                'order_number' => $orderid,
            );
            $data = $this->users_money_db->where($where)->find();
            $data['order_code'] = $data['order_number'];
            $data['order_total_amount'] = $data['money'];
          
        }elseif($transaction_type == 2){
            //购买视频

             $where  = array(
                'users_id'   => $users_id,
                'order_code' => $orderid,
            );
           
            $data  = $this->shop_order_db->where($where)->find();


            $out_trade_no = $data['order_code'];
            $total_fee    = $data['order_total_amount'];

        }
        
        $data['level'] = $level;
        $data['transaction_type'] = $transaction_type;
        //$data['order_total_amount'] = 0.01;
        if(isMobile()){

            model('Pay')->alipay_wap($data);

        }else{
            // 调用新版支付宝支付方法
            model('Pay')->getNewAliPayPayUrl($data);
        }

        
    }

    // 支付宝回调接口，处理订单数据
    public function alipay_return(){
        // 跳转处理回调信息
        $pay_logic = new PayLogic();
      
        $result    = $pay_logic->alipay_return();
        if (1 == $result['code']) {
            $this->redirect($result['url']);
        }else{
            $this->error($result['msg']);
        }
    }

    // 手机微信端H5支付
    public function h5_wechat_pay()
    {
       
        $token = input('token');
        $orderid = input('order_code');
        $transaction_type = input('transaction_type');
        $level = input('level');

        if($token != get_sign($orderid)){
            $this->redirect('/');die;
        }

        $users_id = $this->users_id;

        if (empty($users_id)) {
            $users_id = session('activation_id');
            if(empty($users_id)){
                $this->redirect('/');die;
            }
        }
        //会员升级
        if($transaction_type == 1){
            $where  = array(
                'users_id'   => $users_id,
                'order_number' => $orderid,
            );
            $data = $this->users_money_db->where($where)->find();
            $data['order_code'] = $data['order_number'];
            $data['order_total_amount'] = $data['money'];
            //dump($where);die;
        }elseif($transaction_type == 2){
            //购买视频

             $where  = array(
                'users_id'   => $users_id,
                'order_code' => $orderid,
            );
           
            $data  = $this->shop_order_db->where($where)->find();

            $out_trade_no = $data['order_code'];
            $total_fee    = $data['order_total_amount'];

        }
      
        $data['transaction_type'] = $transaction_type;
     
        if(isWeixin()){
            //$this->error('手机端微信使用本站账号登录仅可余额支付！');exit;
            $jsApiParameters = model('Pay')->getWechatPay($data['order_code'],$data['order_total_amount'],$transaction_type,$level);
           
            $this->assign('data',json_encode($jsApiParameters));
        return $this->fetch('jsapi_pay');
        }elseif(isMobile()){
            
            model('Pay')->getMobilePay($data['order_code'],$data['order_total_amount'],$transaction_type,$level);

        } 

        
    }


    // 微信扫码支付
    public function wechat_pay()
    {
        if (IS_AJAX_POST) {
            $unified_id       = input('post.unified_id/d');
            $unified_number   = input('post.unified_number/s');
            $transaction_type = input('post.transaction_type/d');

            $where = [
                'users_id' => $this->users_id,
                'lang'     => $this->home_lang,
            ];
            $open_id = $this->users_db->where($where)->getField('open_id');
            if (empty($open_id)) {
                $this->error('手机端微信使用本站账号登录仅可余额支付！');
            }
            if ('2' == $transaction_type) {
                // 购买商品
                $PayWhere = [
                    'order_id'   => $unified_id,
                    'order_code' => $unified_number,
                    'users_id'   => $this->users_id,
                    'lang'       => $this->home_lang,
                ];
                $PayData = $this->shop_order_db->where($PayWhere)->field('order_code,order_amount')->find();
                $out_trade_no = $PayData['order_code'];
                $total_fee    = $PayData['order_amount'];
            }else if('1' == $transaction_type) {
                // 充值金额
                $PayWhere = [
                    'moneyid'      => $unified_id,
                    'order_number' => $unified_number,
                    'users_id'     => $this->users_id,
                    'lang'         => $this->home_lang,
                ];
                $PayData = $this->users_money_db->where($PayWhere)->field('order_number,money')->find();
                $out_trade_no = $PayData['order_number'];
                $total_fee    = $PayData['money'];
            }else{
                $this->error('订单类型错误！');
            }




            $data   = model('Pay')->getWechatPay($open_id,$out_trade_no,$total_fee);
            // 这个data返回的是调用需要时，所需要给微信提供的公众号参数，并非提示信息
            if (!empty($data)) {
                $this->success($data);
            }else{
                $this->error('微信支付信息错误，请刷新后重试~');
            }
        }
    }

}