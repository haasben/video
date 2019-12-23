<?php

namespace app\mobile\controller;

use think\Controller;
use think\Db;
use think\Session;

class index extends Base
{

	public function index(){

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

		//新课上架 默认4节
		$newCourse = Db::table('hw_course')
			->alias('ha')
			->field('ha.click,ha.aid,ha.title,ha.litpic,hdc.content,hdc.is_free,COUNT(has.cou_id) as total')
			->join('hw_download_content hdc','hdc.aid=ha.aid')
			->join('hw_archives has','has.cou_id = ha.aid')
			->where('ha.status',1)
			->where('ha.typeid','<>',183)
			->group('ha.title')
			->limit(4)
			->order('ha.add_time desc')
			->select();

		$this->assign('newCourse',$newCourse);

		//热门课程默认4节
		$hotCourse = Db::table('hw_course')
			->alias('ha')
			 ->field('ha.click,ha.is_recom,ha.aid,ha.title,ha.litpic,hdc.content,hdc.is_free,COUNT(has.cou_id) as total')
			->join('hw_download_content hdc','hdc.aid=ha.aid')
			->join('hw_archives has','has.cou_id = ha.aid')
			->where('ha.status',1)
			->where('ha.typeid','<>',183)
			->where('ha.is_recom',1)
			->group('ha.title')
			->limit(4)
			->order('ha.add_time desc')
			->select();
		//dump($hotCourse);die;
		$this->assign('hotCourse',$hotCourse);



		return $this->fetch();

	}
}