<?php
require_once("global.php");

@include(ROOT_PATH.'data/refurbish_id.php');

if(!$lfjid){
	showerr("�㻹û�е�¼");
}

$SQL=" WHERE A.uid='$lfjuid' ";




$rows=15;
if(!$page){
	$page=1;
}
$min=($page-1)*$rows;

$showpage=getpage("{$_pre}refurbish A","$SQL","?","$rows");


unset($listdb,$i);

$query = $db->query("SELECT A.*,B.* FROM {$_pre}refurbish A LEFT JOIN {$_pre}db B ON A.id=B.id $SQL ORDER BY A.id DESC LIMIT $min,$rows");
while($rs = $db->fetch_array($query))
{
	if(!$rs[fid]){	//��Ϣ��ɾ��������ҲҪ��Ӧ��ɾ����
		$db->query("DELETE FROM {$_pre}refurbish WHERE id='$rs[id]'");
		continue;
	}
	$times = $rs['times'];
	$_erp=$Fid_db[tableid][$rs[fid]];
	$rs=$db->get_one("SELECT * FROM {$_pre}content$_erp WHERE id='$rs[id]'");

	$rs['times'] = substr($times,0,2).':'.substr($times,2,2);
	
	$rs[posttime]=date("Y-m-d H:i:s",$rs[posttime]);

	$i++;
	$rs[cl]=$i%2==0?'t2':'t1';
	$rs[url]=get_info_url($rs[id],$rs[fid],$rs[city_id]);

	$listdb[]=$rs;
}
//$lfjdb[money]=intval(get_money($lfjuid));

require(ROOT_PATH.'member/head.php');
require(dirname(__FILE__).'/template/refurbish.htm');
require(ROOT_PATH.'member/foot.php');
?>