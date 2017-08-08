<?php
namespace app\home\controller;
use think\Controller;
use think\Input;
use think\Db;
use think\Request;
class Index extends Common{
    public function _initialize(){
        parent::_initialize();
    }
    public function index(){
        $this->assign('title','首页');
        //首页推荐
        $list = db('article')->where(array('posid'=>1))->order('listorder asc,createtime desc')->limit('4')->select();
        foreach ($list as $k=>$v){
            $title_style = explode(';',$v['title_style']);
            $list[$k]['title_color'] = $title_style[0];
            $list[$k]['title_weight'] = $title_style[1];
            $title_thumb = explode(':',$title_style[2]);
            $list[$k]['title_thumb'] = $title_thumb[1]?__PUBLIC__.$title_thumb[1]:__HOME__.'/images/portfolio-thumb/p'.$k.'.jpg';
        }
        $this->assign('list',$list);

        return $this->fetch();
    }
}