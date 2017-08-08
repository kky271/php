<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"E:\phpStudy\WWW\cltphp/app/admin\view\wechat\img.html";i:1496737901;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>图文回复</title>
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
        <legend>图文回复</legend>
        <div class="layui-field-box">
            <blockquote class="layui-elem-quote">
                <a href="<?php echo url('addImg'); ?>" class="layui-btn layui-btn-small">
                    <i class="fa fa-plus"></i> <?php echo lang('add'); ?>图文回复
                </a>
            </blockquote>
            <table class="layui-table table-hover">
                <thead>
                <tr>
                    <th><?php echo lang('id'); ?></th>
                    <th>关键词</th>
                    <th><?php echo lang('title'); ?></th>
                    <th>描述</th>
                    <th>操作</th>
                </tr>
                </thead>
                <!--内容容器-->
                <tbody id="con">

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
        </div>
    </fieldset>
</div>

<!--模板-->
<script type="text/html" id="conTemp">
    {{# layui.each(d.list, function(index, item){ }}
    <tr>
        <td>{{ item.id }}</td>
        <td>{{ item.keyword }}</td>
        <td>{{ item.title }}</td>
        <td>{{ item.desc }}</td>
        <td>
            <a href="<?php echo url('editImg'); ?>?id={{item.id}}" class="layui-btn layui-btn-mini"><?php echo lang('edit'); ?></a>
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
            url: "<?php echo url('img'); ?>", //地址
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
        layer.confirm('你确定要删除该图文回复吗？', {icon: 3}, function (index) {
            layer.close(index);
            window.location.href = "<?php echo url('delImg'); ?>?id=" + id;
        });
    }
</script>
</body>

</html>