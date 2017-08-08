<?php
namespace app\admin\controller;
use think\Db;
use clt\Leftnav;
class Auth extends Common
{
    //管理员列表
    public function adminList(){
        $val=input('val');
        $url['val'] = $val;
        $this->assign('testval',$val);
        $map='';
        if($val){
            $map['a.username|a.email|a.tel']= array('like',"%".$val."%");
        }
        if (session('aid')!=1){
            $map['a.admin_id']=session('aid');
        }

        $adminList=Db::table('clt_admin')->alias('a')
            ->join('clt_auth_group ag','a.group_id = ag.group_id','left')
            ->field('a.*,ag.title')
            ->where($map)
            ->paginate(config('pageSize'));
        $adminList->appends($url);
        // 模板变量赋值
        $page = $adminList->render();
        $this->assign('page', $page);
        $this->assign('adminList',$adminList);
        return $this->fetch();
    }

    public function adminAdd(){
        if(request()->isPost()){
            $admin = db('admin');
            $data = input('post.');

            $check_user = $admin->where(array('username'=>$data['username']))->find();
            if ($check_user) {
                $result['status'] = 0;
                $result['info'] = '用户已存在，请重新输入用户名!';
                return $result;
            }
            $data['pwd'] = input('post.pwd', '', 'md5');
            $groupId = explode(':',$data['group_id']);
            $data['group_id'] =$groupId[1];
            $data['add_time'] = time();
            $data['ip'] = request()->ip();

            $admin->insert($data);
            $result['code'] = 1;
            $result['msg'] = '管理员添加成功!';
            $result['url'] = url('adminList');
            return $result;
        }else{
            $auth_group=db('auth_group')->select();
            $this->assign('authGroup',json_encode($auth_group,true));
            $this->assign('title',lang('add').lang('admin'));
            $this->assign('info','null');
            return $this->fetch('adminForm');
        }
    }
    //删除管理员
    public function adminDel(){
        $admin_id=input('get.admin_id');
        if (session('aid')==1){
            if (empty($admin_id)){
                $result['status'] = 0;
                $result['info'] = '用户ID不存在!';
                $result['url'] = url('adminList');
                exit;
            }
            db('admin')->where('admin_id='.$admin_id)->delete();
            $this->redirect('adminList');
        }
    }
    //修改管理员状态
    public function adminState(){
        $id=input('post.id');
        if (empty($id)){
            $result['status'] = 0;
            $result['info'] = '用户ID不存在!';
            $result['url'] = url('adminList');
            exit;
        }
        $status=db('admin')->where('admin_id='.$id)->value('is_open');//判断当前状态情况
        if($status==1){
            $data['is_open'] = 0;
            db('admin')->where('admin_id='.$id)->update($data);
            $result['status'] = 1;
            $result['info'] = '状态禁止';
        }else{
            $data['is_open'] = 1;
            db('admin')->where('admin_id='.$id)->update($data);
            $result['status'] = 1;
            $result['info'] = '状态开启';
        }
        return $result;
    }
    //更新管理员信息
    public function adminEdit(){
        if(request()->isPost()){
            $admin=db('admin');
            $data = input('post.');
            $pwd=input('post.pwd');
            $map['admin_id'] = array('neq',input('post.admin_id'));
            $where['admin_id'] = input('post.admin_id');
            if(input('post.username')){
                $map['username'] = input('post.username');
                $check_user = $admin->where($map)->find();
                if ($check_user) {
                    $result['status'] = 0;
                    $result['info'] = '用户已存在，请重新输入用户名!';
                    exit;
                }
            }
            if ($pwd){
                $data['pwd']=input('post.pwd','','md5');
            }else{
                unset($data['pwd']);
            }
            $groupId = explode(':',$data['group_id']);
            $data['group_id'] =$groupId[1];
            $admin->where($where)->update($data);
            $result['code'] = 1;
            $result['msg'] = '管理员修改成功!';
            $result['url'] = url('adminList');
            return $result;
        }else{
            $auth_group = db('auth_group')->select();
            $info = db('admin')->where('admin_id='.input('admin_id'))->find();
            $this->assign('info', json_encode($info,true));
            $this->assign('authGroup', json_encode($auth_group,true));
            $this->assign('title',lang('edit').lang('admin'));
            return $this->fetch('adminForm');
        }

    }
    /*-----------------------用户组管理----------------------*/
    //用户组管理
    public function adminGroup(){
        $list=db('auth_group')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }
    //删除管理员分组
    public function groupDel(){
        db('auth_group')->where('group_id='.input('id'))->delete();
        $this->redirect('adminGroup');
    }
    //修改分组状态
    public function groupState(){
        $map['group_id']=input('post.id');
        $status=db('auth_group')->where($map)->value('status');//判断当前状态情况
        if($status==1){
            db('auth_group')->where($map)->setField('status',0);
            $result['info'] = '状态禁止';
        }else{
            db('auth_group')->where($map)->setField('status',1);
            $result['info'] = '状态开启';
        }
        $result['status'] = 1;
        return $result;
    }
    //添加分组
    public function groupAdd(){
        if(request()->isPost()){
            $auth_group=db('auth_group');
            $data=input('post.');
            $data['addtime']=time();
            $auth_group->insert($data);
            $result['msg'] = '用户组添加成功!';
            $result['url'] = url('adminGroup');
            $result['code'] = 1;
            return $result;
        }else{
            $this->assign('title','添加用户组');
            $this->assign('info','null');
            return $this->fetch('groupForm');
        }
    }
    //修改分组
    public function groupEdit(){
        if(request()->isPost()) {
            $auth_group=db('auth_group');
            $data=input('post.');
            $map['group_id'] = input('post.group_id');
            $auth_group->where($map)->update($data);
            $result['msg'] = '用户组修改成功!';
            $result['url'] = url('adminGroup');
            $result['code'] = 1;
            return $result;
        }else{
            $id = input('id');
            $info = db('auth_group')->where(array('group_id' => $id))->find();
            $this->assign('info', json_encode($info,true));
            $this->assign('title','编辑用户组');
            return $this->fetch('groupForm');
        }
    }
    //分组配置规则
    public function groupAccess(){
        $nav = new Leftnav();
        $admin_rule=db('auth_rule')->field('id,pid,title')->order('sort asc')->select();
        $rules = db('auth_group')->where('group_id',input('id'))->value('rules');
        $arr = $nav->auth($admin_rule,$pid=0,$rules);
        $arr[] = array(
            "id"=>0,
            "pid"=>0,
            "title"=>"全部",
            "open"=>true
        );
        $this->assign('data',json_encode($arr,true));
        return $this->fetch();
    }
    public function groupSetaccess(){
        $authGroup = db('auth_group');
        if(empty(input('post.rules'))){
            return array('msg'=>'请选择权限!','code'=>0);
        }
        $data['rules'] = input('post.rules');
        $map['group_id'] = input('post.id');
        if($authGroup->where($map)->update($data)!==false){
            return array('msg'=>'权限配置成功!','url'=>url('adminGroup'),'code'=>1);
        }else{
            return array('msg'=>'保存错误','code'=>0);
        }
    }

