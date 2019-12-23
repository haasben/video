<?php
namespace app\mobile\controller;

use think\Db;
use think\Session;
use think\Request;
/**
 * @param 课程中心控制器
 */
class MCourseCenter extends Base
{
    public function _initialize() {

        parent::_initialize();

        // $this->cate = 'CourseCenter';
        // $this->assign('categroy',$this->cate);
   
    }

    public function index()
    {
        
        $id = 169;
        $free_id = 129;
        $arctypeModel = Db::name('arctype');
        $courseModel = Db::name('course');
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

        //热门课程默认4节
        $hotCourse = $courseModel
            ->alias('ha')
             ->field('ha.click,ha.is_recom,ha.aid,ha.title,ha.litpic,hdc.content,hdc.is_free,COUNT(has.cou_id) as total')
            ->join('hw_download_content hdc','hdc.aid=ha.aid')
            ->join('hw_archives has','has.cou_id = ha.aid')
            ->where('ha.status',1)
            ->where('ha.typeid','<>',183)
            ->where('ha.is_recom',1)
            ->group('ha.title')
            ->limit(4)
            ->order('ha.add_time desc')
            ->select();
        //dump($hotCourse);die;
        $this->assign('hotCourse',$hotCourse);
        
        //免费课程 4 节
        $FreeCourse = $courseModel
            ->alias('a')
            ->field('a.litpic,a.aid,a.title,hdc.is_free,hdc.videorating,a.click')
            ->join('hw_download_content hdc','hdc.aid=a.aid')
            ->where('a.typeid',$free_id)
            ->where('a.is_del',0)
            ->where('a.status',1)
            ->order('a.add_time desc')
            ->group('title')
            ->limit(4)
            ->select();

        $this->assign('FreeCourse',$FreeCourse);
        $this->assign('course_cate',$course_cate);
  
        // //dump($course_list);

        return $this->fetch();
        
         
    }




    public function mcategory($id){

       
        //精品课程
        $arctypeModel = Db::name('arctype');
        //找到对应的栏目
        $cate_name = $arctypeModel
            ->field('typename,seo_title,seo_keywords,seo_description,id')
            ->where('id',$id)
            ->where('is_hidden',0)
            ->where('is_del',0)
            ->where('status',1)
            ->limit(1)
            ->find();

        if(empty($cate_name)){
            $this->redirect('/index');
        }
        $archivesModel = Db::name('course');
 
        $this->assign('cate_name',$cate_name);
        //查询下面的课程
        //实例化文章列表
        //查询到子集
        $course_list =  $arctypeModel
                ->field('id,typename')
                ->where('parent_id',$cate_name['id'])
                ->where('is_del',0)
                ->where('status',1)
                ->where('lang',$this->lang)
                ->order('sort_order')
                ->select();
        $id_arr = array((int)$id);
        foreach ($course_list as $k => $v) {
            $id_arr[] = $v['id'];
        }

        $archives = $archivesModel
            ->alias('a')
            ->field('a.litpic,a.aid,a.title,hdc.is_free,hdc.videorating,a.click')
            ->join('hw_download_content hdc','hdc.aid = a.aid')
            ->where('a.typeid','in',$id_arr)
            ->where('a.is_del',0)
            ->where('a.status',1)
            ->limit(8)
            ->select();
        // dump($archives);die;
        
        // dump($course_list);die;
        // dump($course_list);die;

        $this->assign('archives',$archives);
        $this->assign('id',$id);
        $this->assign('course_list',$course_list);

        return $this->fetch();

    }

//课程分页数据
    public function course_show_list($id,$page,$pid){


        if($id == 0){
            $arctypeModel = Db::name('arctype');
            $id_arr = array((int)$pid);
            $course_list =  $arctypeModel
                ->field('id,typename')
                ->where('parent_id',$pid)
                ->where('is_del',0)
                ->where('status',1)
                ->where('lang',$this->lang)
                ->order('sort_order')
                ->select();
            $id_arr = array((int)$id);
            foreach ($course_list as $k => $v) {
                $id_arr[] = $v['id'];
            }
            $where['a.typeid'] = ['in',$id_arr]; 
       
        }else{
            $where['a.typeid'] = $id; 
        }
        $archivesModel = Db::name('course');
        $archives = $archivesModel
            ->alias('a')
            ->field('a.litpic,a.aid,a.title,hdc.is_free,hdc.videorating,a.click')
            ->join('hw_download_content hdc','hdc.aid = a.aid')
            ->where($where)
            ->where('a.is_del',0)
            ->where('a.status',1)
            ->page($page,8)
            ->select();


        return $archives;



    }



