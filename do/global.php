<?php
require(dirname(__FILE__)."/../f/global.php");

$IS_BIZ && Limt_IP('AllowVisitIp');		//������ЩIP����

unset($listdb,$rs);

//����JSʱ����ʾ��,����Ի���ͼƬ,'��Ҫ��\
$Load_Msg="<img alt=\"���ݼ�����,���Ժ�...\" src=\"$webdb[www_url]/images/default/ico_loading3.gif\">";


?>