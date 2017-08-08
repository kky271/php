<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:54:"E:\phpStudy\WWW\cltphp/app/admin\view\wechat\text.html";i:1496736448;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Paging</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">

    <link rel="stylesheet" href="__ADMIN__/plugins/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="__ADMIN__/css/global.css" media="all">
    <link rel="stylesheet" href="__ADMIN__/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="__ADMIN__/css/table.css" />
    <link rel="stylesheet" href="__ADMIN__/css/style.css">
</head>

<body>
<div style="margin: 15px;">
    <fieldset class="layui-elem-field">
        <legend>文本回复</legend>
        <div class="layui-field-box">
            <div>
                <blockquote class="layui-elem-quote">
                    <a href="<?php echo url('addText'); ?>" class="layui-btn layui-btn-small">
                        <i class="fa fa-plus"></i> <?php echo lang('add'); ?>文本回复
                    </a>
                </blockquote>
                <form class="layui-form layui-form-pane">
                    <table class="layui-table table-hover">
                        <thead>
                        <tr>
                            <th>编号</th>
                            <th>关键词</th>
                            <th>回答</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <!--内容容器-->
                        <tbody id="con">
                        <!--<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td><?php echo $v['id']; ?></td>
                            <td><?php echo $v['keyword']; ?></td>
                            <td><?php echo $v['text']; ?></td>
                            <td>
                                <a href="<?php echo url('editText',['id'=>$v['id']]); ?>" class="layui-btn layui-btn-mini"><?php echo lang('edit'); ?></a>
                                <a href="javascript:;" onclick="return del('<?php echo $v['id']; ?>')" class="layui-btn layui-btn-mini layui-btn-danger"><?php echo lang('del'); ?></a>
                            </td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>-->
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="7">
                                <!--分页容器-->
                                <div id="paged" style="text-align: right"></div>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
    </fieldset>
</div>
<!--模板-->
<script type="text/html" id="conTemp">
    {{# layui.each(d.list, function(index, item){ }}
    <tr>
        <td>{{ item.id }}</td>
        <td>{{ item.keyword }}</td>
        <td>{{ item.text }}</td>
        <td>
            <a href="<?php echo url('editText'); ?>?id={{item.id}}" class="layui-btn layui-btn-mini"><?php echo lang('edit'); ?></a>
            <a href="javascript:;" onclick="return del({{item.id}})" data-id="1" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
        </td>
    </tr>
    {{# }); }}
</script>
<script type="text/javascript" src="__ADMIN__/plugins/layui/layui.js"></script>
<script src="__STATIC__/js/jquery.2.1.1.min.js"></script>
<script>
    layui.config({
        base: '__ADMIN__/js/'
    }).use(['paging', 'code','icheck','layer'], function() {
        layui.code();
        var paging = layui.paging(),layer = parent.layer === undefined ? layui.layer : parent.layer;
        paging.init({
            url: "<?php echo url('text'); ?>", //地址
            elem: '#con', //内容容器
            params: {}, //发送到服务端的参数
            tempElem: '#conTemp', //模块容器
            pageConfig: { //分页参数配置
                elem: '#paged', //分页容器
                pageSize: 15 //分页大小
            },
            success: function() { //渲染成功的回调
                //alert('渲染成功');
            },
            fail: function(msg) { //获取数据失败的回调
                //alert('获取数据失败')
            },
            complate: function() { //完成的回调
                //alert('处理完成');
            }
        });
    });
    function del(id) {
        layer.confirm('你确定要删除吗？', {icon: 3}, function (index) {
            layer.close(index);
            window.location.href = "<?php echo url('delText'); ?>?id=" + id;
        });
    }
</script>
</body>

</html>