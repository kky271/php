<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"E:\phpStudy\WWW\cltphp/app/admin\view\auth\adminGroup.html";i:1496653625;}*/ ?>
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
        <a href="<?php echo url('groupAdd'); ?>" class="layui-btn layui-btn-small">
            <i class="fa fa-plus"></i> 添加用户组
        </a>
    </blockquote>
    <fieldset class="layui-elem-field">
        <legend>用户组列表</legend>
        <div class="layui-field-box">
            <form class="layui-form layui-form-pane">
                <table class="layui-table table-hover" lay-even>
                    <thead>
                    <tr>
                        <th><?php echo lang('id'); ?></th>
                        <th>用户组名</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td><?php echo $v['group_id']; ?></td>
                        <td><?php echo $v['title']; ?></td>
                        <td><?php echo date('Y-m-d',$v['addtime']); ?></td>
                        <td>
                            <a href="<?php echo url('groupAccess',array('id'=>$v['group_id'])); ?>" class="layui-btn layui-btn-mini layui-btn-normal" title="配置规则">配置规则</a>
                            <a href="<?php echo url('groupEdit',array('id'=>$v['group_id'])); ?>" class="layui-btn layui-btn-mini"><?php echo lang('edit'); ?></a>
                            <a href="javascript:;" class="layui-btn layui-btn-mini layui-btn-danger" onclick="return del('<?php echo $v['group_id']; ?>');"><?php echo lang('del'); ?></a>
                        </td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </form>
        </div>
    </fieldset>
    <div class="admin-table-page">
        <div id="page" class="page">
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
        layer.confirm('你确定要删除吗？', {icon: 3}, function (index) {
            layer.close(index);
            window.location.href = "<?php echo url('groupDel'); ?>?id=" + id + "";
        });
    }
</script>
</body>

</html>