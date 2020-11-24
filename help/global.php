<?php
define('SYS_TYPE','news');
define('Mpath',dirname(__FILE__).'/');
define('Mdirname', preg_replace("/(.*)\/([^\/]+)/is","\\2",str_replace("\\","/",dirname(__FILE__))) );

require_once(Mpath."../inc/common.inc.php");
require_once(Mpath."data/config.php");			//��ϵͳȫ�ֱ���ֵ
require_once(Mpath."data/all_fid.php");			//������Ŀ�����Ʊ���ֵ
require_once(ROOT_PATH."data/label_hf.php");	//��ǩ��ͷ��׵ı���ֵ
require_once(Mpath."inc/function.php");

$_pre="{$pre}{$webdb[module_pre]}";					//���ݱ�ǰ׺
$Murl=$webdb[www_url].'/'.Mdirname;					//��ģ��ķ��ʵ�ַ
$Mdomain=$ModuleDB[$webdb[module_pre]][domain]?$ModuleDB[$webdb[module_pre]][domain]:$Murl;

//@include_once(Mpath."biz/function.php");



//ǰ̨�Ƿ񿪷ű�ϵͳ
if($webdb[module_close]){
	$webdb[Info_closeWhy]=str_replace("\r\n","<br>",$webdb[Info_closeWhy]);
	showerr("��ǰϵͳ��ʱ�ر�:$webdb[Info_closeWhy]");
}


$fid=intval($fid);
$id=intval($id);
$page=intval($page);
$rows=intval($rows);
$leng=intval($leng);






/**
*��ȡ��Ϣ����
**/
function list_content($SQL,$leng=40){
	global $db,$_pre,$webdb;
	$query=$db->query("SELECT A.*,B.* FROM {$_pre}content A LEFT JOIN {$_pre}content_1 B ON A.id=B.id $SQL");
	while( $rs=$db->fetch_array($query) ){
		$rs[content]=@preg_replace('/<([^>]*)>/is',"",$rs[content]);	//��HTML������˵�
		$rs[content]=get_word($rs[full_content]=$rs[content],100);
		$rs[title]=get_word($rs[full_title]=$rs[title],$leng);
		if($rs[titlecolor]||$rs[fonttype]){
			$titlecolor=$rs[titlecolor]?"color:$rs[titlecolor];":'';
			$font_weight=$rs[fonttype]==1?'font-weight:bold;':'';
			$rs[title]="<font style='$titlecolor$font_weight'>$rs[title]</font>";
		}
		$rs[posttime]=date("Y-m-d",$rs[full_time]=$rs[posttime]);
		if($rs[picurl]){
			$rs[picurl]=tempdir($rs[picurl]);
		}
		$listdb[]=$rs;
	}
	return $listdb;
}


/**
*��ȡ����Ŀ
**/
function Get_Fid($fid,$rows=100){
	global $db,$_pre;
	$fid=intval($fid);
	$query = $db->query("SELECT * FROM {$_pre}sort WHERE fup=$fid ORDER BY list DESC LIMIT $rows");
	while($rs = $db->fetch_array($query)){
		$F[$rs[fid]]=$rs;
	}
	return $F;
}

function GetSonFid($fid,$rows=100){
	global $db,$_pre;
	$fid=intval($fid);
	$query = $db->query("SELECT * FROM {$_pre}sort WHERE fup=$fid ORDER BY list DESC LIMIT $rows");
	while($rs = $db->fetch_array($query)){
		$F[$rs[fid]]=$rs[fid];
	}
	return $F;
}

function GetAllSonFid($fid,$rows=100){
	global $db,$_pre;
	$fid=intval($fid);
	$query = $db->query("SELECT fid,fup FROM {$_pre}sort WHERE fup=$fid ORDER BY list DESC LIMIT $rows");
	while($rs = $db->fetch_array($query)){
		$show.=",$rs[fid]";
		$show.=GetAllSonFid($rs[fid],$rows);
	}
	return $show;
}


