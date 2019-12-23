<?php
namespace app\index\controller;

use think\Db;
/**
 * @param 加盟中心控制器
 */
class Affiliate extends Course
{
    public function _initialize() {
         parent::_initialize();
        // $this->cate = 'FreeCourse';

        // $this->assign('categroy',$this->cate);
    }

    public function index($id)
    {

        $archivesModel = Db::name('archives');
        $archives = $archivesModel
            ->alias('a')
            ->field('a.litpic,a.aid,a.title,hac.content,a.seo_keywords,a.seo_description,a.seo_title,a.typeid')
            ->join('hw_single_content hac','hac.aid=a.aid')
            ->where('a.typeid',$id)
            ->where('a.is_del',0)
            ->where('a.status',1)
            ->limit(1)
            ->find();

        // $archives['catpic'] = Db::table('hw_arctype')
        //     ->where('id',$archives['typeid'])
        //     ->limit(1)
        //     ->value('litpic');
        //  //dump($archives);die;
        // //找到上级的banner

        
        $this->assign('archives',$archives);

        return $this->fetch();
    }




}