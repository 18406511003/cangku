<?php //����MySql����
	$con = mysql_connect("localhost","root","305290744") or die("�������ӵ�Mysql Server");
	mysql_select_db("db_wms", $con) or die("���ݿ�ѡ��ʧ��");
	mysql_query("set names utf-8");
?>