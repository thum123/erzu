<!doctype html>
<html>
<head>
    <base href="<?php echo Yii::$app->request->baseUrl?>/" />
    <meta charset="UTF-8">
    <title>微e</title>
    <link rel="stylesheet" type="text/css" href="css/common.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <script type="text/javascript" src="js/libs/modernizr.min.js"></script>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.html" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="index.html">安装页面</a></li>
                <li><a href="#" target="_blank"></a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li><a href="http://www.jscss.me"></a></li>
                <li><a href="http://www.jscss.me"></a></li>
                <li><a href="http://www.jscss.me"></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container clearfix">

    <!--/sidebar-->
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font">&#xe06b;</i><span>欢迎来到微E安装页面</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-title">
                <h1></h1>
            </div>
            <div class="result-content">
                <div class="short-wrap">
                </div>
            </div>
        </div>
        <form action="<?php echo $url?>" method="post">
        <div class="result-wrap">
            <div class="result-title">
                <h1>开始安装</h1>
            </div>
            <div class="result-content">
                <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                <ul class="sys-info-list">
                    <li>
                        <label class="res-lab">数据库地址</label><span class="res-info"><input type="text" name='shujuku'></span>
                    </li>
                     <li>
                        <label class="res-lab">端口</label><span class="res-info"><input type="text" name='duankou'></span>
                    </li>
                    <li>
                        <label class="res-lab">用户名</label><span class="res-info"><input type="text" name='name'></span>
                    </li>
                    <li>
                        <label class="res-lab">密码</label><span class="res-info"><input type="password" name="pass"></span>
                    </li>
                    <li>
                        <label class="res-lab">数据库名字</label><span class="res-info"><input type="text" name="ku_name"></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="result-wrap">
            <div class="result-title">
            <input type="submit" value="下一步">
            </div>
           </form>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>