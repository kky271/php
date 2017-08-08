<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
use think\Controller;
class Debris extends Common
{
    public function index()
    {
        $key=input('post.key');
        $this->assign('testkey',$key);
        $list=db('debris')->where('title','like',"%".$key."%")->order('addtime desc')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function add(){
        if(request()->isPost()) {
            //构建数组
            $data = input('post.');
            $data['addtime'] = time();
            db('debris')->insert($data);
            $result['code'] = 1;
            $result['msg'] = '碎片添加成功!';
            $result['url'] = url('index');
            return $result;
        }else{
            $this->assign('title',lang('add').lang('debris'));
            $this->assign('info','null');
            return $this->fetch('form');
        }
    }
    public function edit(){
        if(request()->isPost()) {
            $data = input('post.');
            db('debris')->where('id',$data['id'])->update($data);
            $result['code'] = 1;
            $result['msg'] = '碎片修改成功!';
            $result['url'] = url('index');
            return $result;
        }else{
            $id=input('id');
            $info=db('debris')->where(array('id'=>$id))->find();
            $this->assign('info',json_encode($info,true));
            return $this->fetch('form');
        }
    }
    public function del(){
        db('debris')->where('id',input('param.id'))->delete();
        $this->redirect('index');
    }

}