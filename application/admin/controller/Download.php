<?php
/**
 * 易优CMS
 * ============================================================================
 * 版权所有 2016-2028 海南赞赞网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.eyoucms.com
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 小虎哥 <1105415366@qq.com>
 * Date: 2018-4-3
 */

namespace app\admin\controller;

use think\Page;
use think\Db;

class Download extends Base
{
    // 模型标识
    public $nid = 'download';
    // 模型ID
    public $channeltype = '';
    
    public function _initialize() {
        parent::_initialize();
        $channeltype_list = config('global.channeltype_list');
        $this->channeltype = $channeltype_list[$this->nid];
        empty($this->channeltype) && $this->channeltype = 4;
        $this->assign('nid', $this->nid);
        $this->assign('channeltype', $this->channeltype);
    }

    //课程列表

    public function index()
    {
        $assign_data = array();
        $condition = array();
        // 获取到所有GET参数
        $param = input('param.');
        $flag = input('flag/s');
        $typeid = input('typeid/d', 0);
        $begin = strtotime(input('add_time_begin'));
        $end = strtotime(input('add_time_end'));

        // 应用搜索条件
        foreach (['keywords','typeid','flag','is_release'] as $key) {
            if (isset($param[$key]) && $param[$key] !== '') {
                if ($key == 'keywords') {
                    $condition['a.title'] = array('LIKE', "%{$param[$key]}%");
                } else if ($key == 'typeid') {
                    $typeid = $param[$key];
                    $hasRow = model('Arctype')->getHasChildren($typeid);
                    $typeids = get_arr_column($hasRow, 'id');
                    /*权限控制 by 小虎哥*/
                    $admin_info = session('admin_info');
                    if (0 < intval($admin_info['role_id'])) {
                        $auth_role_info = $admin_info['auth_role_info'];
                        if(! empty($auth_role_info)){
                            if(isset($auth_role_info['only_oneself']) && 1 == $auth_role_info['only_oneself']){
                                $condition['a.admin_id'] = $admin_info['admin_id'];
                            }
                            if(! empty($auth_role_info['permission']['arctype'])){
                                if (!empty($typeid)) {
                                    $typeids = array_intersect($typeids, $auth_role_info['permission']['arctype']);
                                }
                            }
                        }
                    }
                    /*--end*/
                    $condition['a.typeid'] = array('IN', $typeids);
                } else if ($key == 'flag') {
                    if ('is_release' == $param[$key]) {
                        $condition['a.users_id'] = array('gt', 0);
                    } else {
                        $condition['a.'.$param[$key]] = array('eq', 1);
                    }
                // } else if ($key == 'is_release') {
                //     if (0 < intval($param[$key])) {
                //         $condition['a.users_id'] = array('gt', intval($param[$key]));
                //     }
                } else {
                    $condition['a.'.$key] = array('eq', $param[$key]);
                }
            }
        }

        // 时间检索
        if ($begin > 0 && $end > 0) {
            $condition['a.add_time'] = array('between',"$begin,$end");
        } else if ($begin > 0) {
            $condition['a.add_time'] = array('egt', $begin);
        } else if ($end > 0) {
            $condition['a.add_time'] = array('elt', $end);
        }

        // 模型ID
        $condition['a.channel'] = array('eq', $this->channeltype);
        // 多语言
        $condition['a.lang'] = array('eq', $this->admin_lang);
        // 回收站
        $condition['a.is_del'] = array('eq', 0);

        /*自定义排序*/
        $orderby = input('param.orderby/s');
        $orderway = input('param.orderway/s');
        if (!empty($orderby)) {
            $orderby = "a.{$orderby} {$orderway}";
            $orderby .= ", a.aid desc";
        } else {
            $orderby = "a.aid desc";
        }
        /*end*/

        /**
         * 数据查询，搜索出主键ID的值
         */
        $count = DB::name('course')->alias('a')->where($condition)->count('aid');// 查询满足要求的总记录数
        $Page = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $fields = "b.*, a.*, a.aid as aid";
        $list = DB::name('course')
            ->field($fields)
            ->alias('a')
            ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
            ->where($condition)
            ->order($orderby)
            ->limit($Page->firstRow.','.$Page->listRows)
            ->getAllWithIndex('aid');
        foreach ($list as $key => $val) {
            $val['arcurl'] = get_arcurl($val);
            $val['litpic'] = handle_subdir_pic($val['litpic']); // 支持子目录
            $list[$key] = $val;
        }
        $show = $Page->show(); // 分页显示输出
        $assign_data['page'] = $show; // 赋值分页输出
        $assign_data['list'] = $list; // 赋值数据集
        $assign_data['pager'] = $Page; // 赋值分页对象

        // 栏目ID
        $assign_data['typeid'] = $typeid; // 栏目ID
        /*当前栏目信息*/
        $arctype_info = array();
        if ($typeid > 0) {
            $arctype_info = M('arctype')->field('typename')->find($typeid);
        }
        $assign_data['arctype_info'] = $arctype_info;
        /*--end*/

        /*选项卡*/
        $tab = input('param.tab/d', 3);
        $assign_data['tab'] = $tab;
        /*--end*/

        $this->assign($assign_data);
        
        return $this->fetch();
    }





