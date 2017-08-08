<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"E:\phpStudy\WWW\cltphp/app/admin\view\auth\groupAccess.html";i:1491819016;}*/ ?>
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
    <link rel="stylesheet" href="__ADMIN__/zTree/css/zTreeStyle.css" type="text/css">
    <link rel="stylesheet" href="__ADMIN__/css/ztree.css" />
</head>
<body>
<div class="admin-main">
    <fieldset class="layui-elem-field">
        <legend>配置权限</legend>
        <div class="layui-field-box">
            <form class="layui-form layui-form-pane">
                <ul id="treeDemo" class="ztree"></ul>
                <div class="layui-form-item text-center">
                    <button type="button" class="layui-btn" lay-submit="" lay-filter="submit"><?php echo lang('submit'); ?></button>
                    <button class="layui-btn layui-btn-danger" type="button" onclick="window.history.back()"><?php echo lang('back'); ?></button>
                </div>
            </form>
        </div>

    </fieldset>
</div>
<script type="text/javascript" src="__ADMIN__/plugins/layui/layui.js"></script>
<script src="__STATIC__/js/jquery.2.1.1.min.js"></script>
<script type="text/javascript" src="__ADMIN__/zTree/js/jquery.ztree.core.min.js"></script>
<script type="text/javascript" src="__ADMIN__/zTree/js/jquery.ztree.excheck.min.js"></script>
<SCRIPT type="text/javascript">
    var setting = {
        check: {
            enable: true
        },
        view: {showLine: false, showIcon: false, dblClickExpand: false},
        data: {
            simpleData: {
                enable: true,
                pIdKey:'pid',
                idKey:'id'
            },
            key:{
                name:'title'
            }
        }
    };
    var zNodes =<?php echo $data; ?>;
    function setCheck() {
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        zTree.setting.check.chkboxType = { "Y":"ps", "N":"ps"};

    }
    $(document).ready(function(){
        $.fn.zTree.init($("#treeDemo"), setting, zNodes);
        setCheck();
        layui.use(['form', 'layer'], function () {
            var form = layui.form(), layer = layui.layer;
            form.on('submit(submit)', function () {
                // 提交到方法 默认为本身
                var treeObj=$.fn.zTree.getZTreeObj("treeDemo"),
                    nodes=treeObj.getCheckedNodes(true),
                    v="";
                for(var i=0;i<nodes.length;i++){
                    v+=nodes[i].id + ",";
                }
                var id = "<?php echo input('id'); ?>";
                $.post("<?php echo url('groupSetaccess'); ?>", {'rules':v,'id':id}, function (res) {
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

</SCRIPT>
</body>

</html>