<?php
namespace app\index\controller;

use think\Db;
use think\Session;
use think\Request;
/**
 * @param 课程中心控制器
 */
class CourseCenter extends Course
{
    public function _initialize() {
        parent::_initialize();
        $this->cate = 'CourseCenter';
        $this->assign('categroy',$this->cate);
   
    }

    public function index()
    {
        
        $id = 169;
        $arctypeModel = Db::name('arctype');
        //精品课程
        
        $cate_name = $arctypeModel
            ->field('typename,seo_title,seo_keywords,seo_description')
            ->where('id',$id)
            ->where('is_hidden',0)
            ->where('is_del',0)
            ->where('status',1)
            ->limit(1)
            ->find();
       // dump($cate_name);die;
        $this->assign('cate_name',$cate_name);


        $course_cate = $arctypeModel
            ->field('id,typename')
            ->where('parent_id',$id)
            ->where('is_del',0)
            ->where('status',1)
            ->where('lang',$this->lang)
            ->order('sort_order')
            ->select();
        //获取子集
        $course_list = array();
        $cate = array();
        foreach ($course_cate as $k => $v) {
            //查询到子集
                $cate =  $arctypeModel
                    ->field('id,typename')
                    ->where('parent_id',$v['id'])
                    ->where('is_del',0)
                    ->where('status',1)
                    ->where('lang',$this->lang)
                    ->order('sort_order')
                    ->select();
                // dump($cate);die;
                $course_cate[$k]['child'] =$cate;
                if($k == 0 && !empty($cate)){
                    $course_list = $cate;
                }

            }

        //dump($course_list);die;
        //子集文章
        if(!empty($course_list)){
            foreach ($course_list as $key => $val) {
                        
                $course_list[$key]['child'] = $arctypeModel
                    ->alias('a')
                    ->field('ha.litpic,ha.aid,ha.title,hdc.content,hdc.is_free,hdc.chapter,hdc.videorating,ha.click')
                    ->join('hw_course ha','ha.typeid = a.id')
                    ->join('hw_download_content hdc','hdc.aid=ha.aid')
                    ->where('ha.typeid',$val['id'])
                    ->where('ha.is_del',0)
                    ->where('ha.status',1)
                    ->order('a.add_time desc')
                    ->group('title')
                    ->limit(8)
                    ->select();

                $course_list[$key]['count'] = Db::table('hw_course')
                    ->where('typeid',$val['id'])
                    ->where('is_del',0)
                    ->where('status',1)
                    ->group('title')
                    ->count();    
            }
        }

        
        $this->assign('course_cate',$course_cate);
        $this->assign('course_list',$course_list);
        //dump($course_list);
        //dump($course_cate);die;
        return $this->fetch();
        
         
    }




    public function category($d){

       
        //精品课程
        if(empty($d)){
            $this->redirect('/index');
        }
        $pid = 169;
        $arctypeModel = Db::name('arctype');
        //找到对应的栏目
        $cate_name = $arctypeModel
            ->field('typename,seo_title,seo_keywords,seo_description')
            ->where('id',$d)
            ->where('is_hidden',0)
            ->where('is_del',0)
            ->where('status',1)
            ->limit(1)
            ->find();
       // dump($cate_name);die;
        if(empty($cate_name)){
            $this->redirect('/index');
        }
        $archivesModel = Db::name('course');
        $cate_name['count'] =$archivesModel
            ->where('typeid',$d)
            ->group('title')
            ->count(); 
        $this->assign('cate_name',$cate_name);
        //查询下面的课程
        //实例化文章列表
        
        
        $archives = $archivesModel
            ->alias('a')
            ->field('a.litpic,a.aid,a.title,hdc.is_free,hdc.videorating,a.click')
            ->join('hw_download_content hdc','hdc.aid = a.aid')
            ->where('a.typeid',$d)
            ->where('a.is_del',0)
            ->where('a.status',1)
            ->paginate(12,false,[
                'query' => request()->param(),
                'type'     => 'bootstrap',
            ]);
        //$page = $archives->render();
          // dump($archives);die;


        $course_cate = $arctypeModel
            ->field('id,typename')
            ->where('parent_id',$pid)
            ->where('is_del',0)
            ->where('status',1)
            ->where('lang',$this->lang)
            ->order('sort_order')
            ->select();
        //获取子集
        $course_list = array();
        $cate = array();
        foreach ($course_cate as $k => $v) {
            //查询到子集
                $cate =  $arctypeModel
                    ->field('id,typename')
                    ->where('parent_id',$v['id'])
                    ->where('is_del',0)
                    ->where('status',1)
                    ->where('lang',$this->lang)
                    ->order('sort_order')
                    ->select();
                $course_cate[$k]['child'] =$cate;
                if($k == 0 && !empty($cate)){
                    $course_list = $cate;
                }

            }

        $this->assign('archives',$archives);
        $this->assign('d',$d);
        $this->assign('course_cate',$course_cate);
        $this->assign('course_list',$course_list);

        return $this->fetch();

    }

