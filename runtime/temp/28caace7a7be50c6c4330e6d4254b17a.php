<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"E:\phpStudy\WWW\cltphp/app/admin\view\auth\adminList.html";i:1495517723;}*/ ?>
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
        <a href="<?php echo url('adminAdd'); ?>" class="layui-btn layui-btn-small">
            <i class="fa fa-plus"></i> <?php echo lang('add'); ?><?php echo lang('admin'); ?>
        </a>
    </blockquote>
    <fieldset class="layui-elem-field">
        <legend><?php echo lang('admin'); ?><?php echo lang('list'); ?></legend>
        <div class="layui-field-box">
            <table class=" layui-table table-hover">
                <thead>
                <tr>
                    <th><?php echo lang('username'); ?></th>
                    <th><?php echo lang('email'); ?></th>
                    <th>用户组</th>
                    <th><?php echo lang('tel'); ?></th>
                    <th><?php echo lang('ip'); ?></th>
                    <th><?php echo lang('status'); ?></th>
                    <th><?php echo lang('action'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($adminList) || $adminList instanceof \think\Collection || $adminList instanceof \think\Paginator): $i = 0; $__LIST__ = $adminList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><?php echo $v['username']; ?></td>
                    <td><?php echo $v['email']; ?></td>
                    <td><?php echo $v['title']; ?></td>
                    <td><?php echo $v['tel']; ?></td>
                    <td><?php echo $v['ip']; ?></td>
                    <td>
                        <?php if($v["is_open"] == 1): ?>
                        <a class="red" href="javascript:;" onclick="return stateyes('<?php echo $v['admin_id']; ?>');" title="已开启">
                            <div id="zt<?php echo $v['admin_id']; ?>">
                                <button class="layui-btn layui-btn-warm layui-btn-mini">状态开启</button>
                            </div>
                        </a>
                        <?php else: ?>
                        <a class="red" href="javascript:;" onclick="return stateyes('<?php echo $v['admin_id']; ?>');" title="已禁用">
                            <div id="zt<?php echo $v['admin_id']; ?>">
                                <button class="layui-btn layui-btn-danger layui-btn-mini">状态禁用</button>
                            </div>
                        </a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo url('adminEdit',['admin_id'=>$v['admin_id']]); ?>" class="layui-btn layui-btn-mini"><?php echo lang('edit'); ?></a>
                        <a href="javascript:;" onclick="return del('<?php echo $v['admin_id']; ?>')" class="layui-btn layui-btn-mini layui-btn-danger"><?php echo lang('del'); ?></a>
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
        if (id == 1) {
            layer.msg('超级管理员不可删除', {time: 1800,icon:0});
            return false;
        }
        layer.confirm('你确定要删除吗？', {icon: 3}, function (index) {
            window.location.href = "<?php echo url('adminDel'); ?>?admin_id="+id;
        });
    }
    function stateyes(id) {
        $.post('<?php echo url("adminState"); ?>',{'id': id},function (data) {
            if (data.status==1) {
                if (data.info == '状态禁止') {
                    var a = '<button class="layui-btn layui-btn-danger layui-btn-mini">状态禁用</button>'
                    $('#zt' + id).html(a);
                    return false;
                } else {
                    var b = '<button class="layui-btn layui-btn-warm layui-btn-mini">状态开启</button>'
                    $('#zt' + id).html(b);
                    return false;
                }
            }else{
                layer.alert(data.info, {icon: 4});
                return false;
            }
        });
        return false;
    }
</script>
</body>

</html>