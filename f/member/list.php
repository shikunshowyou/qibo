<?php
require_once("global.php");

@include(ROOT_PATH.'data/refurbish_id.php');

if(!$lfjid)
{
	showerr("�㻹û�е�¼");
}

/**
*��ѡ�е�ģ���Ժ�ɫ������ʾ
**/
$colordb[$mid]="red;";

$SQL=" WHERE uid='$lfjuid' ";

if($action=="del")
{
	$_erp=$Fid_db[tableid][$fid];
	
	$rsdb=$db->get_one("SELECT A.*,B.* FROM `{$_pre}content$_erp` A LEFT JOIN `{$_pre}content_{$Fid_db[mid][$fid]}` B ON A.id=B.id WHERE A.id='$id'");

	if($rsdb[uid]!=$lfjuid&&!$web_admin)
	{
		showerr("�������û�����ɾ����ϢȨ�ޣ�");
	}

	del_info($id,$_erp,$rsdb);
	//$db->query(" UPDATE `{$_pre}sort` SET contents=contents-1 WHERE fid='$rsdb[fid]' ");
	//$db->query(" UPDATE `{$_pre}sort` SET contents=contents-1 WHERE fid='$fidDB[fup]' ");

	if($rsdb[yz]){
		add_user($lfjdb[uid],-$webdb[PostInfoMoney]);
	}
	//refreshto($url,"ɾ���ɹ�");
	refreshto("$FROMURL","ɾ���ɹ�",1);
}

/**
*ÿҳ��ʾ40��
**/
$rows=15;

if(!$page)
{
	$page=1;
}
$min=($page-1)*$rows;

/*��ҳ����*/
$showpage=getpage("{$_pre}db","$SQL","?","$rows");

$webdb[UpdatePostTime]>0 || $webdb[UpdatePostTime]=1;

unset($listdb,$i);

$query = $db->query("SELECT * FROM {$_pre}db $SQL ORDER BY id DESC LIMIT $min,$rows");
while($rs = $db->fetch_array($query))
{
	$_erp=$Fid_db[tableid][$rs[fid]];
	$rs=$db->get_one("SELECT * FROM {$_pre}content$_erp WHERE id='$rs[id]'");
	
	if($Rdb[$rs[id]]){
		$rs[autoupdate]="<br><A title='���ȡ����ʱ�Զ�ˢ��' HREF='../job.php?job=autoupdate&type=del&fid=$rs[fid]&id=$rs[id]'>ȡ����ʱ</A>";
	}else{
		$rs[autoupdate]="<br><A HREF='#' onclick=\"set_refurbish('../job.php?job=autoupdate&fid=$rs[fid]&id=$rs[id]')\">��ʱˢ��</A>";
	}
	
	if($timestamp-$rs[posttime]<(3600*$webdb[UpdatePostTime])){
		$rs[update]='<A HREF="#" style="color:#ccc;" onclick="alert(\'�����ϴθ���ʱ��'.$webdb[UpdatePostTime].'Сʱ��,�ſ��Խ���ˢ��!\')">����ˢ��</A>';
	}else{
		$rs[update]="<A HREF=\"../job.php?job=update&fid=$rs[fid]&id=$rs[id]\">����ˢ��</A>";
	}
	if($rs['list']>$timestamp){
		$rs[dotop]='<A HREF="#" style="color:#ccc;" onclick="alert(\'�Ѿ��ö���\')">�ö�</A>';
	}else{
		$rs[dotop]="<A HREF='#' onclick=\"set_top('../job.php?job=dotop&fid=$rs[fid]&id=$rs[id]')\">�ö�</A>";
	}
	$rs[pop1]="<A HREF='#' onclick=\"set_buy('../job.php?job=popshow&type=1&fid=$rs[fid]&id=$rs[id]',1)\">��ҳ����</A>";	
	$rs[pop2]="<A HREF='#' onclick=\"set_buy('../job.php?job=popshow&type=2&fid=$rs[fid]&id=$rs[id]',2)\">���ཹ��</A>";
	$rs[pop3]="<A HREF='#' onclick=\"set_buy('../job.php?job=popshow&type=3&fid=$rs[fid]&id=$rs[id]',3)\">��Ŀ����</A>";
	$query2 = $db->query("SELECT * FROM `{$_pre}buyad` WHERE `id`='$rs[id]' AND `endtime`>'$timestamp'");
	while($rs2 = $db->fetch_array($query2)){
		if($rs2[sortid]==-1){
			$rs[pop1]='<A HREF="#" style="color:#ccc;" onclick="alert(\'�Ѿ���ҳ������ʾ��\')">��ҳ����</A>';
		}elseif($rs2[sortid]==$rs[fid]){
			$rs[pop3]='<A HREF="#" style="color:#ccc;" onclick="alert(\'�Ѿ���Ŀ������ʾ��\')">��Ŀ����</A>';
		}elseif($rs2[sortid]){
			$rs[pop2]='<A HREF="#" style="color:#ccc;" onclick="alert(\'�Ѿ����ཹ����ʾ��\')">���ཹ��</A>';
		}
	}
	$rs[posttime]=date("Y-m-d H:i:s",$rs[posttime]);

	$i++;
	$rs[cl]=$i%2==0?'t2':'t1';
	$rs[url]=get_info_url($rs[id],$rs[fid],$rs[city_id]);

	$listdb[]=$rs;
}
$lfjdb[money]=intval(get_money($lfjuid));

require(ROOT_PATH."member/head.php");
require(dirname(__FILE__)."/"."template/list.htm");
require(ROOT_PATH."member/foot.php");
?>