<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"E:\phpStudy\WWW\cltphp/app/admin\view\wechat\imgForm.html";i:1496737640;}*/ ?>
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
    <link rel="stylesheet" href="__ADMIN__/css/global.css">
    <link rel="stylesheet" href="__ADMIN__/css/style.css">
</head>
<body>
<div style="margin: 15px;" ng-app="hd" ng-controller="ctrl">
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend><?php echo $title; ?></legend>
    </fieldset>
    <form class="layui-form layui-form-pane">
        <div class="layui-form-item">
            <label class="layui-form-label">关键词</label>
            <div class="layui-input-4">
                <input type="text" name="keyword" ng-model="field.keyword" lay-verify="required" placeholder="请输入关键词" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('title'); ?></label>
            <div class="layui-input-4">
                <input type="text" name="title" ng-model="field.title" lay-verify="required" placeholder="请输入<?php echo lang('title'); ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">URL</label>
            <div class="layui-input-4">
                <input type="text" name="url" ng-model="field.url" lay-verify="required" placeholder="http://" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">封面图片</label>
            <div class="layui-input-block">
                <div class="site-demo-upload">
                    <img id="cltThumb" src="__ADMIN__/images/tong.png">
                    <div class="site-demo-upbar">
                        <input type="file" name="thumb" lay-type="images" class="layui-upload-file" id="thumb">
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">简介</label>
            <div class="layui-input-block">
                <textarea ng-model="field.desc" lay-verify="required" name="desc" placeholder="请输入回复内容" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="button" class="layui-btn" lay-submit="" lay-filter="submit"><?php echo lang('submit'); ?></button>
                <a href="<?php echo url('img'); ?>" class="layui-btn layui-btn-primary"><?php echo lang('back'); ?></a>
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
        $scope.field = '<?php echo $info; ?>'!='null'?<?php echo $info; ?>:{id:'',keyword:'',title:'',url:'',desc:''};
        layui.use(['form', 'layer','upload'], function () {
            var form = layui.form(), layer = layui.layer,upload = layui.upload;
            if($scope.field.pic){
                cltThumb.src = "__PUBLIC__"+ $scope.field.pic;
            }
            upload({
                url: '<?php echo url("UpFiles/upload"); ?>',
                title: '封面图片',
                ext: 'jpg|png|gif', //那么，就只会支持这三种格式的上传。注意是用|分割。
                success: function(res, input){
                    cltThumb.src = "__PUBLIC__"+res.url;
                    $scope.field.pic = res.url;
                }
            });
            form.on('submit(submit)', function (data) {
                // 提交到方法 默认为本身
                data.field.id = $scope.field.id;
                data.field.pic = $scope.field.pic;
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