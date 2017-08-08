<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:50:"E:\phpStudy\WWW\cltphp/app/admin\view\ad\form.html";i:1497854150;}*/ ?>
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
            <label class="layui-form-label">所属位置</label>
            <div class="layui-input-4">
                <select name="type_id" lay-verify="required" ng-model="field.type_id" ng-options="v.type_id as v.name for v in group" ng-selected="v.type_id==field.type_id">
                    <option value="">请选择所属广告位</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">广告名称</label>
            <div class="layui-input-4">
                <input type="text" name="name" ng-model="field.name" lay-verify="required" placeholder="请输入广告名称" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">广告图片</label>
            <div class="layui-input-block">
                <div class="site-demo-upload">
                    <img id="cltThumb" src="__ADMIN__/images/tong.png">
                    <div class="site-demo-upbar">
                        <input type="file" name="thumb" lay-type="images" class="layui-upload-file" id="thumb">
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('ad'); ?>URL</label>
            <div class="layui-input-4">
                <input type="text" name="url" ng-model="field.url" lay-verify="url" placeholder="请输入<?php echo lang('ad'); ?>URL" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否审核</label>
            <div class="layui-input-block">
                <input type="radio" name="open" ng-model="field.open" ng-checked="field.open==1" ng-value="1" title="<?php echo lang('open'); ?>">
                <input type="radio" name="open" ng-model="field.open" ng-checked="field.open==0" ng-value="0" title="<?php echo lang('close'); ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('order'); ?></label>
            <div class="layui-input-4">
                <input type="text" name="sort" ng-model="field.sort" value="" placeholder="从小到大排序" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">内容</label>
            <div class="layui-input-block">
                <textarea ng-model="field.content" placeholder="请输广告内容" name="content" class="layui-textarea"></textarea>
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
    m.controller('ctrl',['$scope',function($scope) {
        $scope.field = '<?php echo $info; ?>'!='null'?<?php echo $info; ?>:{type_id:'',ad_id:'',name:'',url:'',open:1,sort:50,pic:'',content:''};
        $scope.group = <?php echo $adtypeList; ?>;
        layui.use(['form', 'layer','upload'], function () {
            var form = layui.form(), layer = layui.layer, upload = layui.upload;
            if($scope.field.pic){
                cltThumb.src = "__PUBLIC__"+ $scope.field.pic;
            }
            upload({
                url: '<?php echo url("UpFiles/upload"); ?>',
                title: '上传图片',
                ext: 'jpg|png|gif', //那么，就只会支持这三种格式的上传。注意是用|分割。
                success: function(res, input){
                    cltThumb.src = "__PUBLIC__"+res.url;
                    $scope.field.pic = res.url;
                }
            });
            form.on('submit(submit)', function (data) {
                // 提交到方法 默认为本身
                data.field.ad_id = $scope.field.ad_id;
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