/**
*��ȡ��Ϣ����
**/
function Get_Info($type,$rows=5,$leng=20,$fid=0,$cityid=0){
	$SQL=" WHERE A.yz=1 ";
	if($cityid){
		$SQL.=" AND (A.city_id='$cityid' OR A.city_id='0') ";
	}
	if($fid){
		$SQL.=" AND A.fid IN ($fid".GetAllSonFid($fid).") ";
	}
	if($type=='hot'){
		$SQL.=" ORDER BY A.hits DESC LIMIT $rows";
	}elseif($type=='lastview'){
		$SQL.=" ORDER BY A.lastview DESC LIMIT $rows";
	}elseif($type=='comment'){
		$SQL.=" ORDER BY A.comments DESC LIMIT $rows";
	}elseif($type=='new'){
		$SQL.=" ORDER BY A.list DESC LIMIT $rows";
	}elseif($type=='level'){
		$SQL.=" AND A.yz=1 AND A.levels=1 ORDER BY A.list DESC LIMIT $rows";
	}elseif($type=='pic'){
		$SQL.=" AND A.ispic=1 ORDER BY A.list DESC LIMIT $rows";
	}else{
		return ;
	}
	$listdb=list_content($SQL,$leng);
	return $listdb;
}


/**
*�����Ŀ��ȡ������Ϣ�б�
**/
function ListThisSort($rows,$leng){
	global $page,$fid,$fidDB,$SQL;
	if($page<1){
		$page=1;
	}
	if($fidDB[listorder]==1){
		$sql_list="A.posttime";
		$sql_order="DESC";
	}elseif($fidDB[listorder]==2){
		$sql_list="A.posttime";
		$sql_order="ASC";
	}elseif($fidDB[listorder]==3){
		$sql_list="A.hits";
		$sql_order="DESC";
	}elseif($fidDB[listorder]==4){
		$sql_list="A.hits";
		$sql_order="ASC";
	}elseif($fidDB[listorder]==5){
		$sql_list="A.lastview";
		$sql_order="DESC";
	}else{
		$sql_list="A.list";
		$sql_order="DESC";
	}
	$min=($page-1)*$rows;
	$_SQL="WHERE A.fid=$fid AND A.yz=1 $SQL ORDER BY $sql_list $sql_order LIMIT $min,$rows";
	$listdb=list_content($_SQL,$leng);
	return $listdb;
}


/**
*��Է����ȡ����Ŀ
**/
function ListOnlySort($rows){
	global $db,$_pre,$fid,$page,$Fid_db,$fidDB,$webdb;

	$_SonOrder='A.id';

	//����
	if($fidDB[config][sonListorder]==1){
		$_SonOrder='A.id';		//��Ӧ��list
	}elseif($fidDB[config][sonListorder]==2){
		$_SonOrder='A.hits';
	}elseif($fidDB[config][sonListorder]==3){
		$_SonOrder='A.lastview';
	}elseif($fidDB[config][sonListorder]==4){
		$_SonOrder='rand()';
	}else{
		$_SonOrder='A.id';
	}

	//��ʾ����
	if($fidDB[config][sonTitleRow]>0){
		$_SonRow=$fidDB[config][sonTitleRow];
	}elseif($webdb[InfoListSonRows]>0){
		$_SonRow=$webdb[InfoListSonRows];
	}else{
		$_SonRow=10;
	}

	//ÿ��������ʾ������
	if($fidDB[config][sonTitleLeng]>0){
		$_SonLeng=$fidDB[config][sonTitleLeng];
	}elseif($webdb[InfoListSonLeng]>0){
		$_SonLeng=$webdb[InfoListSonLeng];
	}else{
		$_SonLeng=30;
	}

	if(!$page){
		$page=1;
	}
	$min=($page-1)*$rows;
	$query=$db->query("SELECT * FROM {$_pre}sort WHERE fup=$fid AND forbidshow=0 ORDER BY list DESC LIMIT $min,$rows");
	while($rs=$db->fetch_array($query))
	{
		$rs[article]=$_SQL=$fiddb='';
		if($rs[type]){
			foreach( $Fid_db[$rs[fid]] AS $key=>$value){
				$fiddb[]=$key;
				foreach( $Fid_db[$key] AS $key2=>$value2){
					$fiddb[]=$key2;
				}
			}
			if($fiddb){
				$fids=implode(",",$fiddb);
				$_SQL="WHERE A.fid IN ($fids) AND A.yz=1 ORDER BY $_SonOrder DESC LIMIT $_SonRow";
			}
		}else{
			$_SQL="WHERE A.fid=$rs[fid] AND A.yz=1 ORDER BY $_SonOrder DESC LIMIT $_SonRow";
		}
		if($_SQL){
			$rs[article]=list_content($_SQL,$_SonLeng);
		}
		$rs[logo] && $rs[logo]=tempdir($rs[logo]);
		$listdb[]=$rs;
	}
	return $listdb;
}


?>