<?php
namespace app\index\controller;

use think\Db;
/**
 * @param 免费课程控制器
 */
class FreeCourse extends Course
{
    public function _initialize() {
        parent::_initialize();
        $this->cate = 'FreeCourse';

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



    public function search(){

        $keywords = input('keywords'); 
        if(IS_AJAX){
                
            if(empty($keywords))
                return ['code'=>'2'];
            return ['code'=>1];
        }

        // dump($keywords);
        $searchData = Db::table('hw_course')
            ->alias('a')
            ->field('a.title,a.click,hdc.content,hdc.hours,a.aid,a.litpic')
            // ->join('hw_archives ha','ha.cou_id = a.aid')
            ->join('hw_download_content hdc','hdc.aid= a.aid')
            ->where('a.title|hdc.content','like','%'.$keywords.'%')
            ->paginate(10,false,[
                'query' => request()->param(),
                'type'     => 'bootstrap',
            ]);
        //查询热门搜索
        $searchModel = Db::name('search_word');
        $is_word = $searchModel
            ->where('word',$keywords)
            ->limit(1)
            ->find();
        if(empty($is_word)){
            $searchModel->insert([
                'word'=>$keywords,
                'add_time'=>time(),
            ]);
        }else{
            $searchModel
            ->where('id',$is_word['id'])
            ->setInc('searchNum');
        }

        $searchHotData = $searchModel
            ->field('id,word')
            ->limit(10)
            ->order('searchNum desc')
            ->select();
        $this->assign('searchHotData',$searchHotData);
         //dump($searchData);die;
        $this->assign('searchData',$searchData);
        $this->assign('keywords',$keywords);


 

        return $this->fetch();

        

    }



}