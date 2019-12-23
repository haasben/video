<?php
namespace app\mobile\controller;

use think\Db;
use think\Session;
use think\Request;
/**
 * @param 课程中心控制器
 */
class MFreeCourse extends Base
{
    public function _initialize() {
        parent::_initialize();
        // $this->cate = 'CourseCenter';
        // $this->assign('categroy',$this->cate);
   
    }

    public function index($id)
    {
        
        //实例化数据
        $archivesModel = Db::name('course');
        $arctypeModel = Db::name('arctype');
        //栏目seo name等信息
        $cateName = $arctypeModel
            ->field('typename,seo_title,seo_keywords,seo_description')
            ->where('id',$id)
            ->limit(1)
            ->find();
        $this->assign('cateName',$cateName);

        $FreeCourse = $archivesModel
            ->alias('a')
            ->field('a.litpic,a.aid,a.title,hdc.is_free,hdc.videorating,a.click')
            ->join('hw_download_content hdc','hdc.aid=a.aid')
            ->where('a.typeid',$id)
            ->where('a.is_del',0)
            ->where('a.status',1)
            ->order('a.add_time desc')
            ->group('title')
            ->limit(12)
            ->select();

        //dump($cateName);die;
        $this->assign('FreeCourse',$FreeCourse);
        $this->assign('id',$id);

        return $this->fetch();
    }
    public function page_list($page,$id){
        $archivesModel = Db::name('course');
        $FreeCourse = $archivesModel
            ->alias('a')
            ->field('a.litpic,a.aid,a.title,hdc.is_free,hdc.videorating,a.click')
            ->join('hw_download_content hdc','hdc.aid=a.aid')
            ->where('a.typeid',$id)
            ->where('a.is_del',0)
            ->where('a.status',1)
            ->order('a.add_time desc')
            ->group('title')
            ->page($page,12)
            ->select();
        return $FreeCourse;
    }

}