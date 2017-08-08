<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"E:\phpStudy\WWW\cltphp/app/admin\view\link\index.html";i:1495182922;}*/ ?>
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
        <legend>友情链接</legend>
        <div class="layui-field-box">
            <div>
                <blockquote class="layui-elem-quote">
                    <a href="<?php echo url('add'); ?>" class="layui-btn layui-btn-small">
                        <i class="fa fa-plus"></i> <?php echo lang('add'); ?>友链
                    </a>
                </blockquote>
                <table class="layui-table table-hover">
                    <thead>
                    <tr>
                        <th>编号</th>
                        <th>链接名称</th>
                        <th>链接URL</th>
                        <th><?php echo lang('qq'); ?></th>
                        <th><?php echo lang('add'); ?><?php echo lang('time'); ?></th>
                        <th><?php echo lang('order'); ?></th>
                        <th><?php echo lang('status'); ?></th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <!--内容容器-->
                    <tbody id="con">
                    <?php if(is_array($link) || $link instanceof \think\Collection || $link instanceof \think\Paginator): $i = 0; $__LIST__ = $link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td><?php echo $v['link_id']; ?></td>
                        <td><?php echo $v['name']; ?></td>
                        <td><a href="<?php echo $v['url']; ?>" target="_blank"><?php echo $v['url']; ?></a></td>
                        <td><?php echo $v['qq']; ?></td>
                        <td><?php echo date('Y-m-d h:i:s',$v['addtime']); ?></td>
                        <td><?php echo $v['sort']; ?></td>
                        <td>
                            <?php if($v["open"] == 1): ?>
                            <a class="red" href="javascript:;" onclick="return stateyes('<?php echo $v['link_id']; ?>');" title="已开启">
                                <div id="zt<?php echo $v['link_id']; ?>">
                                    <button class="layui-btn layui-btn-warm layui-btn-mini">状态开启</button>
                                </div>
                            </a>
                            <?php else: ?>
                            <a class="red" href="javascript:;" onclick="return stateyes('<?php echo $v['link_id']; ?>');" title="已禁用">
                                <div id="zt<?php echo $v['link_id']; ?>">
                                    <button class="layui-btn layui-btn-danger layui-btn-mini">状态禁用</button>
                                </div>
                            </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo url('edit',['link_id'=>$v['link_id']]); ?>" class="layui-btn layui-btn-mini"><?php echo lang('edit'); ?></a>
                            <a href="javascript:;" onclick="return del('<?php echo $v['link_id']; ?>')" class="layui-btn layui-btn-mini layui-btn-danger"><?php echo lang('del'); ?></a>
                        </td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </fieldset>
</div>
<script type="text/javascript" src="__ADMIN__/plugins/layui/layui.js"></script>
<script src="__STATIC__/js/jquery.2.1.1.min.js"></script>
<script>
    layui.use(['form', 'layer'], function() {
        var form = layui.form(), layer = layui.layer;
    });
    function stateyes(id) {
        $.post('<?php echo url("linkState"); ?>', {id: id}, function (data) {
            if (data.status) {
                if (data.info == '状态禁止') {
                    var a = '<button class="layui-btn layui-btn-danger layui-btn-mini">状态禁用</button>'
                    $('#zt' + id).html(a);
                    layer.msg(data.info, {icon: 5});
                    return false;
                } else {
                    var b = '<button class="layui-btn layui-btn-warm layui-btn-mini">状态开启</button>'
                    $('#zt' + id).html(b);
                    layer.msg(data.info, {icon: 6});
                    return false;
                }
            }
        });
        return false;
    }

    function del(id) {
        layer.confirm('你确定要删除吗？', {icon: 3}, function (index) {
            layer.close(index);
            window.location.href = "<?php echo url('del'); ?>?link_id=" + id;
        });
    }
</script>
</body>

</html>