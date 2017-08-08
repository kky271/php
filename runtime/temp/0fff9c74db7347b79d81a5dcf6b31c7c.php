<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:54:"E:\phpStudy\WWW\cltphp/app/admin\view\module\form.html";i:1491817972;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>表单</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">

    <link rel="stylesheet" href="__ADMIN__/plugins/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="__ADMIN__/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="__ADMIN__/css/style.css">
</head>
<body>
<div style="margin: 15px;" ng-app="hd" ng-controller="ctrl">
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend><?php echo $title; ?></legend>
    </fieldset>
    <form class="layui-form layui-form-pane">
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('module'); ?><?php echo lang('name'); ?></label>
            <div class="layui-input-4">
                <input type="text" name="title" ng-model="field.title" lay-verify="required" placeholder="必填：模型名称" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('table'); ?></label>
            <div class="layui-input-4">
                <input type="text" name="name" ng-model="field.name" placeholder="必填：模型表名" lay-verify="required" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">列表页字段</label>
            <div class="layui-input-4">
                <input type="text" name="listfields" ng-model="field.listfields" placeholder="请输入列表页调用字段" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label"><?php echo lang('detail'); ?></label>
            <div class="layui-input-block">
                <textarea name="description" ng-model="field.description" placeholder="请输入内容" class="layui-textarea"></textarea>
            </div>
        </div>
        <?php if($info == 'null'): ?>
        <div class="layui-form-item">
            <label class="layui-form-label">新建表字段</label>
            <div class="layui-input-block">
                <input type="radio" name="emptytable" ng-model="field.emptytable" ng-value="1" title="空表字段">
                <input type="radio" name="emptytable" ng-model="field.emptytable" ng-value="0" checked title="普通文章表字段">
            </div>
        </div>
        <?php endif; ?>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="button" class="layui-btn" lay-submit="" lay-filter="submit"><?php echo lang('submit'); ?></button>
                <a href="<?php echo url('index'); ?>" class="layui-btn layui-btn-primary"><?php echo lang('back'); ?></a>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="__ADMIN__/plugins/layui/layui.js"></script>
<script src="__STATIC__/js/angular.min.js"></script>
<script src="__STATIC__/js/jquery.2.1.1.min.js"></script>
<script>
    var m = angular.module('hd',[]);
    m.controller('ctrl',['$scope',function($scope) {
        $scope.field = '<?php echo $info; ?>'!='null'?<?php echo $info; ?>:{title:'',field:'',name:'',listfields:'*',emptytable:0};
        layui.use(['form', 'layer'], function () {
            var form = layui.form(), layer = layui.layer;
            form.on('submit(submit)', function (data) {
                // 提交到方法 默认为本身
                data.field.id = $scope.field.id;
                $.post("", data.field, function (res) {
                    if (res.code > 0) {
                        layer.msg(res.msg, {time: 1800, icon: 1}, function () {
                            location.href = res.url;
                        });
                    } else {
                        layer.msg(res.msg, {time: 1800, icon: 2});
                    }
                });
            })
        });
    }]);
</script>
</body>

</html>