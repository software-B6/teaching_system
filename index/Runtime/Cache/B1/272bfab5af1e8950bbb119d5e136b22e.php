<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bootstrap Admin</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">



    <!--<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">-->
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/lib/bootstrap/css/bootstrap.css" />
    <!--<link rel="stylesheet" type="text/css" href="stylesheets/theme.css">-->
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/stylesheets/theme.css" />
    <!--<link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">-->
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/lib/font-awesome/css/font-awesome.css" />

    <!--<script src="lib/jquery-1.7.2.min.js" type="text/javascript"></script>-->
    <script type="text/javascript" src="__ROOT__/public/lib/jquery-1.7.2.min.js"></script>

    <!-- Demo page code -->

    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
</head>

<!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
<!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
<!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
<!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<body class="">
<!--<![endif]-->

<div class="navbar">
    <div class="navbar-inner">
        <ul class="nav pull-right">
            <li><a href="#" class="hidden-phone visible-tablet visible-desktop" role="button">Settings(没有写)</a></li>
            <li><a tabindex="-1" href="__APP__/user/logout">登出</a></li>
        </ul>
    </div>
</div>



<div class="sidebar-nav">
    <a href="faq.html" class="nav-header" ><i class="icon-question-sign"></i>欢迎(没写)</a>

    <a href="#account" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>管理员账户</a>
    <ul id="account" class="nav nav-list collapse in">
        <li><a href="__APP__/B1/admin/add_student">添加学生</a></li>
        <li><a href="__APP__/B1/admin/add_teacher">添加教师</a></li>
        <li><a href="__APP__/B1/admin/add_course">添加课程</a></li>
        <li><a href="__APP__/B1/admin/search_student">搜索学生</a></li>
        <li><a href="__APP__/B1/admin/search_teacher">搜索教师</a></li>
        <li><a href="__APP__/B1/admin/search_course">搜索课程</a></li>
    </ul>

    <a href="#elective-system-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>选课系统</a>
    <ul id="elective-system-menu" class="nav nav-list collapse in">
        <li><a href="__APP__/B3/Course">搜索课程</a></li>
        <li><a href="__APP__/B3/Selection">选课</a></li>
        <li><a href="__APP__/B3/Calendar">课表</a></li>
        <li><a href="__APP__/B3/List">学生名单</a></li>
        <li><a href="__APP__/B3/Admin">管理员</a></li>
        <li><a href="__APP__/B3/Plan">培养方案</a></li>
    </ul>

	<a href="#grade-manage" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>成绩管理</a>
    <ul id="grade-manage" class="nav nav-list collapse in">
        <li><a href="__APP__/B6/Admin ">申请处理</a></li>
        <li><a href="__APP__/B6/Query ">学生成绩查询</a></li>
        <li><a href="__APP__/B6/Management ">教学班成绩管理</a></li>
        <li><a href="__APP__/B6/SAnalyse ">学生成绩分析</a></li>
        <li><a href="__APP__/B6/TAnalyse ">教学班成绩分析</a></li>
        <li><a href="__APP__/B6/Credit ">学分进展统计</a></li>
    </ul>

    <a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>Dashboard</a>
    <ul id="dashboard-menu" class="nav nav-list collapse in">
        <li><a href="index.html">Sort</a></li>
        <li ><a href="import.html">Import The Data</a></li>
        <li ><a href="edit_data.html">Edit The Data</a></li>
        <li ><a href="adjust_course.html">Adjust</a></li>
        <li ><a href="query_print.html">Query&Print</a></li>

    </ul>

    <a href="#error-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-exclamation-sign"></i>Error Pages <i class="icon-chevron-up"></i></a>
    <ul id="error-menu" class="nav nav-list collapse">
        <li ><a href="403.html">403 page</a></li>
        <li ><a href="404.html">404 page</a></li>
        <li ><a href="500.html">500 page</a></li>
        <li ><a href="503.html">503 page</a></li>
    </ul>


    <a href="faq.html" class="nav-header" ><i class="icon-question-sign"></i>Help</a>
</div>
<div class="content">

    <div class="header">

        <h1 class="page-title"><?php echo ($actionName); ?></h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="__APP__">成绩管理</a> <span class="divider">/</span></li>
        <li class="active"><a href="__SELF__" ><?php echo ($actionName); ?></a></li>
    </ul>


        <center>
            <dir>欢迎你，<?php echo ($info['name']); ?>!</dir>
            <form method="post" action="__URL__/update">
                <input type="hidden" name="id" value="<?php echo ($info['id']); ?>"></input>
                <table>
                    <tr>
                        <td>id</td>
                        <td><?php echo ($info['id']); ?></td>
                    </tr>
                    <tr>
                        <td>name</td>
                        <td><?php echo ($info['name']); ?></td>
                    </tr>
                    <tr>
                        <td>注册时间</td>
                        <td><?php echo ($info['create_time']); ?></td>
                    </tr>
                    <tr>
                        <td>电话</td>
                        <td><input type="text" name="phone" value="<?php echo ($info['phone']); ?>"></input></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="修改"></input></td>
                    </tr>
                </table>
            </form>
        </center>




<script type="text/javascript" src="__ROOT__/public/lib/bootstrap/js/bootstrap.js"></script>

<!--<script src="lib/bootstrap/js/bootstrap.js"></script>-->
<script type="text/javascript">
    $("[rel=tooltip]").tooltip();
    $(function() {
        $('.demo-cancel-click').click(function(){return false;});
    });
</script>

</body>
</html>