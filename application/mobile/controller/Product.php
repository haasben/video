<?php
namespace app\mobile\controller;

use think\Db;
/**
 * @param 产品中心控制器
 */
class Product extends Base
{
    public function _initialize() {
         parent::_initialize();
        // $this->cate = 'FreeCourse';

        // $this->assign('categroy',$this->cate);
    }

    public function index($id)
    {

    	// $id = 179;
    	$archivesModel = Db::name('archives');
		$archives = $archivesModel
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
        // dump($archives);die; 
        $this->assign('archives',$archives);

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
            ->field('a.seo_title,a.seo_keywords,a.seo_description,hac.content,a.title,a.litpic,a.aid,a.typeid,a.add_time,a.author,a.click')
            ->join('hw_product_content hac', 'hac.aid = a.aid')
            ->where('a.aid',$id)
            ->limit('add_time')
            ->limit(1)
            ->find();
        if(!empty($archives)){
            $archives['img'] = Db::table('hw_product_img')
                ->field('title,image_url,sort_order')
                ->where('aid',$archives['aid'])
                ->order('sort_order')
                ->select();
        }
        // dump($archives);
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