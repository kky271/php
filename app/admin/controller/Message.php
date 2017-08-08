<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
use think\Controller;
class Message extends Common
{
    public function index(){
        if(request()->isPost()) {
            $key=input('post.key');
            $page =input('pageIndex');
            $pageSize =input('pageSize');
            $list = db('message')->where('name|tel|content', 'like', "%" . $key . "%")->order('addtime desc') ->paginate(array('list_rows'=>$pageSize,'page'=>$page))->toArray();
            $rsult['code'] = 0;
            $rsult['msg'] = "获取成功";
            $rsult['list'] = $list['data'];
            $rsult['count'] = $list['total'];
            $rsult['rel'] = 1;
            echo json_encode($rsult);
            exit;
        }
        return $this->fetch();
    }
    //删除留言
    public function del(){
        $map['message_id']=input('message_id');
        db('message')->where($map)->delete();
        $this->redirect('index');
    }
    public function delall(){
        $map['message_id'] =array('in',input('param.ids'));
        db('message')->where($map)->delete();
        $result['msg'] = '删除成功！';
        $result['url'] = url('index');
        return $result;
    }
}