    /**
     * 列表
     */
    public function course_index()
    {
        $assign_data = array();
        $condition = array();
        // 获取到所有GET参数
        $param = input('param.');
        $flag = input('flag/s');
        $typeid = input('typeid/d', 0);
        $begin = strtotime(input('add_time_begin'));
        $end = strtotime(input('add_time_end'));
        // dump(input());die;
        // 应用搜索条件
        foreach (['keywords','typeid','flag','is_release'] as $key) {
            if (isset($param[$key]) && $param[$key] !== '') {
                if ($key == 'keywords') {
                    $condition['a.title'] = array('LIKE', "%{$param[$key]}%");
                } else if ($key == 'typeid') {
                    $typeid = $param[$key];
                    $hasRow = model('Arctype')->getHasChildren($typeid);
                    $typeids = get_arr_column($hasRow, 'id');
                    /*权限控制 by 小虎哥*/
                    $admin_info = session('admin_info');
                    if (0 < intval($admin_info['role_id'])) {
                        $auth_role_info = $admin_info['auth_role_info'];
                        if(! empty($auth_role_info)){
                            if(isset($auth_role_info['only_oneself']) && 1 == $auth_role_info['only_oneself']){
                                $condition['a.admin_id'] = $admin_info['admin_id'];
                            }
                            if(! empty($auth_role_info['permission']['arctype'])){
                                if (!empty($typeid)) {
                                    $typeids = array_intersect($typeids, $auth_role_info['permission']['arctype']);
                                }
                            }
                        }
                    }
                    /*--end*/
                    $condition['a.typeid'] = array('IN', $typeids);
                } else if ($key == 'flag') {
                    if ('is_release' == $param[$key]) {
                        $condition['a.users_id'] = array('gt', 0);
                    } else {
                        $condition['a.'.$param[$key]] = array('eq', 1);
                    }
                // } else if ($key == 'is_release') {
                //     if (0 < intval($param[$key])) {
                //         $condition['a.users_id'] = array('gt', intval($param[$key]));
                //     }
                } else {
                    $condition['a.'.$key] = array('eq', $param[$key]);
                }
            }
        }

        $condition['a.cou_id'] = input('id');
        // 时间检索
        if ($begin > 0 && $end > 0) {
            $condition['a.add_time'] = array('between',"$begin,$end");
        } else if ($begin > 0) {
            $condition['a.add_time'] = array('egt', $begin);
        } else if ($end > 0) {
            $condition['a.add_time'] = array('elt', $end);
        }

        // 模型ID
        $condition['a.channel'] = array('eq', $this->channeltype);
        // 多语言
        $condition['a.lang'] = array('eq', $this->admin_lang);
        // 回收站
        $condition['a.is_del'] = array('eq', 0);

        /*自定义排序*/
        $orderby = input('param.orderby/s');
        $orderway = input('param.orderway/s');
        if (!empty($orderby)) {
            $orderby = "a.{$orderby} {$orderway}";
            $orderby .= ", a.aid desc";
        } else {
            $orderby = "a.aid desc";
        }
        /*end*/

        /**
         * 数据查询，搜索出主键ID的值
         */
        $count = DB::name('archives')->alias('a')->where($condition)->count('aid');// 查询满足要求的总记录数
        $Page = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $fields = "b.*, a.*, a.aid as aid";
        $list = DB::name('archives')
            ->field($fields)
            ->alias('a')
            ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')

            ->where($condition)
            ->order($orderby)
            ->limit($Page->firstRow.','.$Page->listRows)
            ->getAllWithIndex('aid');
        foreach ($list as $key => $val) {
            $val['arcurl'] = get_arcurl($val);
            $val['litpic'] = handle_subdir_pic($val['litpic']); // 支持子目录
            $list[$key] = $val;
        }
        $show = $Page->show(); // 分页显示输出
        $assign_data['page'] = $show; // 赋值分页输出
        $assign_data['list'] = $list; // 赋值数据集
        $assign_data['pager'] = $Page; // 赋值分页对象

        // 栏目ID
        $assign_data['typeid'] = $typeid; // 栏目ID
        /*当前栏目信息*/
        $arctype_info = array();
        if ($typeid > 0) {
            $arctype_info = M('arctype')->field('typename')->find($typeid);
        }
        $assign_data['arctype_info'] = $arctype_info;
        /*--end*/

        /*选项卡*/
        $tab = input('param.tab/d', 3);
        $assign_data['tab'] = $tab;
        /*--end*/

        $this->assign($assign_data);
        
        return $this->fetch();
    }


