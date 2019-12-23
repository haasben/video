<?php
namespace app\mobile\controller;

use think\Db;
/**
 * @param  项目案例控制器
 */
class Project extends Base
{
    public function _initialize() {
         parent::_initialize();
        // $this->cate = 'ProjectCases';

        // $this->assign('categroy',$this->cate);
    }

    public function index($id)
    {   

        //项目案例
        $archivesModel = Db::name('archives');
        $cases = $archivesModel
            ->alias('a')
            ->field('a.litpic,a.aid,a.title')
            ->where('a.typeid',$id)
            ->where('a.is_del',0)
            ->where('a.status',1)
            ->order('a.add_time desc')
            ->select();
            // ->paginate(12,false,[
            //     'query' => request()->param(),
            //     'type'     => 'bootstrap',
            // ]);   
        
        $this->assign('cases',$cases);
        // dump($cases);die; 
        

        return $this->fetch();
    }

    public function details($id){

        //当前案例详情
        /**实例化文章表**/
        $archivesModel = Db::name('archives');

        //增加一个点击
        $archivesModel->where('aid',$id)->setInc('click');
        $archives = $archivesModel
            ->alias('a')
            ->field('a.seo_title,a.seo_keywords,a.seo_description,hpc.content,a.title,a.litpic,a.aid,a.typeid,a.add_time,a.author,a.click')
            ->join('hw_product_content hpc', 'hpc.aid = a.aid')
            ->where('a.aid',$id)
            ->limit('add_time')
            ->limit(1)
            ->find();

        //上一篇
        $pre = $archivesModel
            ->field('title,aid')
            ->where('typeid',$archives['typeid'])
            ->where('add_time','>',$archives['add_time'])
            ->order('add_time')
            ->limit(1)
            ->find();
        $this->assign('pre',$pre);
        // dump($pre);

        //下一篇
        $next = $archivesModel
            ->field('title,aid')
            ->where('typeid',$archives['typeid'])
            ->where('add_time','<',$archives['add_time'])
            ->order('add_time desc')
            ->limit(1)
            ->find();
        $this->assign('next',$next);



        //dump($archives);die;
        $this->assign('archives',$archives);


        return $this->fetch();
    }




}