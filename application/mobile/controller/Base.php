<?php

namespace app\mobile\controller;

use think\Controller;
use think\Db;
use think\Session;

class Base extends Controller
{

    //语言
	public $lang;

    //类别
    public $cate = array();

    public $users_id;
	/*
     * 初始化操作
     */
    public function _initialize() 
    {	
        
        parent::_initialize();
        if(!isMobile()){
        $this->redirect('/');exit;
        }
        $lang = 'cn';
        add_scan();
        $this->lang = $lang;

        $userData = session('users_info');

        if(!empty($userData)){
            $this->users_id = $userData['users_id'];
            $userData = Db::name('users')
                ->where('users_id',$this->users_id)
                ->limit(1)
                ->find();
            //判断只能让一个账号同时两个设备在线
            if(!empty($userData['session_id'])){
                $session_id = explode(',', $userData['session_id']);

                if(!in_array(session_id(), $session_id)){
                    Session::delete('users_info');
                    if(IS_AJAX){
                        return ['code'=>3,'msg'=>'账号在其他设备登陆，您已被迫下线','url'=>'/mlogin?tab=1'];
                    }else{
                       $this->success('账号在其他设备登陆，您已被迫下线', '/mlogin?tab=1');exit; 
                    }
                }
            }
            $userData['view_rights'] = explode(',', $userData['view_rights']);
            $userData['level'] = Db::table('hw_users_level')
                ->where('level_id',$userData['level'])
                ->limit(1)
                ->value('level_name');
            
        }
        $this->assign('userData',$userData);
        //网站信息
        $web_config = web_config();
        
        $this->assign('web_config',$web_config);

        $arctypeModel = Db::name('arctype');
        $cate_footer = $arctypeModel
            ->field('id,typename,dirname,seo_title,seo_keywords,seo_description,typelink,litpic,is_part')
            ->where('lang',$this->lang)
            ->where('status',1)
            ->where('is_del',0)
            ->where('parent_id',0)
            ->where('is_hidden',0)
            ->order('sort_order')
            ->select();

        foreach ($cate_footer as $k => $v) {
            $cate_footer[$k]['child'] =$arctypeModel
            ->field('id,typename,dirname,seo_title,seo_keywords,seo_description,typelink,litpic,is_part')
            ->where('lang',$this->lang)
            ->where('status',1)
            ->where('is_del',0)
            ->where('parent_id',$v['id'])
            ->where('is_hidden',0)
            ->where('id','not in',[131,143])
            ->order('sort_order')
            ->select();
            if($k !=0){

                $this->cate = array_merge($this->cate,$cate_footer[$k]['child']);
                  
            }
            
        }
     // dump($this->cate);die;
        $this->assign('cate',$this->cate);
        
        //$this->assign('cate_footer',$cate_footer);


    }


	




}










?>