<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 网站访问IP黑名单
 * 
 * @package NotAllowIp
 * @author BlackStyle
 * @version 1.0.0
 * @link http://www.phalcon.xyz/
 */
class NotAllowIp_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 插件版本号
     * @var string
     */
    const _VERSION = '1.0.0';
    
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Archive')->header = array('NotAllowIp_Plugin', 'header');
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){}
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        /** 不允许访问网站ip */
        $not_allow_ip = new Typecho_Widget_Helper_Form_Element_Text('not_allow_ip', NULL, NULL, _t('IP黑名单'),'请输入ip地址，如果有多个请使用逗号隔开');
        $form->addInput($not_allow_ip);
    }
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}

    public function header(){
      $returnVal = self::check();
      if(empty($returnVal)){
         echo <<<EOF
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IP被限制 - 黑色格调</title>
    <link href="http://www.phalcon.xyz/usr/themes/GreenGrapes/favicon.ico" rel="shortcut icon"  type="image/x-icon">
    <!-- css -->
    <link rel="stylesheet" href="http://www.phalcon.xyz/usr/themes/GreenGrapes/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://www.phalcon.xyz/usr/themes/GreenGrapes/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://www.phalcon.xyz/usr/themes/GreenGrapes/css/main.css">
    <link rel="stylesheet" href="http://www.phalcon.xyz/usr/themes/GreenGrapes/css/prism.css">
    <script src="http://www.phalcon.xyz/usr/themes/GreenGrapes/js/prism.js"></script>
    <!-- 通过自有函数输出HTML头部信息 -->
            <style>
            #logo:after{
                content:url(http://www.phalcon.xyz/usr/themes/GreenGrapes/img/hat.png);
                display:block;
                position:absolute;
                top:25px;
                left:180px;/* 根据实际情况修改定位*/
            }
        </style>
        <meta name="description" content="我有故事和酒，你有麻辣小龙虾吗" />
<meta name="keywords" content="黑色格调,博客,个人,typecho,主题" />
<meta name="generator" content="Typecho 1.1/17.10.30" />
<meta name="template" content="GreenGrapes" />
<link rel="pingback" href="http://www.phalcon.xyz/action/xmlrpc" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://www.phalcon.xyz/action/xmlrpc?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://www.phalcon.xyz/action/xmlrpc?wlw" />
<link rel="alternate" type="application/rss+xml" title="页面没找到 &raquo; 黑色格调 &raquo; RSS 2.0" href="http://www.phalcon.xyz/feed/" />
<link rel="alternate" type="application/rdf+xml" title="页面没找到 &raquo; 黑色格调 &raquo; RSS 1.0" href="http://www.phalcon.xyz/feed/rss/" />
<link rel="alternate" type="application/atom+xml" title="页面没找到 &raquo; 黑色格调 &raquo; ATOM 1.0" href="http://www.phalcon.xyz/feed/atom/" />
<!-- Snow Start -->
<style>
    #Snow{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 99999;
        background: rgba(244,237,228,0.1);
        pointer-events: none;
    }
</style>
<!-- Snow End -->
</head>
<body>
<header id="l-header" class="l-header" style="background-image:url(http://phalcon.xyz/usr/themes/GreenGrapes/img/bg.jpg">
    <div class="hdbg"></div>
    <div class="hdbg2"></div>
    <div class="m-about">
        <div id="logo">
            <a href="http://www.phalcon.xyz/"><img src="http://phalcon.xyz/usr/themes/GreenGrapes/img/xigua.jpg" alt=""></a>
        </div>
        <h1 class="tit"><a href="http://www.phalcon.xyz/">黑色格调</a></h1>
        <div class="about">我有故事和酒，你有麻辣小龙虾吗</div>
    </div>
    <div id="header-canvas" style="width: 100%;height: 100%"></div>
</header>
<div id="m-nav" class="m-nav">
    <div class="m-nav-all">
        <div class="m-logo-url">
            <img src="http://phalcon.xyz/usr/themes/GreenGrapes/img/xigua.jpg">
            <h3></h3>
        </div>
                <ul class="nav">
            <li >
                <a href="http://www.phalcon.xyz/">首页</a>
            </li>

           <li>
               <a  href="http://www.phalcon.xyz/feed/">RSS</a>
           </li>

                    </ul>
    </div>
</div>
<form role="search" method="get" id="search-form" action="./">
    <div class="search-form">
        <span id="search-form-close">×</span>
        <input placeholder="Search for" name="s" id="search-input-s" type="text">
        <input class="webFont" id="searchsubmit" value="L" type="submit">
    </div>
</form>
<div id="m-header" class="m-header">
    <div id="showLeftPush" class="left m-header-button"></div>
    <h1><a href="http://www.phalcon.xyz/">黑色格调</a></h1>
    <div id="search-trigger" style="font-size: 18px;" class="right m-header-search"></div>
</div>
    <div class="container">
        <div class="error-page">
            <h2 class="post-title">404 - IP被限制</h2>
            <p style="color:red">您的IP访问异常，已被封 </p>
        </div>

    </div><!-- end #content-->







<div id="back-to-top" class="red" title="返回顶部" data-scroll="body" style="display: none;">
    <svg id="point-up" version="1.1" xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32">
        <path d="M23.588 17.637c-0.359-0.643-0.34-1.056-2.507-3.057 0.012-7.232-4.851-12.247-5.152-12.55 0-0.010 0-0.015 0-0.015s-0.003 0.003-0.007 0.007l-0.007-0.007c0 0 0 0.005 0 0.015-0.299 0.305-5.141 5.342-5.097 12.575-2.158 2.010-2.138 2.423-2.493 3.068-0.65 1.178-0.481 5.888 0.132 6.957 0.613 1.069 1.629 0.293 1.977-0.004 0.348-0.298 1.885-2.264 2.263-2.176 0 0 0.465-0.090 0.989 0.414 0.518 0.498 1.462 0.966 2.27 1.033 0 0.001 0 0.002-0 0.003 0.005-0.001 0.010-0.001 0.015-0.002 0.005 0 0.010 0.001 0.015 0.001 0-0.001-0-0.002 0-0.003 0.808-0.070 1.749-0.543 2.265-1.043 0.522-0.507 0.988-0.419 0.988-0.419 0.378-0.090 1.923 1.869 2.272 2.165 0.35 0.296 1.369 1.067 1.977-0.005 0.608-1.072 0.756-5.783 0.101-6.958v0 0zM15.95 14.86c-1.349 0.003-2.445-1.112-2.448-2.492-0.003-1.38 1.088-2.5 2.437-2.503 1.349-0.003 2.445 1.112 2.448 2.492 0.003 1.379-1.088 2.5-2.437 2.503v0 0zM17.76 24.876c-0.615 0.474-1.236 0.633-1.801 0.626-0.566 0.009-1.187-0.147-1.804-0.617-0.553-0.403-1.047-0.348-1.308 0.003-0.261 0.351-0.169 2.481 0.152 2.939 0.321 0.458 0.697-0.298 1.249-0.327 0.552-0.028 1.011 1.103 1.221 1.75 0.107 0.331 0.274 0.633 0.5 0.654 0.226-0.023 0.392-0.326 0.497-0.657 0.207-0.648 0.661-1.781 1.213-1.756 0.553 0.026 0.932 0.78 1.251 0.321 0.319-0.459 0.401-2.59 0.139-2.94-0.262-0.35-0.757-0.403-1.308 0.003v0 0z" fill="#CCCCCC"></path>
    </svg>
</div>
<footer id="m-footer">
    <div class="Copyright">
<p><a href='http://www.miitbeian.gov.cn/' target='_blank'>苏ICP备16068521号-1</a></p>
        <p>&copy; 2018 <a href="http://www.phalcon.xyz/">黑色格调</a>.
        All Rights Reserved. 版权所有.        </p>

    </div>
</footer>
<script src = "http://www.phalcon.xyz/usr/themes/GreenGrapes/js/jquery2.14.min.js"></script>
<script src = "http://www.phalcon.xyz/usr/themes/GreenGrapes/js/bootstrap.min.js"></script>
<script src = "http://www.phalcon.xyz/usr/themes/GreenGrapes/js/functionall.js"></script>
<script src = "http://www.phalcon.xyz/usr/themes/GreenGrapes/js/tagcanvas.min.js"></script>
<script src = "http://www.phalcon.xyz/usr/themes/GreenGrapes/js/particles.min.js"></script>
<script src = "http://www.phalcon.xyz/usr/themes/GreenGrapes/js/headerCanvas.js"></script>
<script src = "http://www.phalcon.xyz/usr/themes/GreenGrapes/js/home.js"></script>
<!-- Snow Start -->
<canvas id="Snow"></canvas>
<script>
    if(true){
        (function() {
            var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame ||
            function(callback) {
                window.setTimeout(callback, 1000 / 60);
            };
            window.requestAnimationFrame = requestAnimationFrame;
        })();
        
        (function() {
            var flakes = [],
                canvas = document.getElementById("Snow"),
                ctx = canvas.getContext("2d"),
                flakeCount = 150,
                mX = -100,
                mY = -100;
            
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            
            function snow() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            
                for (var i = 0; i < flakeCount; i++) {
                    var flake = flakes[i],
                        x = mX,
                        y = mY,
                        minDist = 150,
                        x2 = flake.x,
                        y2 = flake.y;
            
                    var dist = Math.sqrt((x2 - x) * (x2 - x) + (y2 - y) * (y2 - y)),
                        dx = x2 - x,
                        dy = y2 - y;
            
                    if (dist < minDist) {
                        var force = minDist / (dist * dist),
                            xcomp = (x - x2) / dist,
                            ycomp = (y - y2) / dist,
                            deltaV = force / 2;
            
                        flake.velX -= deltaV * xcomp;
                        flake.velY -= deltaV * ycomp;
            
                    } else {
                        flake.velX *= .98;
                        if (flake.velY <= flake.speed) {
                            flake.velY = flake.speed
                        }
                        flake.velX += Math.cos(flake.step += .05) * flake.stepSize;
                    }
            
                    ctx.fillStyle = "rgba(255,255,255," + flake.opacity + ")";
                    flake.y += flake.velY;
                    flake.x += flake.velX;
                        
                    if (flake.y >= canvas.height || flake.y <= 0) {
                        reset(flake);
                    }
            
                    if (flake.x >= canvas.width || flake.x <= 0) {
                        reset(flake);
                    }
            
                    ctx.beginPath();
                    ctx.arc(flake.x, flake.y, flake.size, 0, Math.PI * 2);
                    ctx.fill();
                }
                requestAnimationFrame(snow);
            };
            
            function reset(flake) {
                flake.x = Math.floor(Math.random() * canvas.width);
                flake.y = 0;
                flake.size = (Math.random() * 3) + 2;
                flake.speed = (Math.random() * 1) + 0.4;
                flake.velY = flake.speed;
                flake.velX = 0;
                flake.opacity = (Math.random() * 0.5) + 0.3;
            }
            
            function init() {
                for (var i = 0; i < flakeCount; i++) {
                    var x = Math.floor(Math.random() * canvas.width),
                        y = Math.floor(Math.random() * canvas.height),
                        size = (Math.random() * 3) + 2,
                        speed = (Math.random() * 1) + 0.4,
                        opacity = (Math.random() * 0.5) + 0.3;
            
                    flakes.push({
                        speed: speed,
                        velY: speed,
                        velX: 0,
                        x: x,
                        y: y,
                        size: size,
                        stepSize: (Math.random()) / 30 * 1,
                        step: 0,
                        angle: 180,
                        opacity: opacity
                    });
                }
            
                snow();
            };
            
            document.addEventListener("mousemove", function(e) {
                mX = e.clientX,
                mY = e.clientY
            });
            window.addEventListener("resize", function() {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
            });
            init();
        })();
    }