    /**
     * 添加
     */
    public function add()
    {
        if (IS_POST) {
            $post = input('post.');
            $content = input('post.addonFieldExt.content', '', null);

            // 根据标题自动提取相关的关键字
            $seo_keywords = $post['seo_keywords'];
            if (!empty($seo_keywords)) {
                $seo_keywords = str_replace('，', ',', $seo_keywords);
            } else {
                // $seo_keywords = get_split_word($post['title'], $content);
            }

            // 自动获取内容第一张图片作为封面图
            $is_remote = !empty($post['is_remote']) ? $post['is_remote'] : 0;
            $litpic = '';
            if ($is_remote == 1) {
                $litpic = $post['litpic_remote'];
            } else {
                $litpic = $post['litpic_local'];
            }
            if (empty($litpic)) {
                $litpic = get_html_first_imgurl($content);
            }
            $post['litpic'] = $litpic;

            /*是否有封面图*/
            if (empty($post['litpic'])) {
                $is_litpic = 0; // 无封面图
            } else {
                $is_litpic = 1; // 有封面图
            }

            // SEO描述
            $seo_description = '';
            if (empty($post['seo_description']) && !empty($content)) {
                $seo_description = @msubstr(checkStrHtml($content), 0, config('global.arc_seo_description_length'), false);
            } else {
                $seo_description = $post['seo_description'];
            }

            // 外部链接跳转
            $jumplinks = '';
            $is_jump = isset($post['is_jump']) ? $post['is_jump'] : 0;
            if (intval($is_jump) > 0) {
                $jumplinks = $post['jumplinks'];
            }

            // 模板文件，如果文档模板名与栏目指定的一致，默认就为空。让它跟随栏目的指定而变
            if ($post['type_tempview'] == $post['tempview']) {
                unset($post['type_tempview']);
                unset($post['tempview']);
            }

            // --存储数据
            $newData = array(
                'typeid'=> empty($post['typeid']) ? 0 : $post['typeid'],
                'channel'   => $this->channeltype,
                'is_b'      => empty($post['is_b']) ? 0 : $post['is_b'],
                'is_head'      => empty($post['is_head']) ? 0 : $post['is_head'],
                'is_special'      => empty($post['is_special']) ? 0 : $post['is_special'],
                'is_recom'      => empty($post['is_recom']) ? 0 : $post['is_recom'],
                'is_jump'     => $is_jump,
                'is_litpic'     => $is_litpic,
                'jumplinks' => $jumplinks,
                'seo_keywords'     => $seo_keywords,
                'seo_description'     => $seo_description,
                'admin_id'  => session('admin_info.admin_id'),
                'lang'  => $this->admin_lang,
                'sort_order'    => 100,
                'add_time'     => strtotime($post['add_time']),
                'update_time'  => strtotime($post['add_time']),
            );
            $data = array_merge($post, $newData);

            $aid = M('course')->insertGetId($data);
            $_POST['aid'] = $aid;
            if ($aid) {
                // ---------后置操作
                model('Download')->afterSave($aid, $data, 'add');
                // ---------end
                adminLog('新增视频：'.$data['title']);

                // 生成静态页面代码
                $successData = [
                    'aid'   => $aid,
                    'tid'   => $post['typeid'],
                ];
                $this->success("操作成功!", null, $successData);
                exit;
            }

            $this->error("操作失败!");
            exit;
        }

        $typeid = input('param.typeid/d', 0);
        $assign_data['typeid'] = $typeid; // 栏目ID

        // 栏目信息
        $arctypeInfo = Db::name('arctype')->find($typeid);
        $assign_data['typename'] = $arctypeInfo['typename'];
        // dump($typeid);
        // dump($arctypeInfo);die;
        // /*允许发布文档列表的栏目*/
        //$arctype_html = allow_release_arctype($typeid, array($this->channeltype));
        // $assign_data['arctype_html'] = $arctype_html;
        /*--end*/

        /*自定义字段*/
        $addonFieldExtList = model('Field')->getChannelFieldList($this->channeltype);
        $channelfieldBindRow = Db::name('channelfield_bind')->where([
                'typeid'    => ['IN', [0,$typeid]],
            ])->column('field_id');
        if (!empty($channelfieldBindRow)) {
            foreach ($addonFieldExtList as $key => $val) {
                if (!in_array($val['id'], $channelfieldBindRow)) {
                    unset($addonFieldExtList[$key]);
                }
            }
        }
        $assign_data['addonFieldExtList'] = $addonFieldExtList;
        $assign_data['aid'] = 0;
        /*--end*/

        // 阅读权限
        $arcrank_list = get_arcrank_list();
        $assign_data['arcrank_list'] = $arcrank_list;

        /*模板列表*/
        $archivesLogic = new \app\admin\logic\ArchivesLogic;
        $templateList = $archivesLogic->getTemplateList($this->nid);
        $this->assign('templateList', $templateList);
        /*--end*/

        /*默认模板文件*/
        $tempview = 'view_'.$this->nid.'.'.config('template.view_suffix');
        !empty($arctypeInfo['tempview']) && $tempview = $arctypeInfo['tempview'];
        $this->assign('tempview', $tempview);
        /*--end*/

        /*会员等级信息*/
        $assign_data['users_level'] = DB::name('users_level')->field('level_id,level_name')->where('lang',$this->admin_lang)->select();
        /*--end*/

        /*下载模型自定义属性字段*/
        $attr_field = Db::name('download_attr_field')->where('field_use',1)->select();
        $assign_data['attr_field'] = $attr_field;
        /*--end*/
        // dump($assign_data);die;
        $this->assign($assign_data);

        return $this->fetch();
    }



