<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Session;

class Course extends Base
{

    //语言
	public $lang;

    //类别
    public $cate;
	/*
     * 初始化操作
     */
    public function _initialize() 
    {	
        parent::_initialize();
        
        
        $cid = 121;
        //课程分类
        $course_sorts = Db::table('hw_arctype')
            ->field('id,typename,seo_description,seo_title,seo_keywords,dirname,dirpath')
            ->where('parent_id',$cid)
            ->where('is_del',0)
            ->where('status',1)
            ->where('lang','cn')
            ->where('is_hidden',0)
            ->order('sort_order')
            ->select();
        $this->assign('course_sorts',$course_sorts);
    }

}
