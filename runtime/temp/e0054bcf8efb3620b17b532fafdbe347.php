<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:51:"E:\phpStudy\WWW\cltphp/app/home\view\team-list.html";i:1498012828;s:53:"E:\phpStudy\WWW\cltphp/app/home\view\common-head.html";i:1498035173;s:55:"E:\phpStudy\WWW\cltphp/app/home\view\common-footer.html";i:1497948115;}*/ ?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="zh-cn"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="zh-cn"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="zh-cn"> <!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title><?php echo $title; ?>-<?php echo $sys['name']; ?></title>
    <meta name="keywords" content="<?php echo $sys['key']; ?>" />
    <meta name="description" content="<?php echo $sys['des']; ?>" />
    <!-- ////////////////////////////////// -->
    <!-- //      Stylesheets Files       // -->
    <!-- ////////////////////////////////// -->
    <link rel="stylesheet" href="__HOME__/css/base.css" id="camera-css" />
    <link rel="stylesheet" href="__HOME__/css/framework.css" />
    <link rel="stylesheet" href="__HOME__/css/style.css" />
    <link rel="stylesheet" href="__HOME__/css/noscript.css" media="screen,all" id="noscript" />

    <!-- ////////////////////////////////// -->
    <!-- //     Google Webfont Files     // -->
    <!-- ////////////////////////////////// -->


    <!-- ////////////////////////////////// -->
    <!-- //        Favicon Files         // -->
    <!-- ////////////////////////////////// -->
    <link rel="shortcut icon" href="__HOME__/images/favicon.ico" />

    <!-- ////////////////////////////////// -->
    <!-- //      Javascript Files        // -->
    <!-- ////////////////////////////////// -->
    <script>
        var HOME = '__HOME__';
    </script>
    <script src="__HOME__/js/jquery.min.js"></script>
    <script src="__HOME__/js/jquery.easing-1.3.min.js"></script>
    <script src="__HOME__/js/tooltip.js"></script>
    <script src="__HOME__/js/dropdown.js"></script>
    <script src="__HOME__/js/tinynav.min.js"></script>
    <script src="__HOME__/js/camera.min.js"></script>
    <script src="__HOME__/js/jquery.fancybox.js?v=2.0.6"></script>
    <script src="__HOME__/js/jquery.fancybox-media.js?v=1.0.3"></script>
    <script src="__HOME__/js/jquery.ui.totop.min.js"></script>
    <script src="__HOME__/js/ddaccordion.js"></script>
    <script src="__HOME__/js/jquery.twitter.js"></script>
    <script src="__HOME__/js/jflickrfeed.min.js"></script>
    <script src="__HOME__/js/faq-functions.js"></script>
    <script src="__HOME__/js/isotope.js"></script>
    <script src="__HOME__/js/theme-functions.js"></script>
    <script>
        //设为首页 www.jb51.net
        function SetHome(obj,url){
            try{
                obj.style.behavior='url(#default#homepage)';
                obj.setHomePage(url);
            }catch(e){
                if(window.netscape){
                    try{
                        netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
                    }catch(e){
                        alert("抱歉，此操作被浏览器拒绝！\n\n请在浏览器地址栏输入“about:config”并回车然后将[signed.applets.codebase_principal_support]设置为'true'");
                    }
                }else{
                    alert("抱歉，您所使用的浏览器无法完成此操作。\n\n您需要手动将【"+url+"】设置为首页。");
                }
            }
        }

        //收藏本站 www.jb51.net
        function AddFavorite(title, url) {
            try {
                window.external.addFavorite(url, title);
            }
            catch (e) {
                try {
                    window.sidebar.addPanel(title, url, "");
                }
                catch (e) {
                    alert("抱歉，您所使用的浏览器无法完成此操作。\n\n加入收藏失败，请进入新网站后使用Ctrl+D进行添加");
                }
            }
        }
    </script>
    <!-- IE Fix for HTML5 Tags -->
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body>
<!-- header start here -->
<header>
    <div id="main-wrapper">

        <!-- top-social start here -->
        <div id="top-social">
            <a class="trigger" href="#"></a>
            <div class="social-panel">
                <ul>
                    <li><a href="javascript:void(0);" onclick="SetHome(this,'<?php echo config('url_domain_root'); ?>');">设为首页</a></li>
                    <li><a href="javascript:void(0);" onclick="AddFavorite('<?php echo config('sys_name'); ?>','<?php echo config('url_domain_root'); ?>')">加入收藏</a></li>
                </ul>
            </div>
        </div>
        <!-- top-social end here -->

        <!-- logo start here -->
        <div id="logo">
            <a href="index.html"><img src="__HOME__/images/logo.png" alt="mainlogo" /></a>
        </div>
        <!-- logo end here -->
        <!-- mainmenu start here -->
        <nav id="mainmenu">
            <ul id="menu">
                <li <?php if($controller == 'index'): ?>class="selected"<?php endif; ?>><a href="<?php echo url('index/index'); ?>" >首页</a></li>

                <?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li <?php if($controller == $vo['catdir']): ?>class="selected"<?php endif; ?>>
                    <?php if($vo['child'] == 1): ?>
                        <a href="#" ><?php echo $vo['catname']; ?></a>
                        <ul>
                            <?php if(is_array($vo['sub']) || $vo['sub'] instanceof \think\Collection || $vo['sub'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                <li><a href="<?php echo url('home/'.$vo['catdir'].'/'.$vo['first'],['catId'=>$v['id']] ); ?>"><span>-</span> <?php echo $v['catname']; ?></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    <?php else: ?>
                        <a href="<?php echo url('home/'.$vo['catdir'].'/'.$vo['first'],['catId'=>$vo['firstId']] ); ?>" ><?php echo $vo['catname']; ?></a>
                    <?php endif; ?>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </nav>
        <!-- mainmenu end here -->

    </div>
</header>
<!-- header end here -->

<!-- pagetitle start here -->
<section id="pagetitle-wrapper">
    <div class="pagetitle-content">
        <h2><?php echo $title; ?></h2>
    </div>
</section>
<!-- pagetitle end here -->

<!-- breadcrumb start here -->
<section id="breadcrumb-wrapper">
    <div id="breadcrumb-content">
        <ul>
            <li><a href="<?php echo url('index/index'); ?>">首页</a></li>
            <li><a href="#"><?php echo $title; ?></a></li>
        </ul>
    </div>
</section>
<!-- breadcrumb end here -->

<!-- maincontent start here -->
<section id="content-wrapper">
    <div class="row">
        <div class="twelve columns">
            <div class="row">
                <div class="twelve columns">
                    <!-- begin of testimonials 1 -->
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <div class="testi-tape"></div>
                    <div class="testi-container">
                        <div class="testi-text">
                            <p class="testi-name"><?php echo $vo['title']; ?></p>
                            <blockquote>
                                <p><?php echo $vo['info']; ?></p>
                            </blockquote>
                        </div>
                        <div class="testi-image">
                            <img src="<?php echo $vo['title_thumb']; ?>" alt="<?php echo $vo['title']; ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- maincontent end here -->
<!-- footer start here -->
<footer>
    <div class="row">
        <div class="three columns mobile-two">
            <img src="__HOME__/images/logo2.png" alt="" class="img-left" />
            <p class="copyright-text">&copy; Copyright &copy; 2017.Company name All rights reserved.</p>
        </div>
        <div class="three columns mobile-two">
            <h5>联系我们</h5>
            <ul>
                <li class="address-icon"><a href="http://www.cltphp.com">CLTPHP</a></li>
                <li class="qq-icon">QQ交流群 : 229455880</li>
                <li class="email-icon">Email : 1109305987@qq.com</li>
            </ul>
        </div>
        <div class="three columns mobile-two">
            <h5>友情链接</h5>
            <ul>
                <?php if(is_array($linkList) || $linkList instanceof \think\Collection || $linkList instanceof \think\Paginator): $i = 0; $__LIST__ = $linkList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li><a href="<?php echo $vo['url']; ?>" target="_blank"><?php echo $vo['name']; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <li><a href="<?php echo url('contact/index','catId=43'); ?>">联系我们</a></li>
            </ul>
        </div>
        <div class="three columns mobile-two">
            <h5>扫码捐助</h5>
            <div class="wxsq">
                <img src="__HOME__/images/wxsq.png">
            </div>
        </div>
    </div>
</footer>
<!-- footer end here -->

<script>$('#noscript').remove();</script>

</body>
</html>