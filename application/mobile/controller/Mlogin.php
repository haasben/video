<?php

namespace app\mobile\controller;

use think\Controller;
use think\Db;
use think\Verify;
use think\Validate;
use think\Session;
use think\Request;
class Mlogin extends Controller
{


	public function login(){

		// echo 1;die;
		if(IS_POST){
			$data = input();
			$result = $this->validate($data,
			    [	
			        'uname|手机号或邮箱'  => 'require|token',
			        'upwd|密码'=>'require'
			    ]);
			if(true !== $result){
			    // 验证失败 输出错误信息
			    return ['code'=>3,'msg'=>$result,'token'=>get_token()];
			}

			$usersModel = Db::name('users');
			$userData = $usersModel
				->where('mobile|email',$data['uname'])
				->limit(1)
				->find();
			if(empty($userData)){
				 return ['code'=>0,'msg'=>'用户不存在','token'=>get_token()];
			}elseif($userData['password'] !=func_encrypt($data['upwd'])){
				return ['code'=>2,'msg'=>'您输入的账号和密码不匹配，请重新输入','token'=>get_token()];
			}else{

				if($userData['is_activation'] == '0'){
					session('activation_id',$userData['users_id']);
					return ['code'=>'4','msg'=>'账号未激活','url'=>'/activation?callback='.Request::instance()->domain().'/login?tab=1','token'=>get_token()];
				}
				$session_id = explode(',', $userData['session_id']);
				if(count($session_id) == 2){
					unset($session_id[0]);
					$userData['session_id'] = $session_id[1];
				}

				$userData['session_id'] = trim($userData['session_id'].','.session_id(),',');
				$usersModel->where('users_id',$userData['users_id'])
					->update([
						'last_login'=>time(),
						'last_ip'=>clientIP(),
						'login_cnt'=>$userData['login_cnt'] + 1,
						'session_id'=>$userData['session_id'],
					]);

				session('users_info',$userData);
				$url = session('refer');
				if(empty($url)){
					$url = '/m';
				}elseif(strpos($url,'activation') !==false||strpos($url,'update_pwd') !==false||strpos($url,'mregister') !==false){
					$url = '/m';
				}

				return ['code'=>1,'msg'=>'登陆成功','url'=>$url];
			}
			exit;
			
		}

		session('refer',$_SERVER['HTTP_REFERER']);
		return $this->fetch();
	}

