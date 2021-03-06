<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"E:\phpStudy\WWW\cltphp/app/admin\view\auth\adminForm.html";i:1497403234;}*/ ?>
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
            <label class="layui-form-label">所属用户组</label>
            <div class="layui-input-4">
                <select name="group_id" lay-verify="required" ng-model="field.group_id" ng-options="v.group_id as v.title for v in group" ng-selected="v.group_id==field.group_id">
                    <option value="">请选择网站</option>
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('username'); ?></label>
            <div class="layui-input-4">
                <input type="text" name="username" ng-model="field.username" lay-verify="required" placeholder="请输入登录用户名" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                用户名必须是以字母开头，数字、符号组合。
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('pwd'); ?></label>
            <div class="layui-input-4">
                <input type="password" name="pwd" placeholder="请输入登录密码" lay-verify="required" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                密码必须大于6位，小于15位.
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('email'); ?></label>
            <div class="layui-input-4">
                <input type="text" name="email" ng-model="field.email" lay-verify="email" placeholder="请输入用户邮箱" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                用于密码找回，请认真填写.
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('tel'); ?></label>
            <div class="layui-input-4">
                <input type="text" name="tel" ng-model="field.tel" lay-verify="phone" value="" placeholder="请输入手机号" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">是否审核</label>
            <div class="layui-input-block">
                <input type="radio" name="is_open" ng-model="field.is_open" ng-checked="field.is_open==1" ng-value="1" title="<?php echo lang('open'); ?>">
                <input type="radio" name="is_open" ng-model="field.is_open" ng-checked="field.is_open==0" ng-value="0" title="<?php echo lang('close'); ?>">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="button" class="layui-btn" lay-submit="" lay-filter="submit"><?php echo lang('submit'); ?></button>
                <a href="<?php echo url('adminList'); ?>" class="layui-btn layui-btn-primary"><?php echo lang('back'); ?></a>
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
        $scope.field = '<?php echo $info; ?>'!='null'?<?php echo $info; ?>:{group_id:'',username:'',email:'',tel:'',is_open:1};
        $scope.group = <?php echo $authGroup; ?>;
        layui.use(['form', 'layer'], function () {
            var form = layui.form(), layer = layui.layer;
            form.on('submit(submit)', function (data) {
                // 提交到方法 默认为本身
                data.field.admin_id = $scope.field.admin_id;
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