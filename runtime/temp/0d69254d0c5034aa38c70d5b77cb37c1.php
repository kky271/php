<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"E:\phpStudy\WWW\cltphp/app/admin\view\users\userGroup.html";i:1495186516;}*/ ?>
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
            <i class="fa fa-plus"></i> <?php echo lang('add'); ?>会员组
        </a>
    </blockquote>
    <fieldset class="layui-elem-field">
        <legend>会员组<?php echo lang('list'); ?></legend>
        <form class="layui-form layui-form-pane">
        <div class="layui-field-box">
            <table class=" layui-table table-hover">
                <thead>
                <tr>
                    <th><?php echo lang('id'); ?></th>
                    <th>名称</th>
                    <th>满足积分条件</th>
                    <th><?php echo lang('order'); ?></th>
                    <th><?php echo lang('action'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><?php echo $v['level_id']; ?></td>
                    <td><?php echo $v['level_name']; ?></td>
                    <td><?php echo $v['bomlimit']; ?>-<?php echo $v['toplimit']; ?></td>
                    <td><input name="<?php echo $v['level_id']; ?>" value=" <?php echo $v['sort']; ?>" class="list_order"/></td>
                    <td>
                        <a href="<?php echo url('groupEdit',['level_id'=>$v['level_id']]); ?>" class="layui-btn layui-btn-mini"><?php echo lang('edit'); ?></a>
                        <a href="javascript:;" onclick="return del('<?php echo $v['level_id']; ?>')" class="layui-btn layui-btn-mini layui-btn-danger"><?php echo lang('del'); ?></a>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5">
                        <button type="button" class="layui-btn  layui-btn-small" lay-submit="" lay-filter="sort"><?php echo lang('order'); ?></button>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
        </form>
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
        layer.confirm('你确定要删除吗？', {icon: 3}, function (index) {
            layer.close(index);
            window.location.href = "<?php echo url('groupDel'); ?>?level_id=" + id;
        });
    }
    //排序提交
    layui.use(['form', 'layer'], function() {
        var form = layui.form(),layer = layui.layer;
        form.on('submit(sort)', function(data){
            $.post("<?php echo url('groupOrder'); ?>",data.field,function(res){
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
</script>
</body>

</html>