    /**
     * 添加
     */
    public function course_add()
    {
        if (IS_POST) {
            $post = input('post.');
            $content = input('post.addonFieldExt.content', '', null);

            // 根据标题自动提取相关的关键字
            $seo_keywords = $post['seo_keywords'];
            if (!empty($seo_keywords)) {
                $seo_keywords = str_replace('，', ',', $seo_keywords);
            } else {
                // $seo_keywords = get_split_word($post['title'], $content);
            }

            // 自动获取内容第一张图片作为封面图
            $is_remote = !empty($post['is_remote']) ? $post['is_remote'] : 0;
            $litpic = '';
            if ($is_remote == 1) {
                $litpic = $post['litpic_remote'];
            } else {
                $litpic = $post['litpic_local'];
            }
            if (empty($litpic)) {
                $litpic = get_html_first_imgurl($content);
            }
            $post['litpic'] = $litpic;

            /*是否有封面图*/
            if (empty($post['litpic'])) {
                $is_litpic = 0; // 无封面图
            } else {
                $is_litpic = 1; // 有封面图
            }

            // SEO描述
            $seo_description = '';
            if (empty($post['seo_description']) && !empty($content)) {
                $seo_description = @msubstr(checkStrHtml($content), 0, config('global.arc_seo_description_length'), false);
            } else {
                $seo_description = $post['seo_description'];
            }

            // 外部链接跳转
            $jumplinks = '';
            $is_jump = isset($post['is_jump']) ? $post['is_jump'] : 0;
            if (intval($is_jump) > 0) {
                $jumplinks = $post['jumplinks'];
            }

            // 模板文件，如果文档模板名与栏目指定的一致，默认就为空。让它跟随栏目的指定而变
            if ($post['type_tempview'] == $post['tempview']) {
                unset($post['type_tempview']);
                unset($post['tempview']);
            }

            // --存储数据
            $newData = array(
                'typeid'=> empty($post['typeid']) ? 0 : $post['typeid'],
                'channel'   => $this->channeltype,
                'is_b'      => empty($post['is_b']) ? 0 : $post['is_b'],
                'is_head'      => empty($post['is_head']) ? 0 : $post['is_head'],
                'is_special'      => empty($post['is_special']) ? 0 : $post['is_special'],
                'is_recom'      => empty($post['is_recom']) ? 0 : $post['is_recom'],
                'is_jump'     => $is_jump,
                'is_litpic'     => $is_litpic,
                'jumplinks' => $jumplinks,
                'seo_keywords'     => $seo_keywords,
                'seo_description'     => $seo_description,
                'admin_id'  => session('admin_info.admin_id'),
                'lang'  => $this->admin_lang,
                'sort_order'    => 100,
                'add_time'     => strtotime($post['add_time']),
                'update_time'  => strtotime($post['add_time']),
                
            );

            $data = array_merge($post, $newData);

            $aid = M('archives')->insertGetId($data);

            $_POST['aid'] = $aid;
            if ($aid) {
               
                // ---------后置操作
                model('Download')->afterSaveCourse($aid, $data, 'add');
                // ---------end
                adminLog('新增下载：'.$data['title']);

                // 生成静态页面代码
                $successData = [
                    'aid'   => $aid,
                    'tid'   => $post['typeid'],
                ];
                $this->success("操作成功!", 'download/course_index&id='.$post['cou_id'].'&typeid='.$post['typeid']);
                exit;
            }

            $this->error("操作失败!");
            exit;
        }

        $typeid = input('param.typeid/d', 0);
        // $assign_data['typeid'] = $typeid; // 栏目ID

        // // 栏目信息
        // $arctypeInfo = Db::name('arctype')->find($typeid);

        /*允许发布文档列表的栏目*/
        $assign_data['typeid'] = $typeid; // 栏目ID

        // 栏目信息
        $arctypeInfo = Db::name('arctype')->find($typeid);
        $assign_data['typename'] = $arctypeInfo['typename'];
        $assign_data['id'] = input('id');

        // $arctype_html = allow_release_arctype($typeid, array($this->channeltype));
        // $assign_data['arctype_html'] = $arctype_html;
        /*--end*/

        /*自定义字段*/
        $addonFieldExtList = model('Field')->getChannelFieldList($this->channeltype);
        $channelfieldBindRow = Db::name('channelfield_bind')->where([
                'typeid'    => ['IN', [0,$typeid]],
            ])->column('field_id');
        if (!empty($channelfieldBindRow)) {
            foreach ($addonFieldExtList as $key => $val) {
                if (!in_array($val['id'], $channelfieldBindRow)) {
                    unset($addonFieldExtList[$key]);
                }
            }
        }
        $assign_data['addonFieldExtList'] = $addonFieldExtList;
        $assign_data['aid'] = 0;
        /*--end*/

        // 阅读权限
        $arcrank_list = get_arcrank_list();
        $assign_data['arcrank_list'] = $arcrank_list;

        /*模板列表*/
        $archivesLogic = new \app\admin\logic\ArchivesLogic;
        $templateList = $archivesLogic->getTemplateList($this->nid);
        $this->assign('templateList', $templateList);
        /*--end*/

        /*默认模板文件*/
        $tempview = 'view_'.$this->nid.'.'.config('template.view_suffix');
        !empty($arctypeInfo['tempview']) && $tempview = $arctypeInfo['tempview'];
        $this->assign('tempview', $tempview);
        /*--end*/

        /*会员等级信息*/
        $assign_data['users_level'] = DB::name('users_level')->field('level_id,level_name')->where('lang',$this->admin_lang)->select();
        /*--end*/

        //查询到有哪些章节
        $assign_data['chapter'] = Db::table('hw_course_chapter')
            ->field('id,title')
            ->where('cou_id',$assign_data['id'])
            ->select();
        


        /*下载模型自定义属性字段*/
        $attr_field = Db::name('download_attr_field')->where('field_use',1)->select();
        $assign_data['attr_field'] = $attr_field;
        /*--end*/
        // dump($assign_data);die;
        $this->assign($assign_data);

        return $this->fetch();
    }

