<?php
//��������

if(!$webdb[vipselfdomain]){
	showerr("ϵͳû�����ö�����������");
}

if(!$step){

 


}else{
	if(!$web_admin&&!$groupdb['use2domain']){
		showerr('����Ȩʹ��');
	}
	$host=trim($host);
	//���
	if(!preg_match("/^[a-z\d]{2,15}$/",$host))showerr("��������ֻ��ʹ��ĸ�������֣�������2-15���ַ�֮��,��ȫ��Сд");
	$limitmain=explode("\r\n",$webdb[vipselfdomaincannot]);
	if(in_array($host,$limitmain)) showerr("�˶�������Ϊϵͳ��������������ʹ�ã��뻻һ������");

	$rt=$db->get_one("SELECT COUNT(*) AS num FROM {$_pre}company WHERE host='{$host}.$webdb[vipselfdomain]' AND  uid!='$uid'");
	if($rt[num]>0) showerr("[ $host ]�Ѿ�������ʹ���ˣ��뻻һ������");
	//����
	$db->query("UPDATE {$_pre}company SET `host`='{$host}.$webdb[vipselfdomain]' WHERE uid='$uid' ");
	refreshto("?uid=$uid&atn=$atn","���óɹ�");
}

if($companydb['host']){
	$companydb['host'] = preg_replace("/([^\.]+)\.(.*)/is","\\1",$companydb['host']);
}
?>