	public function activation(){



		return $this->fetch();
	}

//用户注册
	public function register(){

		if(IS_POST){
		$data = input();

		$validate = array();
		$validate = [
			'email'=>$data['uEmail'],
			// 'username'=>$data['utrueName'],
			// 'nickname'=>$data['utrueName'],
			'mobile'=>$data['umobile'],
			'is_activation'=>0,
			'reg_time'=>time(),
			'password'=>$data['uPwd'],
			// 'token'=>$data['token'],
		];
		$result = $this->validate($validate,
	    [	
	    	// 'token|令牌'=>'require|token',
	        // 'username|用户名'  => 'require',
	        'email|邮箱'   => 'email',
	        'password|密码'=>'require|min:6'
	    ]);



		if(true !== $result){
		    // 验证失败 输出错误信息
		    return ['code'=>2,'msg'=>$result];
		}
		//验证手机号是否是发送短信的手机号
		if($validate['mobile'] != cookie('mobile')){

			return ['code'=>2,'msg'=>'与接收验证码手机号不符'];
		}elseif($data['validateCode'] !=cookie('v_code')){
			
			return ['code'=>0,'msg'=>'验证码错误'];
		}
		//判断手机号和邮箱是否已经被注册了
		$is_reg = Db::table('hw_users')
			->where('email',$validate['email'])
			->whereOr('mobile',$validate['mobile'])
			->limit(1)
			->find();

		if(!empty($is_reg)){
			return ['code'=>2,'msg'=>'手机号或邮箱已被注册，请更换注册账号'];
		}
		$name = '用户'.mb_substr($data['umobile'],7,11);
		$validate['username'] = $name;
		$validate['nickname'] = $name;
		$validate['password'] = func_encrypt($validate['password']);
		$validate['head_pic'] = ROOT_DIR .'/public/static/common/images/dfboy.png';
		$add_data_id = Db::name('users')->insertGetId($validate);
		if($add_data_id){
			$userData = Db::name('users')
				->where('users_id',$add_data_id)
				->limit(1)
				->find();
			$level = Db::table('hw_users_level')->where('level_id',0)->limit(1)->value('level_name');
			Db::name('users')->where('users_id',$userData['users_id'])
					->update([
						'last_login'=>time(),
						'last_ip'=>clientIP(),
						'login_cnt'=>$userData['login_cnt'] + 1
					]);
			Db::name('users_list')->insert([
				'users_id'=>$add_data_id,
				'para_id'=>1,
				'info'=>$validate['mobile'],
				'add_time'=>time()
			]);
			Db::name('users_list')->insert([
				'users_id'=>$add_data_id,
				'para_id'=>2,
				'info'=>$validate['email'],
				'add_time'=>time()
			]);

				$userData['level_name'] = $level;

				session('activation_id',$userData['users_id']);
		
			return ['code'=>1,'msg'=>'添加成功'];
		}else{
			return ['code'=>2,'msg'=>'添加失败，请稍候再试'];
		}
	}else{

		return $this->fetch();
	}


}



//验证图形code
	public function checkImageCode($code){

		$verify = new Verify();
        if ($verify->check($code, "admin_login")) {
            return ['error'=>0];die;
        }
        return ['error'=>1];

	}


//判断手机号是否已经注册
	public function verification($mobile){

		$is_reg = Db::table('hw_users')
			->where('mobile',$mobile)
			->limit(1)
			->value('username');

		if(empty($is_reg)){
			echo 2;
		}else{
			echo 1;
		}
	}


//判断是否是手机号

	public function sen_msg($mobile){

		//cookie('mobile',NULL);
		$mobiles = cookie('mobile');

		if(!empty($mobiles)){
			echo '-4';die;
		}

		if(is_mobile($mobile)){
			$code = mt_rand(1000,9999);
			if(send_msg_api($mobile,$code)['code'] == '0'){
				cookie('mobile',$mobile,120);
				cookie('v_code',$code);

				echo '1';
			}else{
				echo 2;
			}

		}else{
			echo 2;
		}
	}
	
//判断邮箱是否注册
	public function check_email(){

		$email = input('uEmail');
		//判断邮箱格式
		$mode = '/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/';
   		if(!preg_match($mode,$email)){
  			echo 2;exit;
 		}

 		$is_email = Db::table('hw_users')
 			->where('email',$email)
 			->limit(1)
 			->find();
 		if(!empty($is_email)){
 			echo '0';exit;
 		}
  		echo 1;

	}

	public function logout(){

		Session::delete('users_info');
		return ['code'=>1];

	}

	public function update_pwd(){
		if(IS_POST){
			$data = input();
			$validate = array();
			$validate = [
				'mobile'=>$data['mobile'],
				'code'=>$data['code'],
				'password'=>$data['password'],
				// 'token'=>$data['token'],
			];
			$result = $this->validate($validate,
		    [	
		    	
		        'mobile|手机号'   => 'require',
		        'password|密码'=>'require|min:6',
		        'code|验证码'=>'require',
		    ]);



			if(true !== $result){
			    // 验证失败 输出错误信息
			    return ['code'=>2,'msg'=>$result];
			}
			//验证手机号是否是发送短信的手机号
			if($validate['mobile'] != cookie('mobile')){

				return ['code'=>2,'msg'=>'与接收验证码手机号不符'];
			}elseif($data['code'] !=cookie('v_code')){
				
				return ['code'=>2,'msg'=>'验证码错误'];
			}

			$re = Db::name('users')->where('mobile',$data['mobile'])
				->update([
					'password'=>func_encrypt($data['password'])
				]);
			return ['code'=>1,'msg'=>'修改成功','url'=>'/mlogin'];


		}else{

			return $this->fetch();
		}

		
	}



}










