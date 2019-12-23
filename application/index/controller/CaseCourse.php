<?php
namespace app\index\controller;

use think\Db;
/**
 * @param 免费课程控制器
 */
class CaseCourse extends Course
{
    public function _initialize() {
        parent::_initialize();
        $this->cate = 'CaseCourse';

        $this->assign('categroy',$this->cate);
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
            ->paginate(20,false,[
                'query' => request()->param(),
                'type'     => 'bootstrap',
            ]);;

        //dump($cateName);die;
        $this->assign('FreeCourse',$FreeCourse);

        return $this->fetch();
         
    }


}