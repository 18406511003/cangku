<?php
     $conn=mysql_connect("localhost","root","305290744") or die("���ݿ���������Ӵ���".mysql_error());
     mysql_select_db("db_wms",$conn) or die("���ݿ���ʴ���".mysql_error());
 	 mysql_query("set character set utf-8");
     mysql_query("set names utf-8");
?>
