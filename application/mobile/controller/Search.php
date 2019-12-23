<?php
namespace app\mobile\controller;

use think\Db;
/**
 * @param 免费课程控制器
 */
class Search extends Base
{
    public function _initialize() {
        parent::_initialize();

    }
    public function index(){

        $keywords = input('keywords'); 

        if(!empty($keywords)){
            // dump($keywords);
            $searchData = Db::table('hw_course')
                ->alias('a')
                ->field('a.title,a.click,hdc.content,hdc.hours,a.aid,a.litpic')
                ->join('hw_download_content hdc','hdc.aid= a.aid')
                ->where('a.title|hdc.content','like','%'.$keywords.'%')
                ->paginate(10,false,[
                    'query' => request()->param(),
                    'type'     => 'bootstrap',
                ]);
            // dump($searchData);die;
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
            $this->assign('searchData',$searchData);

        }else{
            $searchModel = Db::name('search_word');
            $searchHotData = $searchModel
                ->field('id,word')
                ->limit(10)
                ->order('searchNum desc')
                ->select();
            $this->assign('searchHotData',$searchHotData);
        }
        $this->assign('keywords',$keywords);
        return $this->fetch();
    }
}