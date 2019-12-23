<?php
namespace app\mobile\controller;

use think\Db;
use think\Session;
/**
 * @param 课程中心控制器
 */
class Mvoice extends Base
{
    public function _initialize() {
        parent::_initialize();
        // $this->cate = 'CourseCenter';
        // $this->assign('categroy',$this->cate);
   
    }


    public function voice_play(){


        //判断有无登陆
        if(empty(session('users_info'))){
            session('refer_url',$_SERVER["HTTP_REFERER"]);
            $this->redirect('/mlogin?tab=1');exit;
        }
        $id = input('id');
        $aid = Db::table('hw_archives')
            ->where('typeid',183)
            ->where('cou_id',$id)
            ->order('sort_order')
            ->limit(1)
            ->value('aid');
        if(empty($aid)){
            echo '<script>alert("视频不存在,请观看其他视频");history.go(-1);</script>';exit;
        }
        $voiceData = Db::table('hw_download_file')
            ->where('aid',$aid)
            ->limit(1)
            ->order('sort_order')
            ->find();
        if(empty($voiceData)){
            echo '<script>alert("视频不存在,请观看其他视频");history.go(-1);</script>';exit;
        }

        // dump($voiceData);die;
        $this->assign('voiceData',$voiceData);
        // dump($voiceData);die;


        return $this->fetch();

    }


  

}