<?php

namespace app\index\controller;

use think\Controller;
use think\Db;

class Index extends Base
{

	public function _initialize() {
        parent::_initialize();
    }

	public function index(){

		$arctypeModel = Db::name('arctype');
		$archivesModel = Db::name('archives');
		$team_id = 155;
		$totor_id = 185;
		//栏目列表

		$this->assign('cate',$this->cate);

		 //dump($cate_footer);die;

		//首页轮播图
		$banner = cache('banner');
		if(empty($banner)){
			$banner = Db::table('hw_ad_position')
				->alias('hap')
				->field('ha.*,hap.title as titles')
				->join('hw_ad ha','ha.pid=hap.id')
				->where('hap.lang',$this->lang)
				->where('hap.status',1)
				->where('hap.is_del',0)
				->where('ha.status',1)
				->where('ha.is_del',0)
				->where('hap.id','in',[7,9,13])
				->select();
			
			cache('banner',$banner,60);
		}
		
		$this->assign('banner',$banner);

		//热门课程->新课上架 默认4节
		$newCourse = Db::table('hw_course')
			->alias('ha')
			->field('ha.aid,ha.title,ha.litpic,hdc.content,hdc.is_free,COUNT(has.cou_id) as total')
			->join('hw_download_content hdc','hdc.aid=ha.aid')
			->join('hw_archives has','has.cou_id = ha.aid')
			->where('ha.status',1)
			->where('ha.typeid','<>',183)
			->where('has.is_del',0)
			->group('ha.title')
			->limit(4)
			->order('ha.add_time desc')
			->select();

		$this->assign('newCourse',$newCourse);
		// dump($newCourse);die;

		//工控帮团队
		$team = $arctypeModel
			->field('typename,seo_title,seo_keywords,seo_description,litpic,id,typelink')
			->where('id',$team_id)
			->limit(1)
			->find();
		$team['child'] = $archivesModel
			->alias('ac')
			->field('ac.title,ac.litpic,ac.aid,ac.jumplinks')
			// ->join('hw_images_content hic','hic.aid = ac.aid')
			// ->join('hw_images_upload hiu','hiu.aid = ac.aid')
			->where('ac.typeid',$team['id'])
			->where('ac.status',1)
			->where('ac.is_del',0)
			->order('ac.sort_order')
			->limit(8)
			->select();
		$this->assign('team',$team);
		
		//友情链接
        $linkData = links();
	    $this->assign('linkData',$linkData);

	    //学员心声
	    $voice = Db::table('hw_course')
			->alias('ha')
			->field('ha.aid,ha.title,ha.litpic,hdc.content')
			->join('hw_download_content hdc','hdc.aid=ha.aid')
			->where('ha.status',1)
			->where('ha.typeid',183)
			->limit(4)
			->order('ha.sort_order')
			->select();

		$this->assign('voice',$voice);
		// dump($voice);die;
		//热门导师
		$totor = $arctypeModel
			->field('typename,seo_title,seo_keywords,seo_description,litpic,id,typelink')
			->where('id',$totor_id)
			->limit(1)
			->find();
		$totor['child'] = $archivesModel
			->alias('ac')
			->field('ac.title,ac.litpic,ac.aid,ac.jumplinks')
			// ->join('hw_images_content hic','hic.aid = ac.aid')
			// ->join('hw_images_upload hiu','hiu.aid = ac.aid')
			->where('ac.typeid',$totor['id'])
			->where('ac.status',1)
			->where('ac.is_del',0)
			->order('ac.sort_order')
			->limit(8)
			->select();
		$this->assign('totor',$totor);


		return $this->fetch();
		
	}




}










?>