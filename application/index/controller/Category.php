<?php
namespace app\index\controller;

use think\Db;
/**
 * @param 网站首页控制器
 */
class Category extends Base
{
    public function _initialize() {
        parent::_initialize();
   
    }

    public function index()
    {
       

        

        return $this->fetch('index/course');
        
         
    }



    public function category($id){

       //$data = Db::table('')

        echo 1;die;

    }

}