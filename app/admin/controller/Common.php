<?php
namespace app\admin\controller;
use think\Request;
use think\Controller;
class Common extends Controller
{
    protected   $mod,$system , $nav , $menudata , $cache_model,$categorys,$module,$moduleid;
    public function _initialize()
    {
        //判断管理员是否登录
        if (!session('aid')) {
            $this->redirect('login/index');
        }
        $this->system = F('System');
        $this->categorys = F('Category');
        $this->module = F('Module');
        $this->mod = F('Mod');
        $this->cache_model=array('Module','Category','Posid','Field','System');
        if(empty($this->sys)){
            foreach($this->cache_model as $r){
                savecache($r);
            }
        }
        define('MODULE_NAME',strtolower(request()->controller()));
        define('ACTION_NAME',strtolower(request()->action()));
        $this->moduleid = $this->mod[MODULE_NAME];
    }

    //清除缓存
    public function clear(){
        $R = RUNTIME_PATH;
        if ($this->_deleteDir($R)) {
            $result['info'] = '清除缓存成功!';
            $result['status'] = 1;
        } else {
            $result['info'] = '清除缓存失败!';
            $result['status'] = 0;
        }
        $result['url'] = url('Index/home');
        return $result;
    }
    //空操作
    public function _empty(){
        return $this->error('空操作，返回上次访问页面中...');
    }
    private function _deleteDir($R)
    {
        $handle = opendir($R);
        while (($item = readdir($handle)) !== false) {
            if ($item != '.' and $item != '..') {
                if (is_dir($R . '/' . $item)) {
                    $this->_deleteDir($R . '/' . $item);
                } else {
                    if (!unlink($R . '/' . $item))
                        die('error!');
                }
            }
        }
        closedir($handle);
        return rmdir($R);
    }
}
