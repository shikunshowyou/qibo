<?php
require("global.php");

if(!$lfjid){
	showerr("�㻹û��¼");
}

$lfjdb[money]=get_money($lfjuid);

if($job=="buy"||$action=='buy'){
	$rsdb=$db->get_one("SELECT * FROM {$pre}group WHERE gid='$gid'");
	if(!$rsdb){
		showerr("��������");
	}	
}

if($action=='buy')
{
	$buyday = intval($buyday);
	$webdb[groupTime]>0 || $webdb[groupTime]=1;
	if($buyday<$webdb[groupTime]){
		showerr("�㹺�����������С�� {$webdb[groupTime]} ��");
	}
	$total_money = ceil(abs($rsdb[levelnum]*$buyday));
	if($lfjdb[money]<$total_money){
		showerr("���{$webdb[MoneyName]}���� {$total_money} {$webdb[MoneyDW]}");
	}
	if($rsdb[gptype] || !$memberlevel[$gid]){
		showerr("ϵͳ����,�㲻�ܹ���!");
	}
	if($lfjdb[groupid]==3||$lfjdb[groupid]==4){
		showerr("���ǹ���Ա,�����Թ������͵ļ���");
	}

	if($lfjdb[C][endtime]>$timestamp){ //�ظ�����,ʱ���ۼ�
		
		$remnant_time = $lfjdb[C][endtime]-$timestamp;
		$remnant_time = floor($remnant_time*intval($memberlevel[$lfjdb[groupid]])/$memberlevel[$gid]);
		$lfjdb[C][endtime] = $timestamp + $remnant_time + $buyday*86400;
	
	}else{
		$lfjdb[C][endtime] = $timestamp+$buyday*86400;
	}
	
	
	$config=addslashes(serialize($lfjdb[C]));
	$db->query("UPDATE {$pre}memberdata SET config='$config',groupid='$gid' WHERE uid='$lfjuid'");
	add_user($lfjuid,-$total_money,'�����Ա����۷�');
	refreshto("$FROMURL","��ϲ��,�����ɹ�",1);
}

 
$query = $db->query("SELECT * FROM {$pre}group WHERE gptype=0");
while($rs = $db->fetch_array($query)){
	$rs[g]=@include_once(ROOT_PATH."data/group/$rs[gid].php");
	$listdb[]=$rs;
}

if($lfjdb[C][endtime]&&$lfjdb[groupid]!=8){
	$lfjdb[C][endtime]=date("��ֹ����Ϊ: Y-m-d H:i ��",$lfjdb[C][endtime]);
}else{
	$lfjdb[C][endtime]='';
}

require(dirname(__FILE__)."/"."head.php");
require(dirname(__FILE__)."/"."template/buygroup.htm");
require(dirname(__FILE__)."/"."foot.php");

?>