    /********************************权限管理*******************************/
    public function adminRule(){
        $nav = new Leftnav();
        $admin_rule=db('auth_rule')->order('sort asc')->select();
        $arr = $nav->menu($admin_rule);
        $this->assign('admin_rule',$arr);//权限列表
        return $this->fetch();
    }
    public function ruleAdd(){
        if(request()->isPost()){
            $authRule=db('auth_rule');
            $data = input('post.');
            $data['addtime'] = time();
            $data['status'] = 1;
            $authRule->insert($data);
            $result['msg'] = '权限添加成功!';
            $result['url'] = url('adminRule');
            $result['code'] = 1;
            return $result;
        }else{
            $nav = new Leftnav();
            $admin_rule=db('auth_rule')->field('id,title,pid')->order('sort asc')->select();
            $arr = $nav->menu($admin_rule);
            $this->assign('admin_rule',$arr);//权限列表
            return $this->fetch();
        }
    }
    public function ruleOrder(){
        $auth_rule=db('auth_rule');
        foreach ($_POST as $id => $sort){
            $auth_rule->where('id',$id)->setField('sort',$sort);
        }
        $result['msg'] = '排序更新成功!';
        $result['url'] = url('adminRule');
        $result['code'] = 1;
        return $result;
    }
    public function ruleState(){
        $id=input('post.id');
        $statusone=db('auth_rule')->where(array('id'=>$id))->value('menustatus');//判断当前状态情况
        if($statusone==1){
            $statedata = array('menustatus'=>0);
            db('auth_rule')->where(array('id'=>$id))->setField($statedata);
            $result['info'] = '状态禁止';
            $result['status'] = 1;
        }else{
            $statedata = array('menustatus'=>1);
            db('auth_rule')->where(array('id'=>$id))->setField($statedata);
            $result['info'] = '状态开启';
            $result['status'] = 1;
        }
        return $result;

    }
    public function ruleTz(){
        $id=input('post.id');
        $statusone=db('auth_rule')->where(array('id'=>$id))->value('authopen');//判断当前状态情况
        if($statusone==1){
            $statedata = array('authopen'=>0);
            db('auth_rule')->where(array('id'=>$id))->setField($statedata);
            $result['info'] = '需要验证';
            $result['status'] = 1;
        }else{
            $statedata = array('authopen'=>1);
            db('auth_rule')->where(array('id'=>$id))->setField($statedata);
            $result['info'] = '无需验证';
            $result['status'] = 1;
        }
        return $result;
    }

    public function ruleDel(){
        db('auth_rule')->where(array('id'=>input('id')))->delete();
        $this->redirect('adminRule');
    }

    public function ruleEdit(){
        $table = db('auth_rule');
        if(request()->isPost()) {
            $datas = input('post.');
            if($table->update($datas)!==false) {
                return json(['code' => 1, 'msg' => '保存成功!', 'url' => url('adminRule')]);
            } else {
                return json(array('code' => 0, 'msg' =>'保存失败！'));
            }
        }else{
            $admin_rule=$table->field('id,href,title,icon,sort,menustatus')->where(array('id'=>input('id')))->find();
            $this->assign('rule',json_encode($admin_rule,true));
            return $this->fetch();
        }
    }
}