    //课程展示
    public function mcourse_show($id){


        // $uid = $this->users_id;
        // if(empty($uid)){
        //     return $this->redirect('/mlogin');
        // }
        $user_data = session('users_info');
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

        //高级管理员可以看所有视频
        if($user_data){
            $uid = $this->users_id;
            $view_rights = explode(',', $user_data['view_rights']);
            if(!in_array($level,$view_rights)){
                //查询购买过哪些课程
                $mainCourse = Db::table('hw_shop_order')
                    ->alias('h')
                    ->join('hw_shop_order_details hs','hs.order_id = h.order_id')
                    ->where('h.users_id',$uid)
                    ->where('hs.product_id',$id)
                    ->where('h.order_status',1)
                    ->where('hs.prom_type',0)
                    ->limit(1)
                    ->value('h.update_time');

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


    public function get_video_url($aid,$id){


        if(IS_AJAX){
            $courseModel = Db::name('course');
            //超级会员可看所有课程
                //查询该一小节课程是否是免费的
                $arcrank = Db::name('archives')
                    ->where('aid',$aid)
                    ->limit(1)
                    ->value('arcrank');

                if($arcrank == 0 && session('?users_info')){
                $userData = session('users_info');
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
                        $arcrank = 1;
                    }
                    
                }

                if($arcrank == 0){
                    //查询是否购买该课程
                    $shop_order_detailsModel = Db::name('shop_order_details');
                    $is_gou = '';
                    $is_gou_single = '';
                    $is_gou = $shop_order_detailsModel
                        ->where('product_id',$id)
                        ->where('update_time','>',time()-365*24*60*60)
                        ->where('prom_type',0)
                        ->limit(1)
                        ->find();
                    if(empty($is_gou)){
                        $is_gou_single = $shop_order_detailsModel
                            ->where('product_id',$id)
                            ->where('single_cou_id',$aid)
                            ->where('update_time','>',time()-365*24*60*60)
                            ->where('prom_type',1)
                            ->limit(1)
                            ->find();
                    }
                    //查询是否有购买该课程
                    if(empty($is_gou) && empty($is_gou_single)){
                        return ['code'=>3,'msg'=>'请先购买课程'];
                    }
                }
 

            //查询到视频地址
            $file_data = Db::name('download_file')
                ->field('file_mime,file_url')
                ->where('aid',$aid)
                ->limit(1)
                ->find();
            return ['code'=>1,'data'=>$file_data];
        }
//             $file_dir = ROOT_PATH.'/uploads/video/20191204/596b4cb92d3450aad47d25619c302690.mp4';
//             ob_end_clean();
//             ob_start();
// //打开文件
//             $handler            = fopen($file_dir, 'r+b');
//             $file_size          = filesize($file_dir);
//             //声明头信息
           
//             header("Content-type: video/mpeg4;charset=UTF-8");
//             header("Content-Length: " . $file_size);
//             // 输出文件内容
//             echo fread($handler,$file_size);
//             fclose($handler);
//             ob_end_flush();
//             exit;

        
    }



    public function get_video($aid){


        // echo 1;die;
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
            $url = $domain.'/mcourse_show?id='.$paycourse_id;
            // dump($url);die;
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