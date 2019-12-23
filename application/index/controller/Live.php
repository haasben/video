<?php
namespace app\index\controller;

use think\Db;
/**
 * @param 加盟中心控制器
 */
class Live extends Course
{
    public $aid = 'gkbplc';
    public $secret = '3riJfa934VIijUczMRrmYveF';
    public function _initialize() {
         parent::_initialize();


        // $this->cate = 'FreeCourse';

        // $this->assign('categroy',$this->cate);
    }

    public function index()
    {

        $toekn = $this->get_toekn();


        return $this->fetch();
    }

    public function get_toekn(){

        $url = 'http://openapi.douyu.com/api/thirdPart/token';
        $time = time();
        $auth =  md5('/api/thirdPart/token?aid='.$this->aid.'&time='.$time.$this->secret);

        $request_url = $url.'?aid='.$this->aid.'&time='.$time.'&auth='.$auth;
         dump($request_url);die;
        $data = file_get_contents($request_url);
        echo $data;die;


    }


}