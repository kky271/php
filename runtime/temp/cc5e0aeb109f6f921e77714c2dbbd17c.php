<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"E:\phpStudy\WWW\cltphp/app/admin\view\system\system.html";i:1491461854;}*/ ?>
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
        <legend>系统设置</legend>
    </fieldset>

    <form class="layui-form layui-form-pane">
        <div class="layui-form-item">
            <label class="layui-form-label">站点名称</label>
            <div class="layui-input-4">
                <input type="text" ng-model="field.name" lay-verify="required" placeholder="请输入标题" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">站点网址</label>
            <div class="layui-input-4">
                <input type="text" ng-model="field.url" lay-verify="url" placeholder="请输入站点网址" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">SEO标题</label>
            <div class="layui-input-block">
                <input type="text" ng-model="field.title" lay-verify="required" placeholder="请输入SEO标题" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">SEO关键字</label>
            <div class="layui-input-block">
                <textarea ng-model="field.key" lay-verify="required" placeholder="请输入SEO关键字" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">SEO描述</label>
            <div class="layui-input-block">
                <textarea ng-model="field.des" lay-verify="required" placeholder="请输入SEO描述" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">备案号</label>
            <div class="layui-input-3">
                <input type="text" ng-model="field.bah" placeholder="请输入备案号" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">Copyright</label>
            <div class="layui-input-3">
                <input type="text" ng-model="field.copyright" placeholder="请输入Copyright" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">公司地址</label>
            <div class="layui-input-3">
                <input type="text" ng-model="field.ads" placeholder="请输入公司地址" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">联系电话</label>
            <div class="layui-input-3">
                <input type="text" ng-model="field.tel" placeholder="请输入联系电话" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">邮箱账号</label>
            <div class="layui-input-3">
                <input type="text" ng-model="field.email" placeholder="请输入邮箱账号" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="button" class="layui-btn" lay-submit="" lay-filter="sys">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="__ADMIN__/plugins/layui/layui.js"></script>
<script src="__STATIC__/js/angular.min.js"></script>
<script src="__STATIC__/js/jquery.2.1.1.min.js"></script>
<script>
    var m = angular.module('hd',[]);
    m.controller('ctrl',['$scope','$http',function($scope,$http){
        $scope.field = <?php echo $system; ?>;
        layui.use(['form', 'layer'], function () {
            var form = layui.form(),layer = layui.layer;
            // 登录提交监听
            form.on('submit(sys)', function () {
                // 提交到方法 默认为本身
                $.post("<?php echo url('system/system'); ?>",$scope.field,function(res){
                    if(res.code > 0){
                        layer.msg(res.msg,{time:1800},function(){
                            location.href = res.url;
                        });
                    }else{
                        layer.msg(res.msg,{time:1800});
                    }
                });
            })
        })
    }]);
</script>
</body>

</html>