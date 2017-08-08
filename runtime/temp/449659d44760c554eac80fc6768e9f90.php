<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"E:\phpStudy\WWW\cltphp/app/admin\view\module\field.html";i:1491887514;}*/ ?>
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
        <a href="<?php echo url('fieldAdd',array('moduleid'=>input('id'))); ?>" class="layui-btn layui-btn-small">
            <i class="fa fa-plus"></i> <?php echo lang('add'); ?><?php echo lang('field'); ?>
        </a>
        <a href="<?php echo url('index'); ?>" class="layui-btn layui-btn-small layui-btn-primary pull-right">模型列表</a>
    </blockquote>
    <fieldset class="layui-elem-field">
        <legend><?php echo lang('field'); ?><?php echo lang('list'); ?></legend>
        <div class="layui-field-box">
            <form class="layui-form layui-form-pane">
                <table class=" layui-table table-hover">
                    <thead>
                    <tr>
                        <th><?php echo lang('order'); ?></th>
                        <th>字段名</th>
                        <th>别名</th>
                        <th>字段类型</th>
                        <th>系统字段</th>
                        <th>必填</th>
                        <th><?php echo lang('action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td><input name="listorders[<?php echo $vo['id']; ?>]" class="list_order layui-input" value=" <?php echo $vo['listorder']; ?>" size="10"/></td>
                        <td><?php echo $vo['field']; ?></td>
                        <td><?php echo $vo['name']; ?></td>
                        <td><?php echo $vo['type']; ?></td>
                        <td>
                            <?php if(in_array($vo['field'],$sysfield)): ?>
                            <i class="fa fa-check"></i>
                            <?php else: ?>
                            <i class="fa fa-times "></i>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($vo['required'] == 1): ?>
                            <i class="fa fa-check"></i>
                            <?php else: ?>
                            <i class="fa fa-times "></i>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo url('fieldEdit',array('moduleid'=>$vo['moduleid'],'id'=>$vo['id'])); ?>" class="layui-btn layui-btn-mini"><?php echo lang('edit'); ?></a>
                            <?php if($vo['status']==1): if(in_array($vo['field'],$nodostatus)): ?>
                                    <button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">已禁用</button>
                                <?php else: ?>
                                    <a href="javascript:" class="zt<?php echo $vo['id']; ?> layui-btn layui-btn-mini layui-btn-warm" onclick="return stateyes('<?php echo $vo['id']; ?>');">已启用</a>
                                <?php endif; else: ?>
                                <a href="javascript:" class="zt<?php echo $vo['id']; ?> layui-btn layui-btn-mini layui-btn-danger" onclick="return stateyes('<?php echo $vo['id']; ?>');">已禁用</a>
                            <?php endif; if(in_array($vo['field'],$sysfield)): ?>
                                <button type="button" class="layui-btn layui-btn-mini layui-btn-disabled">删除</button>
                            <?php else: ?>
                                <a href="javascript:" onclick="return del('<?php echo $vo['id']; ?>');" class="layui-btn layui-btn-mini layui-btn-danger" >删除</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="8">
                            <button type="button" class="layui-btn  layui-btn-small" lay-submit="" lay-filter="sort"><?php echo lang('order'); ?></button>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </form>
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
        form.on('submit(sort)', function(data){
            data.field.id= "<?php echo input('id'); ?>";
            $.post("<?php echo url('listOrder'); ?>",data.field,function(res){
                if(res.code > 0){
                    layer.msg(res.msg,{time:1000,icon:1},function(){
                        location.href = res.url;
                    });
                }else{
                    layer.msg(res.msg,{time:1000,icon:2});
                }
            })
        });
    });
    function del(id) {
        layer.confirm('你确定要删除该字段吗？', {icon: 3}, function (index) {
            layer.close(index);
            window.location.href = "<?php echo url('fieldDel'); ?>?id="+id ;
        });
    }
    function stateyes(id) {
        $.post('<?php echo url("fieldStatus"); ?>', {id: id}, function (data) {
            if (data.code) {
                if (data.msg == '状态禁止') {
                    layer.msg(data.msg,{icon:5});
                    var a = '已禁用';
                    $('.zt' + id).html(a).removeClass('layui-btn-warm').addClass('layui-btn-danger');

                    return false;
                } else {
                    layer.msg(data.msg,{icon:6});
                    var b = '已启用';
                    $('.zt' + id).html(b).removeClass('layui-btn-danger').addClass('layui-btn-warm');
                    return false;
                }
            }
        });
        return false;
    }
</script>
</body>

</html>