</script>
<!-- Snow End -->
</body>
</html>
EOF;
exit;
      }
    }
    /**
     * 检测ip黑名单
     * 
     * @access public
     * @return bool
     */
    public static function check()
    {

        static $realip = NULL;
        //判断服务器是否允许$_SERVER
        if(isset($_SERVER)) {
            if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }elseif(isset($_SERVER['HTTP_CLIENT_IP'])) {
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            }else {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
        }else{
            //不允许就使用getenv获取
            if(getenv("HTTP_X_FORWARDED_FOR")) {
                $realip = getenv( "HTTP_X_FORWARDED_FOR");
            }elseif(getenv("HTTP_CLIENT_IP")) {
                $realip = getenv("HTTP_CLIENT_IP");
            }else {
                $realip = getenv("REMOTE_ADDR");
            }
        }

        if($realip !== NULL){
            $config = json_decode(json_encode(unserialize(Helper::options()->plugin('NotAllowIp'))));
            $not_allow_ip_arr = str_replace('，',',',$config->not_allow_ip);
            $not_allow_ip = explode(',', $not_allow_ip_arr);

            if(!empty($config->not_allow_ip)){
                if(in_array($realip,$not_allow_ip)){
                   return false;
                }
            }
            return true;
        }else{
            return false;
        }
    }
}