    //课程编辑
    /**
     * 编辑
     */
    public function edit()
    {
        if (IS_POST) {
            $post = input('post.');

            $typeid = input('post.typeid/d', 0);
            $content = input('post.addonFieldExt.content', '', null);

            // 根据标题自动提取相关的关键字
            $seo_keywords = $post['seo_keywords'];
            if (!empty($seo_keywords)) {
                $seo_keywords = str_replace('，', ',', $seo_keywords);
            } else {
                // $seo_keywords = get_split_word($post['title'], $content);
            }

            // 自动获取内容第一张图片作为封面图
            $is_remote = !empty($post['is_remote']) ? $post['is_remote'] : 0;
            $litpic = '';
            if ($is_remote == 1) {
                $litpic = $post['litpic_remote'];
            } else {
                $litpic = $post['litpic_local'];
            }
            if (empty($litpic)) {
                $litpic = get_html_first_imgurl($content);
            }
            $post['litpic'] = $litpic;

            /*是否有封面图*/
            if (empty($post['litpic'])) {
                $is_litpic = 0; // 无封面图
            } else {
                $is_litpic = !empty($post['is_litpic']) ? $post['is_litpic'] : 0; // 有封面图
            }

            // SEO描述
            $seo_description = '';
            if (empty($post['seo_description']) && !empty($content)) {
                $seo_description = @msubstr(checkStrHtml($content), 0, config('global.arc_seo_description_length'), false);
            } else {
                $seo_description = $post['seo_description'];
            }

            // --外部链接
            $jumplinks = '';
            $is_jump = isset($post['is_jump']) ? $post['is_jump'] : 0;
            if (intval($is_jump) > 0) {
                $jumplinks = $post['jumplinks'];
            }

            // 模板文件，如果文档模板名与栏目指定的一致，默认就为空。让它跟随栏目的指定而变
            if ($post['type_tempview'] == $post['tempview']) {
                unset($post['type_tempview']);
                unset($post['tempview']);
            }

            // 同步栏目切换模型之后的文档模型
            $channel = Db::name('arctype')->where(['id'=>$typeid])->getField('current_channel');
            // --存储数据
            $newData = array(
                'typeid'=> $typeid,
                'channel'   => $channel,
                'is_b'      => empty($post['is_b']) ? 0 : $post['is_b'],
                'is_head'      => empty($post['is_head']) ? 0 : $post['is_head'],
                'is_special'      => empty($post['is_special']) ? 0 : $post['is_special'],
                'is_recom'      => empty($post['is_recom']) ? 0 : $post['is_recom'],
                'is_jump'   => $is_jump,
                'is_litpic'     => $is_litpic,
                'jumplinks' => $jumplinks,
                'seo_keywords'     => $seo_keywords,
                'seo_description'     => $seo_description,
                'add_time'     => strtotime($post['add_time']),
                'update_time'     => getTime(),
            );
           // dump($post);die;
            $data = array_merge($post, $newData);

            $r = M('course')->where([
                    'aid'   => $data['aid'],
                    'lang'  => $this->admin_lang,
                ])->update($data);
            
            if ($r) {
                // ---------后置操作
                 model('Download')->afterSave($data['aid'], $data, 'edit');
                // // ---------end
                 adminLog('编辑下载：'.$data['title']);

                // 生成静态页面代码
                $successData = [
                    'aid'       => $data['aid'],
                    'tid'       => $typeid,
                ];
                $this->success("操作成功!", 'download/index&typeid='.$typeid);
                exit;
            }

            $this->error("操作失败!");
            exit;
        }

        $assign_data = array();

        $id = input('id/d');
        $info = model('Download')->getCourseInfo($id);
        if (empty($info)) {
            $this->error('数据不存在，请联系管理员！');
            exit;
        }

        /*兼容采集没有归属栏目的文档*/
        if (empty($info['channel'])) {
            $channelRow = Db::name('channeltype')->field('id as channel')
                ->where('id',$this->channeltype)
                ->find();
            $info = array_merge($info, $channelRow);
        }
        /*--end*/
        $typeid = $info['typeid'];

        // 栏目信息
        $arctypeInfo = Db::name('arctype')->find($typeid);

        $assign_data['typeid'] = $typeid; // 栏目ID

        // 栏目信息
        $assign_data['typename'] = $arctypeInfo['typename'];

        $info['channel'] = $arctypeInfo['current_channel'];
        if (is_http_url($info['litpic'])) {
            $info['is_remote'] = 1;
            $info['litpic_remote'] = handle_subdir_pic($info['litpic']);
        } else {
            $info['is_remote'] = 0;
            $info['litpic_local'] = handle_subdir_pic($info['litpic']);
        }
    
        // SEO描述
        if (!empty($info['seo_description'])) {
            $info['seo_description'] = @msubstr(checkStrHtml($info['seo_description']), 0, config('global.arc_seo_description_length'), false);
        }
        
        $assign_data['field'] = $info;

        // 下载文件
        $downfile_list = model('DownloadFile')->getDownFile($id);
        $assign_data['downfile_list'] = $downfile_list;

        // 下载文件中是否存在远程链接
        $is_remote_file = 0;
        foreach ($downfile_list as $key => $value) {
            if (1 == $value['is_remote']) {
                $is_remote_file = 1;
                break;
            }
        }
        $assign_data['is_remote_file'] = $is_remote_file;

        /*允许发布文档列表的栏目，文档所在模型以栏目所在模型为主，兼容切换模型之后的数据编辑*/
        // $arctype_html = allow_release_arctype($typeid, array($info['channel']));
        // $assign_data['arctype_html'] = $arctype_html;
        /*--end*/
        
        /*自定义字段*/
        $addonFieldExtList = model('Field')->getChannelFieldList($info['channel'], 0, $id, $info);
        $channelfieldBindRow = Db::name('channelfield_bind')->where([
                'typeid'    => ['IN', [0,$typeid]],
            ])->column('field_id');
        if (!empty($channelfieldBindRow)) {
            foreach ($addonFieldExtList as $key => $val) {
                if (!in_array($val['id'], $channelfieldBindRow)) {
                    unset($addonFieldExtList[$key]);
                }
            }
        }
        $assign_data['addonFieldExtList'] = $addonFieldExtList;
        $assign_data['aid'] = $id;
        /*--end*/

        // 阅读权限
        $arcrank_list = get_arcrank_list();
        $assign_data['arcrank_list'] = $arcrank_list;

        /*模板列表*/
        $archivesLogic = new \app\admin\logic\ArchivesLogic;
        $templateList = $archivesLogic->getTemplateList($this->nid);
        $this->assign('templateList', $templateList);
        /*--end*/

        /*默认模板文件*/
        $tempview = $info['tempview'];
        empty($tempview) && $tempview = $arctypeInfo['tempview'];
        $this->assign('tempview', $tempview);
        /*--end*/

        /*会员等级信息*/
        $assign_data['users_level'] = DB::name('users_level')->field('level_id,level_name')->where('lang',$this->admin_lang)->select();
        /*--end*/

        /*下载模型自定义属性字段*/
        $attr_field = Db::name('download_attr_field')->where('field_use',1)->select();
        $assign_data['attr_field'] = $attr_field;
        /*--end*/
       // dump($assign_data);die;
        $this->assign($assign_data);
        return $this->fetch();
    }

    
    /**
     * 编辑
     */
    public function course_edit()
    {
        if (IS_POST) {
            $post = input('post.');

            $typeid = input('post.typeid/d', 0);
            $content = input('post.addonFieldExt.content', '', null);

            // 根据标题自动提取相关的关键字
            $seo_keywords = $post['seo_keywords'];
            if (!empty($seo_keywords)) {
                $seo_keywords = str_replace('，', ',', $seo_keywords);
            } else {
                // $seo_keywords = get_split_word($post['title'], $content);
            }

            // 自动获取内容第一张图片作为封面图
            $is_remote = !empty($post['is_remote']) ? $post['is_remote'] : 0;
            $litpic = '';
            if ($is_remote == 1) {
                $litpic = $post['litpic_remote'];
            } else {
                $litpic = $post['litpic_local'];
            }
            if (empty($litpic)) {
                $litpic = get_html_first_imgurl($content);
            }
            $post['litpic'] = $litpic;

            /*是否有封面图*/
            if (empty($post['litpic'])) {
                $is_litpic = 0; // 无封面图
            } else {
                $is_litpic = !empty($post['is_litpic']) ? $post['is_litpic'] : 0; // 有封面图
            }

            // SEO描述
            $seo_description = '';
            if (empty($post['seo_description']) && !empty($content)) {
                $seo_description = @msubstr(checkStrHtml($content), 0, config('global.arc_seo_description_length'), false);
            } else {
                $seo_description = $post['seo_description'];
            }

            // --外部链接
            $jumplinks = '';
            $is_jump = isset($post['is_jump']) ? $post['is_jump'] : 0;
            if (intval($is_jump) > 0) {
                $jumplinks = $post['jumplinks'];
            }

            // 模板文件，如果文档模板名与栏目指定的一致，默认就为空。让它跟随栏目的指定而变
            if ($post['type_tempview'] == $post['tempview']) {
                unset($post['type_tempview']);
                unset($post['tempview']);
            }

            // 同步栏目切换模型之后的文档模型
            $channel = Db::name('arctype')->where(['id'=>$typeid])->getField('current_channel');
            // --存储数据
            $newData = array(
                'typeid'=> $typeid,
                'channel'   => $channel,
                'is_b'      => empty($post['is_b']) ? 0 : $post['is_b'],
                'is_head'      => empty($post['is_head']) ? 0 : $post['is_head'],
                'is_special'      => empty($post['is_special']) ? 0 : $post['is_special'],
                'is_recom'      => empty($post['is_recom']) ? 0 : $post['is_recom'],
                'is_jump'   => $is_jump,
                'is_litpic'     => $is_litpic,
                'jumplinks' => $jumplinks,
                'seo_keywords'     => $seo_keywords,
                'seo_description'     => $seo_description,
                'add_time'     => strtotime($post['add_time']),
                'update_time'     => getTime(),

            );

            $data = array_merge($post, $newData);
            //dump($data);die;
            $r = M('archives')->where([
                    'aid'   => $data['aid'],
                    'lang'  => $this->admin_lang,
                ])->update($data);
            
            if ($r) {
                // ---------后置操作
                model('Download')->afterSaveCourse($data['aid'], $data, 'edit');
                // ---------end
                adminLog('编辑下载：'.$data['title']);

                // 生成静态页面代码
                $successData = [
                    'aid'       => $data['aid'],
                    'tid'       => $typeid,
                ];
                $this->success("操作成功!", 'download/course_index&id='.$post['cou_id'].'&typeid='.$post['typeid']);
                exit;
            }

            $this->error("操作失败!");
            exit;
        }

        $assign_data = array();

        $id = input('id/d');
        $info = model('Download')->getInfo($id);

        if (empty($info)) {
            $this->error('数据不存在，请联系管理员！');
            exit;
        }
        /*兼容采集没有归属栏目的文档*/
        if (empty($info['channel'])) {
            $channelRow = Db::name('channeltype')->field('id as channel')
                ->where('id',$this->channeltype)
                ->find();
            $info = array_merge($info, $channelRow);
        }
        /*--end*/

        $typeid = $info['typeid'];

        // 栏目信息
        $arctypeInfo = Db::name('arctype')->find($typeid);

        $assign_data['typeid'] = $typeid; // 栏目ID

        // 栏目信息
        $assign_data['typename'] = $arctypeInfo['typename'];


        $info['channel'] = $arctypeInfo['current_channel'];
        if (is_http_url($info['litpic'])) {
            $info['is_remote'] = 1;
            $info['litpic_remote'] = handle_subdir_pic($info['litpic']);
        } else {
            $info['is_remote'] = 0;
            $info['litpic_local'] = handle_subdir_pic($info['litpic']);
        }
    
        // SEO描述
        if (!empty($info['seo_description'])) {
            $info['seo_description'] = @msubstr(checkStrHtml($info['seo_description']), 0, config('global.arc_seo_description_length'), false);
        }
        
        $assign_data['field'] = $info;

        // 下载文件
        $downfile_list = model('DownloadFile')->getDownFile($id);
        $assign_data['downfile_list'] = $downfile_list;

        // 下载文件中是否存在远程链接
        $is_remote_file = 0;
        foreach ($downfile_list as $key => $value) {
            if (1 == $value['is_remote']) {
                $is_remote_file = 1;
                break;
            }
        }
        $assign_data['is_remote_file'] = $is_remote_file;

        /*允许发布文档列表的栏目，文档所在模型以栏目所在模型为主，兼容切换模型之后的数据编辑*/
        $arctype_html = allow_release_arctype($typeid, array($info['channel']));
        $assign_data['arctype_html'] = $arctype_html;
        /*--end*/
        
        /*自定义字段*/
        $addonFieldExtList = model('Field')->getChannelFieldList($info['channel'], 0, $id, $info);
        $channelfieldBindRow = Db::name('channelfield_bind')->where([
                'typeid'    => ['IN', [0,$typeid]],
            ])->column('field_id');
        if (!empty($channelfieldBindRow)) {
            foreach ($addonFieldExtList as $key => $val) {
                if (!in_array($val['id'], $channelfieldBindRow)) {
                    unset($addonFieldExtList[$key]);
                }
            }
        }
        $assign_data['addonFieldExtList'] = $addonFieldExtList;
        $assign_data['aid'] = $id;
        /*--end*/

        // 阅读权限
        $arcrank_list = get_arcrank_list();
        $assign_data['arcrank_list'] = $arcrank_list;

        /*模板列表*/
        $archivesLogic = new \app\admin\logic\ArchivesLogic;
        $templateList = $archivesLogic->getTemplateList($this->nid);
        $this->assign('templateList', $templateList);
        /*--end*/

        /*默认模板文件*/
        $tempview = $info['tempview'];
        empty($tempview) && $tempview = $arctypeInfo['tempview'];
        $this->assign('tempview', $tempview);
        /*--end*/

        /*会员等级信息*/
        $assign_data['users_level'] = DB::name('users_level')->field('level_id,level_name')->where('lang',$this->admin_lang)->select();
        /*--end*/

        /*下载模型自定义属性字段*/
        $attr_field = Db::name('download_attr_field')->where('field_use',1)->select();
        $assign_data['attr_field'] = $attr_field;
        /*--end*/

        //查询到有哪些章节
        $assign_data['chapter'] = Db::table('hw_course_chapter')
            ->field('id,title')
            ->where('cou_id',$info['cou_id'])
            ->select();
       


        $this->assign($assign_data);
        return $this->fetch();
    }
    

