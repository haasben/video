<?php

namespace app\mobile\controller;

use think\Controller;
use think\Db;
use think\Session;

class Member extends Base
{

	public function _initialize() {
        parent::_initialize();
        if(!session('users_info')){
        	$this->redirect('/mlogin');
        }
        
    }

	public function index(){

		// dump($this->users_id);die;
		//我的收藏
		$users_collectModel = Db::name('users_collect');

		$memberData['collect_count'] = $users_collectModel
			->where('users_id',$this->users_id)
			->where('type',1)
			->count();
		//学习记录
		$memberData['Learn'] = $users_collectModel
			->alias('uc')
			->field('hc.litpic,hc.title,hdc.hours,uc.aid')
			->join('hw_course hc','hc.aid = uc.aid')
			->join('hw_download_content hdc','hdc.aid=hc.aid')
			->where('uc.users_id',$this->users_id)
			->where('type',2)
			->order('uc.id desc')
			->limit(5)
			->select();	
		$archivesModel = Db::name('archives');
		foreach ($memberData['Learn'] as $k => $v) {
			$memberData['Learn'][$k]['count'] =$archivesModel
				->where('cou_id',$v['aid'])
				->count();

		}

		$order_list = Db::table('hw_shop_order')
			->field('order_status')
			->where('users_id',$this->users_id)
			// ->where('prom_type','<>',2)
			->select();
		
		$memberData['order_status0'] = 0;
		$memberData['order_status1'] = 0;
		$memberData['order_status_1'] = 0;
		$memberData['order_statusall'] = 0;
		//dump($order_list);die;
		foreach ($order_list as $key => $value) {
			$memberData['order_statusall']+=1;
			switch ($value['order_status']) {
				case '0':
					$memberData['order_status0'] +=1;
					break;
				case '-1':
					$memberData['order_status_1'] +=1;
					break;
				
				default:
					$memberData['order_status1'] +=1;
					break;
			}
		}
		$user_data=session('users_info');
		//可观看的视频类型
		$memberData['cat_level'] = Db::table('hw_users_level')
			->field('level_name')
			->where('level_id','in',$user_data['view_rights'])
			->where('lang',$this->home_lang)
			->select();


		$this->assign('memberData',$memberData);
		//dump($memberData); 

		return $this->fetch();

	}

//学习收藏
	public function learn(){

		if(IS_POST){

			$type = input('type');
			$page = input('page');
			if($type == 1){
				$type = 2;
			}else{
				$type = 1;
			}

			$users_collectModel = Db::name('users_collect');
			//学习记录
			$memberData = $users_collectModel
				->alias('uc')
				->field('hc.litpic,hc.title,hdc.hours,uc.aid')
				->join('hw_course hc','hc.aid = uc.aid')
				->join('hw_download_content hdc','hdc.aid=hc.aid')
				->where('uc.users_id',$this->users_id)
				->where('type',$type)
				->order('uc.id desc')
				->page($page,10)
				->select();	
			$archivesModel = Db::name('archives');
			foreach ($memberData as $k => $v) {
				$memberData[$k]['count'] =$archivesModel
					->where('cou_id',$v['aid'])
					->count();

			}
			return $memberData;
		}else{

			return $this->fetch();
		}
		
	}
//订单列表
	public function order_list(){

		if(IS_POST){
			$num = input('num');
			$page = input('page');

			$where = array();

			switch ($num) {
				case '1':
					$where['s.order_status'] = '0';
					
					break;
				case '2':
					$where['s.order_status'] = '1';
					break;
				case '3':
					$where['s.order_status'] = '-1';
					break;
			}
			$shop_orderModel = Db::name('shop_order');
			$order_list = $shop_orderModel
				->alias('s')
				->field('hc.title,hc.litpic,hdc.hours,s.order_amount,s.order_status,hc.aid')
				->join('hw_shop_order_details hso','hso.order_id = s.order_id')
				->join('hw_course hc','hc.aid = hso.product_id')
				->join('hw_download_content hdc','hdc.aid=hc.aid')
				->where('s.users_id',$this->users_id)
				->where($where)
				->group('s.order_code')
				->order('s.order_id desc')
				->page($page,10)
				->select();

			return $order_list;
		}


		return $this->fetch();


		
		

	}	

//购买的课程
	public function bought_course(){

		$uid = $this->users_id;
		$course = Db::table('hw_shop_order')
			->alias('s')
			->field('hc.title,hc.litpic,hdc.hours,s.order_amount,s.order_status,hso.product_id')
			->join('hw_shop_order_details hso','hso.order_id = s.order_id')
			->join('hw_course hc','hc.aid = hso.product_id')
			->join('hw_download_content hdc','hdc.aid=hc.aid')
			->where('s.users_id',$uid)
			->where('s.order_status',1)
			->select();
		 //dump($course);die;
		$this->assign('course',$course);

		return $this->fetch();
		
		

	} 



//修改用户信息
	public function edit_users(){

		if(IS_AJAX){
			$data = input();

			$result = $this->validate($data,
				    [	
				        'head_pic|头像'  => 'require',
				        'username|用户名'=>'require',
				        'nickname|昵称'=>'require',
				        'email|邮箱'=>'require|email'
				    ]);
			if(true !== $result){
			    // 验证失败 输出错误信息
			    return ['code'=>3,'msg'=>$result];
			}

			//查询该邮箱是否存在
			$usersModel = Db::name('users');
			$bool = $usersModel
				->where('email',$data['email'])
				->where('users_id','<>',$this->users_id)
				->limit(1)
				->find();
			if(!empty($bool)){
				return ['code'=>3,'msg'=>'该邮箱账号已被绑定'];
			}

			$bool = Db::name('users')
				->where('users_id',$this->users_id)
				->update([
					'head_pic'=>$data['head_pic'],
					'username'=>$data['username'],
					'nickname'=>$data['nickname'],
					'email'=>$data['email']
				]);
			Db::name('users_list')->where('users_id',$this->users_id)
				->where('para_id',2)
				->update(['info'=>$data['email']]);


			$userData = Db::name('users')
				->where('users_id',$this->users_id)
				->limit(1)
				->find();
			
			session('users_info',$userData);
			return ['code'=>1,'msg'=>'修改成功'];
		}
		return $this->fetch();

	}

//修改密码
	public function edit_pass(){

		$data = input();
		$result = $this->validate($data,
		    [	
		        'oldpass|旧密码'  => 'require|number|length:6,18',
		        'password|密码'=>'require|number|length:6,18',
		        'sub_password|重复密码'=>'require|number|length:6,18',
		    ]);
			if(true !== $result){
			    // 验证失败 输出错误信息
			    return ['code'=>3,'msg'=>$result];
			}elseif($data['password'] != $data['sub_password']){
				return ['code'=>3,'msg'=>'两次输入的密码不一致'];
			}
		$usersModel = Db::name('users');
		$userData = $usersModel
			->where('users_id',$this->users_id)
			->limit(1)
			->find();
		if(func_encrypt($data['oldpass']) != $userData['password']){
			return ['code'=>3,'msg'=>'旧密码错误'];
		}

		$usersModel->where('users_id',$this->users_id)
			->update(['password'=>func_encrypt($data['password'])]);
		Session::delete('users_info');
		return ['code'=>1,'msg'=>'修改成功'];

	}

//修改手机号
	public function edit_phone(){

		$data = input();
		$result = $this->validate($data,
	    [	
	    	// 'token|令牌'=>'require|token',
	        'newmobile|新手机号'  => 'require',
	        'code|验证码'   => 'require',
	    ]);
		if(true !== $result){
		    // 验证失败 输出错误信息
		    return ['code'=>2,'msg'=>$result];
		}
		//验证手机号是否是发送短信的手机号
		if($data['code'] !=cookie('v_code')){
			
			return ['code'=>0,'msg'=>'验证码错误'];
		}elseif(!is_mobile($data['newmobile'])){
			return ['code'=>0,'msg'=>'手机号格式错误'];
		}
		$usersModel = Db::name('users');
		//判断手机号和邮箱是否已经被注册了
		$is_reg = $usersModel
			->where('mobile',$data['newmobile'])
			->limit(1)
			->find();
		if(!empty($is_reg)){
			return ['code'=>2,'msg'=>'手机号或邮箱已被注册，请更换注册账号'];
		}

		$is_reg = $usersModel
			->where('users_id',$this->users_id)
			->update([
				'mobile'=>$data['newmobile']
			]);
		Db::name('users_list')->where('users_id',$this->users_id)
				->where('para_id',1)
				->update(['info'=>$data['newmobile']]);

		$userData = $usersModel
				->where('users_id',$this->users_id)
				->limit(1)
				->find();
		cookie('v_code',md5('dassadd'));
		session('users_info',$userData);
		return ['code'=>1,'msg'=>'手机号修改成功'];

	}

//发送验证码
	public function sen_msg(){
		cookie('v_code',null);
		$code = cookie('v_code');

		if(!empty($code)){
			echo '-4';die;
		}
		$mobile = session('users_info')['mobile'];
		if(is_mobile($mobile)){
			$code = mt_rand(1000,9999);
			if(send_msg_api($mobile,$code)['code'] == '0'){
				// cookie('mobile',$mobile,180);
				cookie('v_code',$code);

				echo '1';
			}else{
				echo 2;
			}

		}else{
			echo 2;
		}
	}


	public function pic(){
        // 获取上传文件表单字段名
        $fileKey = array_keys(request()->file());
        // 获取表单上传文件
        $file = request()->file($fileKey['0']);
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . '/uploads');

        if($info){
            $result['code'] = 1;
            $result['info'] = '图片上传成功!';
            $path=str_replace('\\','/',$info->getSaveName());
            $result['src'] = '/uploads/'. $path;
            return $result;
        }else{
            // 上传失败获取错误信息
            $result['code'] =0;
            $result['info'] = '图片上传失败!';
            $result['src'] = '';
            return $result;
        }
    }

    public function member(){

    	$view_rights = Db::name('users')->where('users_id',$this->users_id)->limit(1)->value('view_rights');
		$view_rights = '1,'.$view_rights;
		$member_level = Db::name('users_type_manage')
			->field('level_id,price,type_name')
			->where('level_id','not in',$view_rights)
			->select();
		if(count($member_level) == 1){
			$member_level = '';
		}

		$token = get_token();
		$this->assign('member_level',$member_level);
		$this->assign('token',$token);
    	return $this->fetch();
    }

}


