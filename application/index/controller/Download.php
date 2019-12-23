<?php
namespace app\index\controller;

use think\Db;
use think\Request;
/**
 * @param 产品中心控制器
 */
class Download extends Course
{
    public function _initialize() {
         parent::_initialize();
        // $this->cate = 'FreeCourse';

        // $this->assign('categroy',$this->cate);
    }

    public function index($id)
    {

            
        //获取下载软件列表
        $downloadData = Db::name('archives')
            ->alias('a')
            ->field('a.title,a.aid,hc.is_free,hcf.file_size')
            ->join('hw_column_content hc','hc.aid = a.aid')
            ->join('hw_custom_file hcf','hcf.aid = a.aid')
            ->where('a.typeid',$id)
            ->order('a.aid desc')
            ->paginate(10,false,[
                'query' => request()->param(),
                'type'     => 'bootstrap',
            ]);
    
        $tuijian = Db::name('archives')
            ->alias('a')
            ->field('a.title,a.aid,hc.is_free')
            ->join('hw_column_content hc','hc.aid = a.aid')
            ->where('a.typeid',$id)
            ->where('a.is_recom',1)
            ->order('a.aid desc')
            ->limit(5)
            ->select();
        $this->assign('tuijian',$tuijian);   


        $this->assign('downloadData',$downloadData);
        return $this->fetch();
    }


    //生成订单跳转到收银台
    public function get_url(){

        if(IS_AJAX){
            $paycourse_id = input('paycourse_id');

            if(empty($paycourse_id)){
                echo '嘿嘿嘿';die;
            }
            if(empty(session('users_info'))){
                return ['code'=>2];
            }

            //查询软件是否是付费的
            $is_free = Db::name('column_content')
                ->where('aid',$paycourse_id)
                ->value('is_free');
            if($is_free == '是'){
                $url = Db::name('custom_file')
                    ->where('aid',$paycourse_id)
                    ->value('file_url');
                return ['code'=>5,'url'=>$url];
            }else{
                //查询是否已付费   

                $is_goumai = Db::table('hw_shop_order')
                    ->where('users_id',session('users_info')['users_id'])
                    ->where('prom_type',2)
                    ->where('order_status',1)
                    ->where('update_time','>',time()-24*60*60)
                    ->limit(1)
                    ->find();
                if(!empty($is_goumai)){
                    $url = Db::name('custom_file')->where('aid',$paycourse_id)
                    ->value('file_url');
                    return ['code'=>5,'url'=>$url];
                }
            } 

            $type = input('type');

            $pay_wechat_config = unserialize(getUsersConfigData('pay.pay_wechat_config'));

            $pay_alipay_config = unserialize(getUsersConfigData('pay.pay_alipay_config'));

            if(!$pay_wechat_config && !$pay_alipay_config){
                return ['code'=>3,'msg'=>'暂时不能购买视频'];
            }elseif ($pay_wechat_config['is_open_wechat'] == 1 && $pay_alipay_config['is_open_alipay'] == 1) {
                return ['code'=>3,'msg'=>'暂时不能购买视频'];
            }

            // dump($cou_id);die;
            //生成订单
            $data = $this->shop_payment_page($paycourse_id,$type);

            if($data['code'] == '1111'){
                return ['code'=>3,'msg'=>$data['msg']];
            }


            $request = Request::instance();
            $domain = $request->domain();
            $url = $domain.'/Download?id=183';
            $sign = get_sign($url.$data['orderid']);
            return ['code'=>1,'token'=>$sign,'url'=>$url,'orderid'=>$data['orderid']];
        }else{
            echo '嘿嘿嘿';die;
        }
        
    }

     // 订单提交处理逻辑，添加商品信息及计算价格等
    public function shop_payment_page($aid,$type)
    {
           // 产品ID是否存在

            $course = Db::name('archives')
                ->field('a.title,hc.price as amount')
                ->alias('a')
                ->join('hw_column_content hc','hc.aid = a.aid')
       
                ->where('a.aid',$aid)
                ->limit(1)
                ->find();
            $prom_type = 2;

            
    
            // 没有相应的产品
            if (empty($course)) return ['code'=>'1111'];
             
            // 产品数据处理
            // $PromType = '1'; // 1表示为虚拟订单
            // 添加到订单主表
            $time = getTime();
            $OrderData = [
                'order_code'        => date('Ymd').$time.rand(10,100), //订单生成规则
                'users_id'          => $this->users_id,
                'order_status'      => 0, // 订单未付款
                'add_time'          => $time,
                'order_total_amount'=> $course['amount'],
                'order_amount'      => $course['amount'],
                'order_total_num'   => 1,
                'prom_type'         => $prom_type,
                // 'user_note'         => $post['message'],
                'lang'              => $this->lang,
            ];
   
            //dump($OrderData);die;
            // 存在收货地址则追加合并到主表数组


            if (isMobile() && isWeixin()) {
                $OrderData['pay_name'] = 'wechat';// 如果在微信端中则默认为微信支付
                $OrderData['wechat_pay_type'] = 'WeChatInternal';// 如果在微信端中则默认为微信端调起支付
            }
            Db::startTrans();

            $OrderId = Db::name('shop_order')->insertGetId($OrderData);
        
            if (!empty($OrderId)) {
             
                $OrderDetailsData = [
                        'order_id'      => $OrderId,
                        'users_id'      => $this->users_id,
                        'product_id'    => $aid,
                        'product_name'  => $course['title'],
                        'num'           => 1,
                        'product_price' => $course['amount'],
                        'prom_type'     => $prom_type,
                        'litpic'        => $course['litpic'],
                        'add_time'      => $time,
                        'lang'          => $this->lang,
                    ];
                
                $DetailsId = Db::name('shop_order_details')->insertGetId($OrderDetailsData);

                if (!empty($OrderId) && !empty($DetailsId)) {

                    // 添加订单操作记录
                    AddOrderAction($OrderId,$this->users_id);
                    Db::commit();
                    return ['code'=>'0000','msg'=>'订单生成成功','orderid'=>$OrderData['order_code']];
                }else{
                    Db::rollback();
                    return ['code'=>'1111','msg'=>'订单生成失败'];
                }
            }else{
                Db::rollback();
                return ['code'=>'1111','msg'=>'订单生成失败'];
            }
    }

   


}