    /**
     * 文章删除
     */
    public function del()
    {
        if (IS_POST) {

            //查询是否有视频
            $id = input('del_id');
            $data = Db::name('archives')->where('cou_id',$id)->limit(1)->find();

            if(!empty($data)){
               $this->error('该课程下有视频，暂时不能删除');exit;
            }
            $archivesLogic = new \app\admin\logic\ArchivesLogic;
            $archivesLogic->course_del();
        }
    }

    /**
     * 删除
     */
    public function course_del()
    {
        if (IS_POST) {
            $archivesLogic = new \app\admin\logic\ArchivesLogic;
            $archivesLogic->del();
        }
    }

    public function template_set()
    {

        if (IS_AJAX_POST) {
            $post = input('post.');

            // 修改是否使用
            if (!empty($post) && isset($post['field_use'])) {
                $data['field_use']   = $post['field_use'];
                $data['update_time'] = getTime();
                Db::name('download_attr_field')->where('field_id',$post['field_id'])->update($data);
                $this->success("更新成功！");
            }
            // 修改标题
            if (!empty($post) && isset($post['field_title'])) {
                $data['field_title'] = $post['field_title'];
                $data['update_time'] = getTime();
                Db::name('download_attr_field')->where('field_id',$post['field_id'])->update($data);
                $this->success("更新成功！");
            }
        }

        $list = Db::name('download_attr_field')->select();
        $assign_data['list'] = $list;
        $this->assign($assign_data);
        return $this->fetch();
    }

