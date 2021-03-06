<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"E:\phpStudy\WWW\cltphp/app/admin\view\debris\index.html";i:1496310831;}*/ ?>
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
    <blockquote class="layui-elem-quote">
        <form class="layui-form" style="float:left;" action="<?php echo url('index'); ?>" method="post">
            <div class="layui-form-item" style="margin:0;">
                <div class="layui-input-inline">
                    <input type="text" name="key" id="key" value="<?php echo $testkey; ?>" placeholder="请输入关键字！" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux" style="padding:0;">
                    <button type="submit" class="layui-btn"><i class="fa fa-search" aria-hidden="true"></i> 查询</button>
                    <a href="<?php echo url('index'); ?>" class="layui-btn">显示全部</a>
                </div>
            </div>
        </form>
        <a href="<?php echo url('add'); ?>" class="layui-btn" style="float:right;"><i class="fa fa-plus" aria-hidden="true"></i><?php echo lang('add'); ?><?php echo lang('debris'); ?></a>
        <div style="clear: both;"></div>
    </blockquote>
    <fieldset class="layui-elem-field">
        <legend><?php echo lang('debris'); ?>管理</legend>
        <div class="layui-field-box">
            <form class="layui-form layui-form-pane">
                <table class="layui-table table-hover">
                    <thead>
                    <tr>
                        <th>编号</th>
                        <th><?php echo lang('title'); ?></th>
                        <th><?php echo lang('add'); ?><?php echo lang('time'); ?></th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <!--内容容器-->
                    <tbody id="con">
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td><?php echo $v['id']; ?></td>
                        <td><?php echo $v['title']; ?></td>
                        <td><?php echo date('Y-m-d h:i',$v['addtime']); ?></td>
                        <td>
                            <a href="<?php echo url('edit',['id'=>$v['id']]); ?>" class="layui-btn layui-btn-mini"><?php echo lang('edit'); ?></a>
                            <a href="javascript:;" onclick="return del('<?php echo $v['id']; ?>')" class="layui-btn layui-btn-mini layui-btn-danger"><?php echo lang('del'); ?></a>
                        </td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </form>
        </div>
    </fieldset>
</div>
<script type="text/javascript" src="__ADMIN__/plugins/layui/layui.js"></script>
<script src="__STATIC__/js/jquery.2.1.1.min.js"></script>
<script>
    layui.use('layer',function() {
        var layer = layui.layer;
    });
    function del(id) {
        layer.confirm('你确定要删除吗？', {icon: 3}, function (index) {
            layer.close(index);
            window.location.href = "<?php echo url('del'); ?>?id=" + id;
        });
    }
</script>
</body>

</html>