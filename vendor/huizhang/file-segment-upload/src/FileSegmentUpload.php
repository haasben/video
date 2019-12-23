<?php
/**
 * @CreateTime:   2019/8/3 下午1:48
 * @Author:       huizhang  <tuzisir@163.com>
 * @Copyright:    copyright(2019) huizhang all rights reserved
 * @Description:  大文件分段上传
 */
namespace Huizhang\FileSegmentUpload;

class FileSegmentUpload{

    // 临时文件分隔符
    const FILE_SPLIT = '@Split@';
    private static $path;

    /**
     * 上传目录
     *
     * @var mixed|string
     * CreateTime: 2019/7/29 下午11:43
     */
    private static $filePath = '.';

    /**
     * 文件临时目录
     *
     * @var mixed
     * CreateTime: 2019/7/29 下午11:43
     */
    private static $tmpPath;

    /**
     * 第几个文件包
     *
     * @var mixed
     * CreateTime: 2019/7/29 下午11:43
     */
    private static $nowPackageNum;

    /**
     * 文件包总数
     *
     * @var mixed
     * CreateTime: 2019/7/29 下午11:44
     */
    private static $totalPackageNum;

    /**
     * 文件名
     *
     * @var mixed
     * CreateTime: 2019/7/29 下午11:44
     */
    private static $fileName; //文件名

    /**
     * 文件完全地址
     *
     * @var
     * CreateTime: 2019/7/29 下午11:53
     */
    private static $pathFileName;

    /**
     * 每次上传的临时文件
     *
     * @var
     * CreateTime: 2019/8/6 下午9:40
     */
    private static $tmpPathFile;

    /**
     * 超过多长时间的临时文件清理掉
     *
     * @var int
     * CreateTime: 2019/8/11 上午12:24
     */
    private static $clearIntervalTime=5;

    /**
     * 是否断点续传
     *
     * @var bool
     * CreateTime: 2019/8/11 上午12:36
     */
    private static $isContinuingly=true;

    /**
     * 初始化参数
     *
     * CreateTime: 2019/7/29 下午11:55
     */
    private function init(array $config=[]) {
       // dump($config);die;
        if (isset($config['file_path'])) {
            self::$filePath = $config['file_path'];
        }
        if (isset($config['tmp_name'])) {
            self::$tmpPath = $config['tmp_name'];
        }
        if (isset($config['now_package_num'])) {
            self::$nowPackageNum = $config['now_package_num'];
        }
        if (isset($config['total_package_num'])) {
            self::$totalPackageNum = $config['total_package_num'];
        }
        if (isset($config['file_name'])) {
            self::$fileName = $config['file_name'];
        }
        if (isset($config['clear_interval_time'])) {
            self::$clearIntervalTime = $config['clear_interval_time'];
        }
        if (isset($config['is_continuingly'])) {
            self::$isContinuingly = $config['is_continuingly'];
        }

        self::$path = self::$filePath.'/'. self::$fileName;

        self::$pathFileName = ROOT_PATH.self::$filePath.'/'. self::$fileName;

        self::$tmpPathFile = self::$pathFileName.self::FILE_SPLIT.self::$nowPackageNum;
        $this->mkdir();
    }

    /**
     * 主处理方法
     *
     * CreateTime: 2019/7/29 下午11:48
     */
    public function upload(array $config=[]) {
        // 初始化必要参数
        $this->init($config);
        // 移动包
        $this->movePackage();
        // 合并包
        $this->mergePackage();
        // 检测并删除目录中是否存在过期临时文件
        $this->overdueFile();
        // 返回结果
        return $this->result();
    }

    /**
     * 检测并删除目录中是否存在过期临时文件
     *
     * CreateTime: 2019/8/11 上午12:27
     */
    private function overdueFile() {
        $files = scandir(ROOT_PATH.self::$filePath);
        foreach ($files as $key => $val) {
            if (strpos($val,self::FILE_SPLIT) !== false) {
                $ctime = filectime(self::$filePath.'/'.$val);
                $intervalTime = time()-$ctime+60*self::$clearIntervalTime;
                if ($intervalTime<0) {
                    @unlink(self::$filePath.'/'.$val);
                }
            }
        }
    }


    /**
     * 合并包
     *
     * CreateTime: 2019/7/29 下午11:58
     */
    private function mergePackage(){
        // if(self::$nowPackageNum === self::$totalPackageNum){
            $blob = '';
           // dump(self::$pathFileName.self::FILE_SPLIT.self::$nowPackageNum);
            // for($i=1; $i<= self::$totalPackageNum; $i++){
            $blob = file_get_contents(self::$pathFileName.self::FILE_SPLIT.self::$nowPackageNum);
            //}
            file_put_contents(self::$pathFileName, $blob,FILE_APPEND);
            $this->deletePackage();
        //}
    }

    /**
     * 删除文件包
     *
     * CreateTime: 2019/7/29 下午11:59
     */
    private function deletePackage(){
        //for($i=1; $i<= self::$totalPackageNum; $i++){
            @unlink(self::$pathFileName.self::FILE_SPLIT.self::$nowPackageNum);
        //}
    }

    /**
     * 移动文件包
     *
     * CreateTime: 2019/7/29 下午11:52
     */
    private function movePackage(){
        // dump(self::$tmpPath);
        // dump(self::$tmpPathFile);
        // dump(self::$isContinuingly);die;
        if (file_exists(self::$tmpPathFile) && self::$isContinuingly) {
            return true;
        }
        move_uploaded_file(self::$tmpPath, self::$tmpPathFile);
    }

    /**
     * 上传结果
     *
     * CreateTime: 2019/8/3 下午1:41
     */
    private function result(){
        if(self::$nowPackageNum === self::$totalPackageNum){
            return ['code'=>1,'url'=>self::$path,'path'=>self::$tmpPathFile];
        }
        return ['code'=>200];
    }

    /**
     * 创建目录
     *
     * @return bool
     * CreateTime: 2019/7/29 下午11:56
     */
    private function mkdir(){
     
        if(!file_exists(ROOT_PATH.self::$filePath)){
            mkdir(ROOT_PATH.self::$filePath,0777,true);
        }
    }

}
