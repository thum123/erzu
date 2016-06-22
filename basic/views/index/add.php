<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>添加公众号</title>
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
                <li><a class="on" href="index.html">首页</a></li>
                <li><a href="#" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li><a href="http://www.jscss.me">管理员</a></li>
                <li><a href="http://www.jscss.me">修改密码</a></li>
                <li><a href="http://www.jscss.me">退出</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container clearfix">
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                        <li><a href="index.php?r=index/addwe"><i class="icon-font">&#xe008;</i>添加公众号</a></li>
                        <li><a href="index.php?r=lists/lists"><i class="icon-font">&#xe005;</i>公众号列表</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe006;</i>分类管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe004;</i>留言管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe012;</i>评论管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe052;</i>友情链接</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe033;</i>广告管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="system.html"><i class="icon-font">&#xe017;</i>系统设置</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe037;</i>清理缓存</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe046;</i>数据备份</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe045;</i>数据还原</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--/sidebar-->
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/think/admin">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">系统设置</span></div>
        </div>
        <div class="result-wrap">
            <form action="/think/admin/system/save" method="post" id="myform" name="myform">
                <div class="config-items">
                    <div class="config-title">
                        <h1><i class="icon-font">&#xe00a;</i>网站信息设置</h1>
                    </div>
                    <div class="result-content">
                                               <table width="100%" class="insert-tab">
                            <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                            <tbody><!-- <tr>
                                <th width="15%"><i class="require-red">*</i>域名：</th>
                                <td><input type="text" id="url" value="" size="85" name="url" class="common-text"></td>
                            </tr> -->
                                <tr>
                                    <th><i class="require-red">*</i>公众号名称:</th>
                                    <td><input type="text" id="we_name" value="" size="85" name="we_name" class="common-text"></td>
                                </tr>
                                <tr>
                                    <th><i class="require-red">*</i>公众号类型:</th>
                                    <td><select name="we_sta" id="we_sta">
                                        <option value="1">订阅号</option>
                                        <option value="2">服务号</option>
                                        <option value="3">企业号</option>
                                        <option value="4">测试号</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <th><i class="require-red">*</i>AppId：</th>
                                    <td><input type="text" id="appid" value="" size="85" name="appid" class="common-text"></td>
                                </tr>
                                <tr>
                                    <th><i class="require-red">*</i>AppSecret：</th>
                                    <td><input type="text" id="appsecret" value="" size="85" name="appsecret" class="common-text"></td>
                                </tr>
                                <tr>
                                    <th><i class="require-red">*</i>微信号:</th>
                                    <td><input type="text" id="we_num" value="" size="85" name="we_num" class="common-text"></td>
                                </tr>
                                <tr>
                                    <th id='u' style=display:none;><i class="require-red">*</i>URL:</th>
                                    <td><input type="text"  style=display:none;  id='url' value="" size="85" class="common-text"></td>
                                </tr>
                                <tr>
                                    <th id="t" style=display:none;><i class="require-red">*</i>Token:</th>
                                    <td><input type="text" id='token' style=display:none; value="" size="85" class="common-text"></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>
                                        <input type="button" id="suo" onclick="tijiao()" value="提交" class="btn btn-primary btn6 mr10">
                                        <input type="button" value="返回" onclick="history.go(-1)" class="btn btn6">
                                    </td>
                                </tr>
                          
                            </tbody></table>
                         
                    </div>
                </div>
            
            </form>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>
<script src="jq.js"></script>
<script>
    function tijiao()
    {
        // var url = $("#url").val();
        var we_name = $("#we_name").val();
        var we_sta = $("#we_sta").val();
        var appid = $("#appid").val();
        var appsecret = $("#appsecret").val();
        var we_num = $("#we_num").val();
        var data = {'we_name':we_name,'we_sta':we_sta,'we_num':we_num,'appsecret':appsecret,'appid':appid};
        $.get('index.php?r=index/addacc',data,function(msg){
           if(msg==1)
           {
                alert('配置失败');
           }
           else
           {
                alert('配置成功');
                document.getElementById('u').style.display='block';
                document.getElementById('url').style.display='block';
                document.getElementById('t').style.display='block';
                document.getElementById('token').style.display='block';
                document.getElementById('suo').style.display='none';
                $("#url").val(msg['url']);
                $("#token").val(msg['token']);
           }
        },'json');
    }
</script>