    //课程展示
    public function course_show($id){

        $archivesModel = Db::name('archives');
        $courseModel = Db::name('course');


        $courseModel->where('aid',$id)->setInc('click'); 
        //查询到课程详情
        $course_info = $courseModel
            ->alias('a')
            ->field('a.*,hdc.content,hdc.is_free,hdc.amount,hdc.hours,hdc.videorating,hdc.lecturer,hdc.Instructors,ha.typename,ha.id')
            ->join('hw_download_content hdc','hdc.aid=a.aid')
            ->join('hw_arctype ha','ha.id=a.typeid')
            ->where('a.aid',$id) 
            ->limit(1)
            ->find();
        switch ($course_info['videorating']) {
            case '入门':
                $level = 1;
                break;
            case '初级':
                $level = 2;
                break;
            case '中级':
                $level = 3;
                break;
            case '高级':
                $level = 4;
                break;
            default:
                $level = 1;
                break;
        }
        $course_info['level'] = $level;
        //课程统计
        $course_info['count'] = $archivesModel->where('cou_id',$course_info['aid'])->count();
        //课程表
        $course_info['list'] = $archivesModel
            ->field('aid,title,arcrank,users_price,cha_id')
            ->where('cou_id',$course_info['aid'])
            ->order('sort_order')
            ->select();

        // dump($course_info);die;
        //查看是否购买该课程
        $mainCourse = array();
        $smallCourse = array();

        if(session('users_info')){
             // dump(session('users_info'));die;
            $uid = $this->users_id;
            $mainCourse = Db::table('hw_shop_order')
                ->alias('h')
                // ->field('h.update_time')
                ->join('hw_shop_order_details hs','hs.order_id = h.order_id')
                ->where('h.users_id',$uid)
                ->where('hs.product_id',$id)
                ->where('h.order_status',1)
                ->where('hs.prom_type',0)
                ->limit(1)
                ->value('h.update_time');
            // dump($mainCourse);die;
            if(empty($mainCourse) || time()-365*60*60*24 > $mainCourse){
                //如果没有查询有无购买小章节
                $hw_shop_order_details_id = Db::table('hw_shop_order_details')
                    ->field('single_cou_id')
                    ->where('users_id',$uid)
                    ->where('product_id',$id)
                    ->where('prom_type',1)
                    ->where('update_time','>',time()-365*60*60*24)
                    ->select();

                if(!empty($hw_shop_order_details_id)){
                    foreach ($hw_shop_order_details_id as $key => $value) {
                        $smallCourse[] = $value['single_cou_id'];
                    }
                }
            }
        }
        //查询章节

        $chapter = Db::table('hw_course_chapter')
            ->field('id,title')
            ->where('cou_id',$id)
            ->order('order')
            ->select();
        $this->assign('chapter',$chapter);

        $this->assign('mainCourse',$mainCourse);
        $this->assign('smallCourse',$smallCourse);

        $this->assign('course_info',$course_info);
        return $this->fetch();
    }

    public function video_play(){

        //视频标题
        $courseModel = Db::name('course');
        $aid = input('aid');

        $is_gou_single = '';
        $is_gou = '';

        //视频是否开发权限
        $userData = session('users_info');
        if(empty($aid)){

            $this->redirect('/');exit;

        }else{
            //判断视频小章节是否免费
            //查询到课程标题
            $id = Db::table('hw_archives')->where('aid',$aid)->limit(1)->value('cou_id');
            
            $is_free = Db::table('hw_archives')
                ->where('aid',$aid)
                ->limit(1)
                ->value('arcrank');
                
            if($is_free == 0 && session('?users_info')){
          
                $course_level = Db::table('hw_download_content')->where('aid',$id)->limit(1)->value('videorating');
                switch ($course_level) {
                    case '入门':
                        $level = 1;
                        break;
                    case '初级':
                        $level = 2;
                        break;
                    case '中级':
                        $level = 3;
                        break;
                    case '高级':
                        $level = 4;
                        break;
                    default:
                        $level = 1;
                        break;
                }
                $view_rights = explode(',', $userData['view_rights']);
                if(in_array($level, $view_rights)){
                    $arcrank = '1';
                }
                
            }else{
                if($is_free === NULL)$this->redirect('/');
                $arcrank = $is_free;
            }
        }

        if($arcrank !=1){
            
            //判断有无登陆
            if(empty($userData)){
                session('refer_url',$_SERVER["HTTP_REFERER"]);
                $this->redirect('/login?tab=1');exit;
            }
        }
        //当前课程
        $course =  $courseModel
                ->alias('a')
                ->field('a.aid,a.title,a.litpic,a.seo_title,a.seo_keywords,a.seo_description,a.click,hdc.lecturer,hdc.videorating')
                ->join('hw_download_content hdc','hdc.aid = a.aid')
                ->where('a.aid',$id)
                ->limit(1)
                ->find();
        // dump($course);
        if($arcrank == 0){
            
            $is_gou = Db::name('shop_order_details')
            ->where('product_id',$id)
            ->where('update_time','>',time()-365*24*60*60)
            ->where('prom_type',0)
            ->limit(1)
            ->find();

            if(empty($is_gou)){
                $is_gou_single = Db::name('shop_order_details')
                    ->where('product_id',$id)
                    ->where('single_cou_id',$aid)
                    ->where('update_time','>',time()-365*24*60*60)
                    ->where('prom_type',1)
                    ->limit(1)
                    ->find();
            }
            //查询是否有购买该课程
            if(empty($is_gou) && empty($is_gou_single)){
                echo '<script>alert("请购买需要付款的视频后再观看，谢谢");window.history.go(-1);</script>';exit;
            }
        }    
        if($this->users_id){
            //添加学习记录
            $users_colletModel =  Db::name('users_collect');
            $is_aid = $users_colletModel
                ->where('aid',$id)
                ->where('type',2)
                ->limit(1)
                ->find(); 
            if(!empty($is_aid)){
                $users_colletModel->where('id',$is_aid['id'])->delete();
            }
            $users_colletModel->insert([
                'aid'=>$id,
                'users_id'=>$this->users_id,
                'type'=>2,
                'collet_time'=>time()
            ]);
        }
        //章节列表
        $course['chapter'] = Db::table('hw_course_chapter')
            ->field('id,title')
            ->where('cou_id',$id)
            ->order('order')
            ->select();
        //课程列表
        $course['course_list'] = Db::table('hw_archives')
            ->field('aid,title,arcrank,cha_id')
            ->where('cou_id',$id)
            ->order('sort_order')
            ->select();
        session('token',get_token());
        $cha_id = Db::name('archives')->where('aid',$aid)->limit(1)->value('cha_id');
        $this->assign('cha_id',$cha_id);
        $this->assign('aid',$aid);
        $this->assign('course',$course);

        return $this->fetch();

    }

