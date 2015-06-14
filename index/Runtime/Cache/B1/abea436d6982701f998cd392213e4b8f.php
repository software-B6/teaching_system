<?php if (!defined('THINK_PATH')) exit();?><!-- <!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
    <div>
        <form method="post" id="form" action="__URL__/login">
            <h2>用户登录</h2>
            <input placeholder="id" type="text" name="id"></input>
            <input placeholder="密码" type="password" name="password"></input>
            <input type="radio" name="user_type" id="admin" value="admin" checked="checked">管理员</input>
            <input type="radio" name="user_type" id="teacher" value="teacher">教师</input>
            <input type="radio" name="user_type" id="student" value="student">学生</input>
            <input type="submit" value="登录" ></input>
        </form>
    </div>
    </body>
</html>
 -->

 <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bootstrap Admin</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="__ROOT__/public/lib/bootstrap/css/bootstrap.css">
    
    <link rel="stylesheet" type="text/css" href="__ROOT__/public/stylesheets/theme.css">
    <link rel="stylesheet" href="__ROOT__/public/lib/font-awesome/css/font-awesome.css">

    <script src="__ROOT__/public/lib/jquery-1.7.2.min.js" type="text/javascript"></script>

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
                    
                </ul>
                <a class="brand" href="index.html"><span class="first">Course</span> <span class="second">Arrangements</span></a>
        </div>
    </div>
    


    

    
        <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">用户登录</p>
            <div class="block-body">
                <form method="post" id="form" action="__URL__/login">
                    <label>用户名</label>
                    <input type="text" class="span12" name="id">
                    <label>密码</label>
                    <input type="password" class="span12" name="password">
                    <input type="radio" name="user_type" id="admin" value="admin" checked="checked">管理员</input>
                    <input type="radio" name="user_type" id="teacher" value="teacher">教师</input>
                    <input type="radio" name="user_type" id="student" value="student">学生</input>
                    <!-- <a href="index.html" class="btn btn-primary pull-right">Sign In</a> -->
                    <input type="submit" value="登录" class="btn btn-primary pull-right"></input>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>


    


    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>