<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"E:\phpStudy\WWW\cltphp/app/admin\view\message\index.html";i:1497946620;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>留言管理</title>
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
        <legend><?php echo lang('message'); ?><?php echo lang('list'); ?></legend>
        <div class="layui-field-box">
            <div>
                <form>
                    <div class="layui-form-item search-input">
                        <div class="layui-inline">
                            <div class="layui-input-inline">
                                <input type="text" name="key" id="key" class="layui-input" placeholder="请输入关键字！">
                            </div>
                            <button type="button" class="layui-btn" id="search"><?php echo lang('search'); ?></button>
                            <a href="<?php echo url('index'); ?>" class="layui-btn">显示全部</a>
                        </div>
                    </div>
                </form>
                <table class="layui-table table-hover">
                    <thead>
                    <tr>
                        <th><input type="checkbox" id="selected-all" onclick="$('input[name*=\'messageId\']').prop('checked', this.checked);"></th>
                        <th><?php echo lang('name'); ?></th>
                        <th><?php echo lang('email'); ?></th>
                        <th><?php echo lang('content'); ?></th>
                        <th>留言时间</th>
                        <th><?php echo lang('ip'); ?></th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <!--内容容器-->
                    <tbody id="con">

                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2">
                            <button type="button" class="layui-btn layui-btn-small" onclick="return delall();"><?php echo lang('del'); ?></button>
                        </td>
                        <td colspan="7">
                            <!--分页容器-->
                            <div id="paged" style="text-align: right"></div>
                        </td>
                    </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </fieldset>
</div>

<!--模板-->
<script type="text/html" id="conTemp">
    {{# layui.each(d.list, function(index, item){ }}
    <tr>
        <td><input type="checkbox" name="messageId[]" value="{{ item.message_id }}"></td>
        <td>{{ item.name }}</td>
        <td>{{ item.email }}</td>
        <td>{{ item.content }}</td>
        <td>{{ getdate(item.addtime) }}</td>
        <td>{{item.ip}}</td>
        <td>
            <a href="javascript:;" onclick="return del({{item.message_id}})" data-id="1" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
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
            url: "<?php echo url('index'); ?>", //地址
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
        //搜索
        $('#search').on('click', function() {
            var $this = $(this);
            var key = $('#key').val();
            if($.trim(key)=='') {
                layer.msg('请输入关键字！');
                return;
            }
            //调用get方法获取数据
            paging.get({
                key: key //获取输入的关键字。
            });
        });

    });
    function del(id) {
        layer.confirm('你确定要删除吗？', {icon: 3}, function (index) {
            layer.close(index);
            window.location.href = "<?php echo url('del'); ?>?message_id=" + id;
        });
    }
    function delall() {
        var ids = '';
        $('input[name*=\'messageId\']:checked').each(function (){
            ids += $(this).val() + ',';
        });
        layer.confirm('确认要删除选中信息吗？', {icon: 3}, function(index){
            $.post("<?php echo url('delall'); ?>", {ids:ids}, function (result) {
                layer.alert(result.msg,{icon:6},function(){
                    window.location.href = result.url;
                });
                return false;
            });
            layer.close(index);
        })

    }
    function getdate(date){
        var date = new Date(date*1000);//如果date为10位不需要乘1000
        var Y = date.getFullYear() + '-';
        var M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
        var D = (date.getDate() < 10 ? '0' + (date.getDate()) : date.getDate()) + ' ';
        var h = (date.getHours() < 10 ? '0' + date.getHours() : date.getHours()) + ':';
        var m = (date.getMinutes() <10 ? '0' + date.getMinutes() : date.getMinutes()) + ':';
        var s = (date.getSeconds() <10 ? '0' + date.getSeconds() : date.getSeconds());
        return Y+M+D+h+m+s;
    }
</script>
</body>

</html>