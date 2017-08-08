<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"E:\phpStudy\WWW\cltphp/app/admin\view\database\restore.html";i:1490933510;}*/ ?>
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
    <fieldset class="layui-elem-field">
        <legend>备份文件列表</legend>
        <div class="layui-field-box">
            <table class="site-table table-hover">
                <thead>
                <tr>
                    <th>文件名称</th>
                    <th>文件大小</th>
                    <th>备份时间</th>
                    <th>卷号</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($vlist) || $vlist instanceof \think\Collection || $vlist instanceof \think\Paginator): if( count($vlist)==0 ) : echo "" ;else: foreach($vlist as $k=>$vo): ?>
                <tr>
                    <td><?php echo $vo['name']; ?></td>
                    <td><?php echo byte_format($vo['size']); ?></td>
                    <td><?php echo toDate($vo['time']); ?></td>
                    <td><?php echo $vo['number']; ?></td>
                    <td>
                        <a href="javascript:;" onclick="return recover('<?php echo $vo['name']; ?>');" class="layui-btn layui-btn-normal layui-btn-mini">恢复</a>
                        <a href="<?php echo url('downFile',array('type'=>'sql','file'=>$vo['name'])); ?>" class="layui-btn layui-btn-mini">下载</a>
                        <a href="javascript:;" onclick="return del('<?php echo $vo['name']; ?>');" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>

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
    layui.use('layer', function() {
        var layer = parent.layer === undefined ? layui.layer : parent.layer;
    });
    function recover(name) {
        layer.confirm('确认要导入数据吗？',{icon: 0}, function () {
            $.post("<?php echo url('restoreData'); ?>",{sqlfilepre:name},function(data){
                if(data.code==1){
                    layer.msg(data.msg, {time: 1800});
                }else{
                    layer.msg(data.msg,{time: 1800});
                }
            });
        });
    }
    function del(name) {
        layer.confirm('确认要删除该备份文件吗？', {icon: 3}, function () {
            $.post('<?php echo url("delSqlFiles"); ?>',{sqlfilename: name}, function (data) {
                if (data.code == 1) {
                    layer.msg(data.msg, {time: 1800}, function(){
                        window.location.href=data.url;
                    });
                }else{
                    layer.msg(data.info,{time: 1800});
                }
            });
        });
    }
</script>
</body>

</html>