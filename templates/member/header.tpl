<!doctype html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Amaze UI Admin index Examples</title>
        <meta name="description" content="这是一个 index 页面">
        <meta name="keywords" content="index">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="renderer" content="webkit">
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <link rel="icon" type="image/png" href="assets/i/favicon.png">
        <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
        <meta name="apple-mobile-web-app-title" content="Amaze UI" />
        <link rel="stylesheet" href="assets/css/amazeui.min.css"/>
        <link rel="stylesheet" href="assets/css/admin.css">
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/app.js"></script>
        <script src="/js/main.js"></script>
    </head>
    <body>    
        <!--[if lte IE 9]><p class="browsehappy">升级你的浏览器吧！ <a href="http://se.360.cn/" target="_blank">升级浏览器</a>以获得更好的体验！</p><![endif]-->
    </head>

<body>
    <header class="am-topbar admin-header">
        <div class="am-topbar-brand"><img src="assets/i/logo.png"></div>

        <div class="am-collapse am-topbar-collapse" id="topbar-collapse">
            <ul class="am-nav am-nav-pills am-topbar-nav admin-header-list">

                <li class="am-dropdown tognzhi" data-am-dropdown>
                    <button class="am-btn am-btn-primary am-dropdown-toggle am-btn-xs am-radius am-icon-bell-o" data-am-dropdown-toggle> 消息管理<span class="am-badge am-badge-danger am-round">6</span></button>
                    <ul class="am-dropdown-content">



                        <li class="am-dropdown-header">所有消息都在这里</li>



                        <li><a href="#">未激活会员 <span class="am-badge am-badge-danger am-round">556</span></a></li>
                        <li><a href="#">未激活代理 <span class="am-badge am-badge-danger am-round">69</span></a></a></li>
                        <li><a href="#">未处理汇款</a></li>
                        <li><a href="#">未发放提现</a></li>
                        <li><a href="#">未发货订单</a></li>
                        <li><a href="#">低库存产品</a></li>
                        <li><a href="#">信息反馈</a></li>



                    </ul>
                </li>

                <li class="kuanjie">
                    <{foreach $aMainMenu as $main_val}>
                    <a href="/service.php?business=dc&controller=member&action=index&main_id=<{$main_val.id}>"><{$main_val.title}></a>
                    <{/foreach}>
                </li>

                <li class="soso">

                    <p>   

                        <select data-am-selected="{btnWidth: 70, btnSize: 'sm', btnStyle: 'default'}">
                            <option value="b">全部</option>
                            <option value="o">产品</option>
                            <option value="o">会员</option>

                        </select>

                    </p>

                    <p class="ycfg"><input type="text" class="am-form-field am-input-sm" placeholder="圆角表单域" /></p>
                    <p><button class="am-btn am-btn-xs am-btn-default am-xiao"><i class="am-icon-search"></i></button></p>
                </li>




                <li class="am-hide-sm-only" style="float: right;"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
            </ul>
        </div>
    </header>

    <div class="am-cf admin-main"> 

        <div class="nav-navicon admin-main admin-sidebar">


            <div class="sideMenu am-icon-dashboard" style="color:#aeb2b7; margin: 10px 0 0 0;"> 欢迎会员：<{$username}></div>
            <div class="sideMenu">
                <{foreach $aSubMenu["sub_menu"] as $key1=>$main_val1}>     
                <h3 class="<{$main_val1['css_style']}> <{if $main_val1['id']|in_array:$aCheckMenu}>am-active on<{/if}>"><em></em> <a href="<{$main_val1['path']}>"><{$main_val1['title']}></a></h3>
                <ul>
                    <{foreach $main_val1['sub_menu'] as $sub_key=>$sub_menu_val}>
                    <{if $sub_menu_val['path'] == "#" || $sub_menu_val['path'] == ""}>
                    <li><a href='javascript:void(0);'><{$sub_menu_val['title']}></a></li>
                    <{else}>
                    <li><a href='<{$sub_menu_val['path']}>&menu_sub_id=<{$sub_menu_val['id']}>&menu_sub_title=<{$sub_menu_val['title']}>'><{$sub_menu_val['title']}></a></li>                        
                    <{/if}>
                    <{/foreach}>
                </ul>
                <{/foreach}>      
            </div>
            <!-- sideMenu End --> 

            <script type="text/javascript">
                jQuery(".sideMenu").slide({
                    titCell: "h3", //鼠标触发对象
                    targetCell: "ul", //与titCell一一对应，第n个titCell控制第n个targetCell的显示隐藏
                    effect: "slideDown", //targetCell下拉效果
                    delayTime: 300, //效果时间
                    triggerTime: 150, //鼠标延迟触发时间（默认150）
                    defaultPlay: true, //默认是否执行效果（默认true）
                    returnDefault: true //鼠标从.sideMen移走后返回默认状态（默认false）
                });
            </script> 
            <script type="text/javascript">   
                function loadEditForm(url) {
                    $.post(url, {},
                    function(data) {    
                        $("#form1").html(data["data"]);
                        $('#my-popup').modal();
                    }, "json");
                }
            </script>
        </div>
        <div class=" admin-content">
            <div class="daohang">
                <ul>
                    <{foreach $aPassMenu as $val}> 
                    <li>
                        <button type="button" class="am-btn am-btn-default am-radius am-btn-xs">
                            <{$val->title}>
                    </li>
                    <{/foreach}>
            </div>
            <div class="am-popup am-popup-inner" id="my-popup">
                <div class="am-popup-hd">
                    <h4 class="am-popup-title">编辑</h4>
                    <span data-am-modal-close class="am-close">&times;</span> 
                </div>
                 <div class="am-popup-bd">
                    <form class="am-form tjlanmu" id="form1">                        
                    </form>
                </div>
            </div>            