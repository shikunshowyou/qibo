<?php
define('Memberpath',dirname(__FILE__).'/');
require(Memberpath."../f/global.php");



if(!$webdb[web_open])
{
	$webdb[close_why] = str_replace("\n","<br>",$webdb[close_why]);
	showerr("��վ��ʱ�ر�:$webdb[close_why]");
}


if(!$lfjid){
	showerr("�㻹û��¼");
}elseif($_GET['admin_city']){
	if(!$city_DB[name][$_GET['admin_city']]){
		showerr('��ǰ���в�����');
	}
	setcookie('admin_cityid',$_GET['admin_city'],time()+3600,"/");
	$_COOKIE['admin_cityid']=$_GET['admin_city'];
}
elseif(!$_COOKIE['admin_cityid']){
	if(count($city_DB[name])<2){
		showerr('�����а�û�г��й�����!');
	}
	$show='';
	foreach( $city_DB[name] AS $key=>$value){
		$show.="<option value='$key'>$value</option>";
	}
	foreach( $city_DB[name] AS $key=>$value){
	}
	showerr("<select name='select' onChange=\"window.location.href='?admin_city='+this.options[this.selectedIndex].value\"><option value=''>��ѡ��һ����Ҫ����ĳ���</option>$show</select>");
}
if($city_id=$_COOKIE['admin_cityid']){
	$cityDB=$db->get_one("SELECT * FROM {$pre}fenlei_city WHERE fid='$city_id'");
	$detail=explode(',',$cityDB[admin]);
	if(!$web_admin&&!in_array($lfjid,$detail)){
		setcookie('admin_cityid','');
		showerr("<A HREF='?'>�㲻�Ǳ����еĹ���Ա,�������ѡ�����!</A>");
	}
}

$id=intval($id);
$aid=intval($aid);
$tid=intval($tid);


?>