    public function get_video($aid){
        if(empty(session('token'))){
            // 验证失败 输出错误信息
            $this->redirect('/');exit;
        }

        Session::delete('token');
        $url = Db::table('hw_download_file')->where('aid',$aid)->limit(1)->value('file_url');
        echo $url;
        //header("Location:" .$url);   //重定向 保证video src引入后，拿到真实地址进行播放


    }
//生成订单跳转到收银台
    public function get_url(){


        // if(IS_AJAX){
            $paycourse_id = input('paycourse_id');

            if(empty($paycourse_id)){
                echo '嘿嘿嘿';die;
            }
            if(empty(session('users_info'))){
        
                return ['code'=>2];
            }
            $cou_id = input('cou_id');


            $pay_wechat_config = unserialize(getUsersConfigData('pay.pay_wechat_config'));

            $pay_alipay_config = unserialize(getUsersConfigData('pay.pay_alipay_config'));

            if(!$pay_wechat_config && !$pay_alipay_config){
                return ['code'=>3,'msg'=>'暂时不能购买视频'];
            }elseif ($pay_wechat_config['is_open_wechat'] == 1 && $pay_alipay_config['is_open_alipay'] == 1) {
                return ['code'=>3,'msg'=>'暂时不能购买视频'];
            }

            // dump($cou_id);die;
            //生成订单
            $data = $this->shop_payment_page($paycourse_id,$cou_id);

            if($data['code'] == '1111'){
                return ['code'=>3,'msg'=>$data['msg']];
            }

            $request = Request::instance();
            $domain = $request->domain();
            $url = $domain.'/course_show?id='.$paycourse_id;
            $sign = get_sign($url.$data['orderid']);
            return ['code'=>1,'token'=>$sign,'url'=>$url,'orderid'=>$data['orderid']];
        // }else{
        //     echo '嘿嘿嘿';die;
        // }
        
    }

    // 订单提交处理逻辑，添加商品信息及计算价格等
    public function shop_payment_page($aid,$cou_id)
    {
           // 产品ID是否存在
            if (empty($cou_id)) {
                $course = Db::name('course')
                    ->field('c.title,hdc.amount,c.aid,c.litpic')
                    ->alias('c')
                    ->join('hw_download_content hdc','hdc.aid=c.aid')
                    ->where('c.aid',$aid)
                    ->limit(1)
                    ->find();
                $prom_type = 0;
                $single_cou_id = 0;
                
            }else{
                $course = Db::name('archives')
                    ->field('a.title,a.users_price as amount,hc.litpic')
                    ->alias('a')
                    ->join('hw_course hc','hc.aid = a.cou_id')
                    ->where('a.cou_id',$aid)
                    ->where('a.aid',$cou_id)
                    ->limit(1)
                    ->find();
                $prom_type = 1;
                $single_cou_id = $cou_id;
            }
         
            // 没有相应的产品
            if (empty($course)) return ['code'=>'1111'];
             
            // 产品数据处理
            $PromType = '1'; // 1表示为虚拟订单
             
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
                'prom_type'         => $PromType,
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
                        'single_cou_id' => $single_cou_id
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