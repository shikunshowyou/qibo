<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `qb_hack`;");
E_C("CREATE TABLE `qb_hack` (
  `keywords` varchar(30) NOT NULL DEFAULT '',
  `name` varchar(30) NOT NULL DEFAULT '',
  `isclose` tinyint(1) NOT NULL DEFAULT '0',
  `author` varchar(30) NOT NULL DEFAULT '',
  `config` text NOT NULL,
  `htmlcode` text NOT NULL,
  `hackfile` text NOT NULL,
  `hacksqltable` text NOT NULL,
  `adminurl` varchar(150) NOT NULL DEFAULT '',
  `about` text NOT NULL,
  `class1` varchar(30) NOT NULL DEFAULT '',
  `class2` varchar(30) NOT NULL DEFAULT '',
  `list` int(10) NOT NULL DEFAULT '0',
  `linkname` text NOT NULL,
  `isbiz` tinyint(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `keywords` (`keywords`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");
E_D("replace into `qb_hack` values('login','�û���¼���','0','','a:3:{s:10:\"systemType\";s:6:\"php168\";s:9:\"guestcode\";s:0:\"\";}','','','','index.php?lfj=hack&hack=login&job=list','','','','0','','0');");
E_D("replace into `qb_hack` values('moneylog','�û����ѻ��ּ�¼','0','','','','','','index.php?lfj=moneylog&job=list','','other','�����ȫ','0','','0');");
E_D("replace into `qb_hack` values('alipay_set','���߳�ֵ֧������','0','','','','','','index.php?lfj=alipay&job=list','','other','�����������','9','','0');");
E_D("replace into `qb_hack` values('js_list','JS���ݵ���','0','','','','','','index.php?lfj=js&job=list','','other','��������','9','','0');");
E_D("replace into `qb_hack` values('propagandize','�ƹ�׬ȡ���ֹ���','0','','','','','','index.php?lfj=propagandize&job=list','','other','��������','8','','0');");
E_D("replace into `qb_hack` values('jfadmin_mod','���ֽ��ܹ���','0','','','','','','index.php?lfj=jfadmin&job=listjf','','other','��������','7','','0');");
E_D("replace into `qb_hack` values('attachment_list','��������','0','','','','','','index.php?lfj=attachment&job=list','','other','��������','6','','0');");
E_D("replace into `qb_hack` values('area_list','��������','0','','','','','','index.php?lfj=area&job=list','','other','��������','5','','0');");
E_D("replace into `qb_hack` values('upgrade_ol','ϵͳ��������','0','','','','','','index.php?lfj=upgrade&job=get','','other','��������','4','','0');");
E_D("replace into `qb_hack` values('mail_send','�ʼ�Ⱥ��','0','','','','','','index.php?lfj=mail&job=send','','other','��Ϣ/�ʼ�Ⱥ��','2','','0');");
E_D("replace into `qb_hack` values('message_send','վ����ϢȺ��','0','','','','','','index.php?lfj=message&job=send','','other','��Ϣ/�ʼ�Ⱥ��','3','','0');");
E_D("replace into `qb_hack` values('sms_send','�ֻ�����Ⱥ��','0','','','','','','index.php?lfj=sms&job=send','','other','��Ϣ/�ʼ�Ⱥ��','1','','0');");
E_D("replace into `qb_hack` values('cnzz_set','CNZZ����ͳ��','0','','','','','','index.php?lfj=cnzz&job=ask','','other','վ�⹦��','3','','0');");
E_D("replace into `qb_hack` values('moneycard_make','�㿨��ֵ����','0','','','','','','index.php?lfj=moneycard&job=make','','other','�����������','7','','1');");
E_D("replace into `qb_hack` values('logs_login_logs','��̨��¼��־','0','','','','','','index.php?lfj=logs&job=login_logs','','other','��־����','2','','0');");
E_D("replace into `qb_hack` values('logs_admin_do_logs','��̨������־','0','','','','','','index.php?lfj=logs&job=admin_logs','','other','��־����','1','','0');");
E_D("replace into `qb_hack` values('crontab','��ʱ����','0','','','','','','index.php?lfj=crontab&job=list','','other','�����ȫ','0','','0');");

require("../../inc/footer.php");
?>