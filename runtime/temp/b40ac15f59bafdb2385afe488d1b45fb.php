<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:53:"E:\phpStudy\WWW\cltphp/app/home\view\index-index.html";i:1498035779;s:53:"E:\phpStudy\WWW\cltphp/app/home\view\common-head.html";i:1498035173;s:55:"E:\phpStudy\WWW\cltphp/app/home\view\common-footer.html";i:1497948115;}*/ ?>
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
<script>
    $(document).ready(function() {
        //Camera Jquery
        $('#camera-slide').camera({
            thumbnails: false,
            hover: false,
            pagination: false,
        });
    });
</script>
<!-- slideshow start here -->
<section id="slideshow-wrapper">
    <div class="camera_wrap" id="camera-slide">
        <!-- slide 1 here -->
        <?php if(is_array($adList) || $adList instanceof \think\Collection || $adList instanceof \think\Paginator): $i = 0; $__LIST__ = $adList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($i == 1): ?>
        <div data-src="__HOME__/images/slideshow/bg-slide1.jpg">
            <div class="caption-type1 moveFromLeft">
                <h1><?php echo $vo['name']; ?></h1>
                <p><?php echo $vo['content']; ?></p>
                <a href="<?php echo $vo['url']; ?>/admin" target="_blank" class="button-slide medium gray">演示站点</a>
            </div>
            <div class="caption-type1 moveFromRight">
                <img src="__HOME__/images/slideshow/slide1.png" alt="" />
            </div>
        </div>
        <?php elseif($i == 2): ?>
        <!-- slide 2 here -->
        <div data-src="__HOME__/images/slideshow/bg-slide2.jpg">
            <div class="caption-type2 moveFromTop">
                <h1><?php echo $vo['name']; ?></h1>
                <p><?php echo $vo['content']; ?></p>
            </div>
            <div class="caption-type2 moveFromBottom">
                <img src="__HOME__/images/slideshow/slide2.png" alt="" />
            </div>
        </div>
        <?php else: ?>
        <!-- slide 3 here -->
        <div data-src="__HOME__/images/slideshow/bg-slide3.jpg">
            <div class="caption-type3 moveFromLeft">
                <img src="__HOME__/images/slideshow/slide3.png" alt="" />
            </div>
            <div class="caption-type3 moveFromRight">
                <h1><?php echo $vo['name']; ?></h1>
                <p><?php echo $vo['content']; ?></p>
                <!--<img src="__HOME__/images/slideshow/slide3a.png" alt="" class="html-badge" />-->
            </div>
        </div>
        <?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div id="slideshow-noscript"><h4>你准备好与CLTPHP共同搭建您的网络平台了吗？</h4></div>
</section>
<!-- slideshow end here --> 
<div class="copyrights">Collect from <a href="http://www.cssmoban.com/"  title="网站模板">网站模板</a></div>
<!-- featured client start here -->
<section id="featured-wrapper">
    <div id="featured-logo-list">
        <div class="row">
            <div class="two columns mobile-two mobile-view">
                <h6 class="featured-client">第三方资源 :</h6>
            </div>
            <div class="two columns mobile-two mobile-view">
                <img src="__HOME__/images/sample-images/client1.png" alt="client-image" />
            </div>
            <div class="two columns mobile-two mobile-view">
                <img src="__HOME__/images/sample-images/client2.png" alt="client-image" />
            </div>
            <div class="two columns mobile-two mobile-view">
                <img src="__HOME__/images/sample-images/client3.png" alt="client-image" />
            </div>
            <div class="two columns mobile-two mobile-view">
                <img src="__HOME__/images/sample-images/client4.png" alt="client-image" />
            </div>
            <div class="two columns mobile-two mobile-view">
                <img src="__HOME__/images/sample-images/client5.png" alt="client-image" />
            </div>
        </div>
    </div>
</section>
<!-- featured client end here -->

<!-- maincontent start here -->
<section id="content-wrapper">
    <div class="row">
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <div class="three columns mobile-two">
            <h5><a style="<?php echo $vo['title_color']; ?>;<?php echo $vo['title_weight']; ?>" href="<?php echo url('news/info',array('id'=>$vo['id'],'catId'=>$vo['catid'])); ?>"><?php echo $vo['title']; ?></a></h5>
            <div class="link-url">
                <a href="<?php echo url('news/info',array('id'=>$vo['id'],'catId'=>$vo['catid'])); ?>" target="_blank" title="<?php echo $vo['title']; ?>">
                    <img src="<?php echo $vo['title_thumb']; ?>" alt="" class="fade" />
                </a>
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div id="featured-wrapper2">
        <div class="row front-feature-icon">
            <div class="four columns mobile-one">
                <img src="__HOME__/images/sample-images/front-icon1.png" alt="" class="img-center" />
                <h5>我们的差异化</h5>
                <p>给您自由的模型构建权利，让您的想法通过您亲自操作实现。不要再为传统的数据库字段限制而发愁。一步删除，一步增加，您想要的，就是这一步。</p>
            </div>
            <div class="four columns mobile-one">
                <img src="__HOME__/images/sample-images/front-icon2.png" alt="" class="img-center" />
                <h5>完整的建站理念</h5>
                <p>构建模型，让数据库随心而动，让内容表单随意而变。模型和栏目的绑定，是为了让前台页面能更好的为您的想法服务，让您不再为建站留下遗憾。</p>
            </div>
            <div class="four columns mobile-one">
                <img src="__HOME__/images/sample-images/front-icon3.png" alt="" class="img-center" />
                <h5>简单、高效、低门槛</h5>
                <p>全程鼠标操作，不用手动建立数据库，不用画网站结构图，也不用打开代码编译器。模版编辑，再高效建站的同时，让网站建设达到前所未有的极致简单。</p>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="twelve columns">
            <div class="featured-box">
                <div class="nine columns">
                    <h5>你准备好与CLTPHP共同打造您的网络平台了吗？</h5>
                    <p>CLTPHP建站系统免费下载，只有您的支持，才能使得我们在开源的世界里走的更好！</p>
                </div>
                <div class="three columns">
                    <a href="http://o95ehky7c.bkt.clouddn.com/cltphp3.5.zip" class="button medium gray arrow-icon">前往下载</a>
                </div>
                <div class="clear"></div>
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