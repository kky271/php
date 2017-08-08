<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"E:\phpStudy\WWW\cltphp/app/admin\view\users\edit.html";i:1497422452;}*/ ?>
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
                <select name="level" lay-verify="required" ng-model="field.level" ng-options="v.level_id as v.level_name for v in group" ng-selected="v.level_id==field.level">
                    <option value="">请选择会员组</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('nickname'); ?></label>
            <div class="layui-input-4">
                <input type="text" name="nickname" ng-model="field.nickname" lay-verify="required" placeholder="请输入<?php echo lang('nickname'); ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('email'); ?></label>
            <div class="layui-input-4">
                <input type="text" name="email" ng-model="field.email" lay-verify="eamil" placeholder="输入<?php echo lang('email'); ?>" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                必填：用于找回密码
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('tel'); ?></label>
            <div class="layui-input-4">
                <input type="text" name="mobile" ng-model="field.mobile" lay-verify="mobile" placeholder="输入<?php echo lang('tel'); ?>" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                只能填写数字
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('pwd'); ?></label>
            <div class="layui-input-4">
                <input type="password" name="password" lay-verify="required" placeholder="输入<?php echo lang('pwd'); ?>" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                密码必须大于6位，小于15位
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label"><?php echo lang('sex'); ?></label>
                <div class="layui-input-block">
                    <input type="radio" name="sex" ng-model="field.sex" ng-checked="field.sex==1" ng-value="1" title="<?php echo lang('man'); ?>">
                    <input type="radio" name="sex" ng-model="field.sex" ng-checked="field.sex==0" ng-value="0" title="<?php echo lang('woman'); ?>">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('qq'); ?></label>
            <div class="layui-input-4">
                <input type="text" name="qq" ng-model="field.qq" placeholder="输入<?php echo lang('qq'); ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('address'); ?></label>
            <div class="layui-input-inline">
                <select name="province" ng-model="field.province" lay-filter="province" ng-options="v.id as v.name for v in province" ng-selected="v.id==field.province">
                    <option value="">请选择省</option>
                </select>
            </div>
            <div class="layui-input-inline" >
                <select name="city" id="city" ng-model="field.city" lay-filter="city" ng-options="v.id as v.name for v in city" ng-selected="v.id==field.city">
                    <option value="">请选择市</option>
                </select>
            </div>
            <div class="layui-input-inline">
                <select name="district" id="district" ng-model="field.district" lay-filter="district" ng-options="v.id as v.name for v in district" ng-selected="v.id==field.district">
                    <option value="">请选择县/区</option>
                </select>
            </div>
        </div>
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

    m.controller('ctrl',function($scope,$q,$http) {
        $scope.field = <?php echo $info; ?>;
        $scope.group = <?php echo $user_level; ?>;
        $scope.province = <?php echo $province; ?>;
        $scope.city = <?php echo $city; ?>;
        $scope.district = <?php echo $district; ?>;
        layui.use(['form', 'layer'], function () {
            var form = layui.form(), layer = layui.layer;
            form.on('select(province)', function(data) {
                var pid = data.value;
                $.get("<?php echo url('getRegion'); ?>?pid=" + pid, function (data) {
                    var html='<option value="">请选择市</option>';
                    $.each(data, function (i, value) {
                        html += '<option value="'+value.id+'">'+value.name+'</option>';
                    });
                    $('#city').html(html);
                    $('#district').html('<option value="">请选择县/区</option>');
                    form.render()
                });
            });
            form.on('submit(submit)', function (data) {
                // 提交到方法 默认为本身
                data.field.user_id = $scope.field.user_id;
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
    });
</script>
</body>

</html>