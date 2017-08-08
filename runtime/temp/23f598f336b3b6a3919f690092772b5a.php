<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"E:\phpStudy\WWW\cltphp/app/admin\view\module\index.html";i:1491796944;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Table</title>
    <link rel="stylesheet" href="__ADMIN__/plugins/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="__ADMIN__/css/global.css" media="all">
    <link rel="stylesheet" href="__ADMIN__/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="__ADMIN__/css/table.css" />
    <link rel="stylesheet" href="__ADMIN__/css/style.css" />
</head>

<body>
<div class="admin-main">
    <blockquote class="layui-elem-quote">
        <a href="<?php echo url('add'); ?>" class="layui-btn layui-btn-small">
            <i class="fa fa-plus"></i> <?php echo lang('add'); ?><?php echo lang('module'); ?>
        </a>
    </blockquote>
    <fieldset class="layui-elem-field">
        <legend><?php echo lang('module'); ?><?php echo lang('list'); ?></legend>
        <div class="layui-field-box">
            <table class=" layui-table table-hover">
                <thead>
                <tr>
                    <th><?php echo lang('id'); ?></th>
                    <th><?php echo lang('module'); ?><?php echo lang('name'); ?></th>
                    <th><?php echo lang('table'); ?></th>
                    <th><?php echo lang('detail'); ?></th>
                    <th><?php echo lang('status'); ?></th>
                    <th><?php echo lang('action'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><?php echo $v['id']; ?></td>
                    <td><?php echo $v['title']; ?></td>
                    <td><?php echo $v['name']; ?></td>
                    <td><?php echo $v['description']; ?></td>
                    <td>
                        <?php if($v["status"] == 1): ?>
                        <a class="red" href="javascript:;" onclick="return stateYes('<?php echo $v['id']; ?>');" title="已开启">
                            <div id="zt<?php echo $v['id']; ?>">
                                <button class="layui-btn layui-btn-warm layui-btn-mini">开启</button>
                            </div>
                        </a>
                        <?php else: ?>
                        <a class="red" href="javascript:;" onclick="return stateYes('<?php echo $v['id']; ?>');" title="已禁用">
                            <div id="zt<?php echo $v['id']; ?>">
                                <button class="layui-btn layui-btn-danger layui-btn-mini">禁用</button>
                            </div>
                        </a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo url('field',['id'=>$v['id']]); ?>" class="layui-btn layui-btn-normal layui-btn-mini"><?php echo lang('module'); ?>字段</a>
                        <a href="<?php echo url('edit',['id'=>$v['id']]); ?>" class="layui-btn layui-btn-mini"><?php echo lang('edit'); ?></a>
                        <a href="javascript:;" onclick="return del('<?php echo $v['id']; ?>')" class="layui-btn layui-btn-mini layui-btn-danger"><?php echo lang('del'); ?></a>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>

        </div>
    </fieldset>
    <div class="admin-table-page">
        <div id="page" class="page">
            <?php echo $page; ?>
        </div>
    </div>
</div>
<script type="text/javascript" src="__ADMIN__/plugins/layui/layui.js"></script>
<script src="__STATIC__/js/jquery.2.1.1.min.js"></script>
<script>
    layui.use(['form', 'layer'], function() {
        var form = layui.form(), layer = layui.layer;
    });
    function del(id) {
        layer.confirm('你确定要删除该模型吗？', {icon: 3}, function (index) {
            layer.close(index);
            window.location.href = "<?php echo url('del'); ?>?id="+id ;
        });
    }
    function stateYes(id) {
        $.post('<?php echo url("moduleState"); ?>', {id: id}, function (data) {
            if (data.status) {
                if (data.info == '状态禁止') {
                    layer.msg(data.info,{icon:5});
                    var a = '<button class="layui-btn layui-btn-danger layui-btn-mini" title="已禁用">禁用</button>'
                    $('#zt' + id).html(a);
                    return false;
                } else {
                    layer.msg(data.info,{icon:6});
                    var b = '<button class="layui-btn layui-btn-warm layui-btn-mini" title="已开启">开启</button>'
                    $('#zt' + id).html(b);
                    return false;
                }

            }
        });
        return false;
    }
</script>
</body>

</html>