    public function get_template()
    {
        if (IS_AJAX_POST) {
            $list = Db::name('download_attr_field')->where('field_use',1)->select();
            $this->success("查询成功！", null, $list);
        }
    }

    //章节列表
    public function chapter($id){

        //dump($id);

        $title = Db::table('hw_course')->field('typeid,title,aid')->where('aid',$id)->limit(1)->find();
        $chapterList = Db::name('course_chapter')
            ->where('cou_id',$id)
            ->select();
        $this->assign('title',$title);
        // dump($chapterList);
        $this->assign('chapterList',$chapterList);
        return $this->fetch();
    }

//添加章节
    public function add_chapter($id){
        if(IS_POST){
            $data = input();
            // --存储数据
            $newData = array(
                'cou_id'=>$data['id'],
                'order'    => $data['order'],
                'title'=>$data['title'],
                'add_time'     => time(),
                'update_time'  => time(),
            );
            $aid = Db::name('course_chapter')->insertGetId($newData);
            if ($aid) {
                // ---------后置操作
               // model('Download')->afterSave($aid, $data, 'add');
                // ---------end
               // adminLog('新增下载：'.$data['title']);
                // 生成静态页面代码
                $this->success("操作成功!", 'download/chapter&id='.$data['id']);
                exit;
            }

            $this->error("操作失败!");
            exit;
        }


        $title = Db::table('hw_course')->field('typeid,title,aid')->where('aid',$id)->limit(1)->find();
        // dump($title);
        $this->assign('title',$title);
        return $this->fetch();
    }

//编辑章节
    public function edit_chapter($id){

        if(IS_POST){

            $data = input();

            Db::name('course_chapter')
                ->where('id',$data['id'])
                ->update([
                    'order'=>$data['order'],
                    'title'=>$data['title'],
                ]);
            $this->success("操作成功!", 'download/chapter&id='.$data['cou_id']);
            exit;
        }


        $chapter = Db::table('hw_course_chapter')
            ->where('id',$id)
            ->limit(1)
            ->find();
        //所属课程
        $title = Db::table('hw_course')->field('typeid,title,aid')->where('aid',$chapter['cou_id'])->limit(1)->find();
        $this->assign('title',$title);
        $this->assign('chapter',$chapter);
        return $this->fetch();

    }

    /**
     * 删除
     */
    public function chapter_del()
    {
        if (IS_POST) {

            $id = input('del_id');
            $typeid = Db::name('archives')->where('cha_id',$id)->limit(1)->find();
            if(!empty($typeid)){

                $this->error('删除失败，该章节下存在视频文章');
            }else{

                Db::name('course_chapter')->where('id',$id)->delete();
                $this->success('删除成功！');
            }
            // dump(input());die;
            // $archivesLogic = new \app\admin\logic\ArchivesLogic;
            // $archivesLogic->del();
        }
    }



}