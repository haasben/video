<?php
namespace app\index\controller;

use think\Db;
/**
 * @param 产品中心控制器
 */
class Introduction extends Course
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
            ->field('a.litpic,a.aid,a.title,hac.content,a.seo_keywords,a.seo_description,a.seo_title,a.typeid')
            ->join('hw_article_content hac','hac.aid=a.aid')
            ->where('a.typeid',$id)
            ->where('a.is_del',0)
            ->where('a.status',1)
            ->limit(1)
            ->find();

        $archives['catpic'] = Db::table('hw_arctype')
            ->where('id',$archives['typeid'])
            ->limit(1)
            ->value('litpic');
        // dump($archives);die;
        //找到上级的banner

        
        $this->assign('archives',$archives);

        return $this->fetch();
    }


    public function goVideo()  
    {  
        $url = '\uploads\video/yy.mp4';

        // header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        // header("Content-Disposition: attachment; filename = yy.mp4");
        // header("Content-Length: " . filesize($url));
        // header("Content-Type: application/octet-stream");
        // echo file_get_contents($url);


        // if($_SESSION["token"]){  
            unset($_SESSION["token"]); //删除token，保证每次只能播放一次
            header("Location:" .$url);   //重定向 保证video src引入后，拿到真实地址进行播放
       // }  
    }




}