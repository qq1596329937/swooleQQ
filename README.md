# swooleQQ
极简 仿qq聊天系统 （PHP + swoole+mysql）
# 目录说明
  home---前台文件夹  
     ----index.php----客户端访问入口文件  
  Chat.php--- swoole服务类  
  Db.php------连接mysql 数据库类     
  swoole.sql--sql文件
# 使用说明
   1. 环境准备  
       PHP >= 7.2
       swoole >= 4.4.4
       mysql >= 5.6
   2. 执行sql文件，并在 Db.php中修改数据库连接信息  
   3. 服务端中进入项目 目录 执行 php  Chat.php  
   4. 客户端使用浏览器访问home 下的index.php 文件
