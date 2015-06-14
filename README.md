# 2015/6/11 B1组更新
##帐号问题
教师和学生的帐号密码采用md5的方式进行加密，这是不可逆的，密码post到服务器的时候，会进行一次md5运算，然后进行比对
**请大家更新数据库，否则学生和教师因为帐号原因会无法登录**
###管理员
* id: 1
* pw: admin
###学生和教师
* id: 有很多
* pw: 123

##前端页面
开头引用
```
<include file="public/header.html" />
<include file="public/title.html" />
```
结尾引用
```
<include file="public/footer.html" />
```

##获得当前用户的id和type
* 全局函数 get_id()
* 全局函数 get_type()

********
#teaching-system

数据库：
teaching_system
用户名：root
密码：空
