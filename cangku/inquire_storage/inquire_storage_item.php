<?php
//Ȩ����֤����
include("../const.php");
if ($authority[12]==0){  
	echo "<script language='javascript'>alert('�Բ�����û�д˲���Ȩ�ޣ�');history.back();</script>";
	exit;
}
//Ȩ����֤����

	include "../basic/include.php";
	include "../basic/database.php";
	
	$itemid = $_GET[itemid];		
	$flag = '';
	if($itemid=='')
		$flag = 'none';
	
	if($flag == ''){//��ȡ�ֿ���Ϣ
		$query = "select * from table_warehouse order by id";//echo $query."<br>";
		$result_warehouse = mysql_query($query);
	}

	if($flag == ''){//��ȡ��Ʒ��Ϣ
		$query = "select * from tb_product where encode = '$itemid'";//echo $query."<br>";
		$result_iteminfo = mysql_query($query);	
	}

?>

<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>����ѯ-��Ʒ</title>
</head>
<style>
</style>
<script type="text/javascript" src="../js/Calendar3.js"></script>
<script language="javascript">
function selectitem(){//ѡ�����
	//var url = 'item_choose.php';
	var url = '../product/showproduct.php?stype=1&mtype=1';
	window.open(url,'_blank','directorys=no,toolbar=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=853,height=470,top=176,left=161');
}
</script>
<link rel="stylesheet" type="text/css" href="../css/iframe.css" media="screen" />
<body style="width:800px">
<form id="form" name="form" method="post" >
  <h3>����ѯ-��Ʒ</h3>
  <fieldset>
  <legend>��Ʒ��Ϣ</legend>
  <label>��ѯ��Ʒ</label>
  <input id="item_id" name="item_id" type="text"  style="background-color:#CCCCCC" <?php echo "value = '$itemid'";?>  onclick="selectitem()"/>
  <button type="button" onclick="location.href='inquire_storage_item.php?itemid='+document.getElementById('item_id').value">&nbsp;��ѯ&nbsp;</button>
  <input id="item_name" name="item_name" type="text" size="5" style="background-color:#CCCCCC;display:none" hidden />
  <input id="item_model" name="item_model" type="text" size="5" style="background-color:#CCCCCC;display:none" hidden />
  <input id="item_unit" name="item_unit" type="text" size="5" style="background-color:#CCCCCC;display:none" hidden />
  </fieldset>
  <fieldset>
  <legend>��Ʒ��Ϣ</legend>
  <table id="iteminfo" width="500" border="1" cellspacing="0" cellpadding="5" style="font-size:12px; border:thin; border-color:#9999FF ">
    <tr align="center">
      <td>��Ʒ���</td>
      <td>��Ʒ����</td>
      <td>����ͺ�</td>
      <td>��λ</td>
      <td>�������</td>
      <td>�������</td>
    </tr>
    <?php //��ʾ��Ʒ��Ϣ
		echo "<tr align='center'>";
		
		if($flag == 'none')
			echo "<td>��ָ����ѯ�Ļ�ƷID</td>";
		else{
			$RS = mysql_fetch_array($result_iteminfo);	
			if(empty($RS))
				echo "<td>�û�Ʒ���벻����</td>";
			else{
				echo "<td>$RS[encode]</td>";
				echo "<td>$RS[name]</td>";
				echo "<td>$RS[size]</td>";
				echo "<td>$RS[unit]</td>";
				echo "<td id='upperlimit'>$RS[upperlimit]</td>";
				echo "<td id='lowerlimit'>$RS[lowerlimit]</td>";
			}
		}
		
		echo "</tr>";
	?>
  </table>
  </fieldset>
  <fieldset>
  <legend>����б�</legend>
  <table id="storage_table" width="500" border="1" cellspacing="0" cellpadding="5" style="font-size:12px; border:thin; border-color:#9999FF ">
    <tr align="center">
      <td>�ֿ���</td>
      <td>�ֿ�����</td>
      <td>�������</td>
    </tr>
    <?php //��ʾ����Ʒ�Ŀ����Ϣ
		
		if($flag == ''){//��ѯ�ֿ��иû�Ʒ�Ŀ��
			$sum = 0;
			while($RS = mysql_fetch_array($result_warehouse)){
				echo "<tr align='center'>";
				echo "<td>$RS[id]</td>";
				echo "<td>$RS[name]</td>";
				$query = "select * from table_warehouse_$RS[id] where id = '$itemid'";//echo $query."<br>";
				$result_storage = mysql_query($query);
				$RS2 = mysql_fetch_array($result_storage);
				if(empty($RS2))
					echo "<td>0</td>";
				else
					echo "<td>$RS2[num]</td>";
				echo "</tr>";
				
				$sum += $RS2[num];
			}
		}
		echo "<tr><td></td><td align='center'>�ܼƣ�</td><td align='center' id='storage'>$sum</td></tr>";
		
	?>
  </table>
  </fieldset>
  <fieldset>
  <legend>ͼ��</legend>
  <img src="showbar.php?itemid=<?php echo $itemid;?>" width="600" height="300" border="0" align="bottom">
  </fieldset>
</form>
<?php
if($flag == ''){
	if(!empty($RS)){
		echo "";
	}
}
?>
<script language="javascript">
var upperlimit = Number(document.getElementById('upperlimit').innerHTML);
var lowerlimit = Number(document.getElementById('lowerlimit').innerHTML);
var storage = Number(document.getElementById('storage').innerHTML);
if(storage > upperlimit)
	alert("��泬������");
else if(storage < lowerlimit)
	alert("����������");
else
	alert("�������");
</script>
<p><a href="/wms/inquire_storage/inquire_storage_allitem.php">���ؿ���ѯ</a></p>
</body>
</html>