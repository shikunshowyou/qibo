<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `qb_admin_menu`;");
E_C("CREATE TABLE `qb_admin_menu` (
  `id` mediumint(5) NOT NULL AUTO_INCREMENT,
  `fid` mediumint(5) NOT NULL DEFAULT '0',
  `name` text NOT NULL,
  `linkurl` varchar(150) NOT NULL DEFAULT '',
  `color` varchar(15) NOT NULL DEFAULT '',
  `target` tinyint(1) NOT NULL DEFAULT '0',
  `list` smallint(4) NOT NULL DEFAULT '0',
  `groupid` mediumint(5) NOT NULL DEFAULT '0',
  `iftier` tinyint(1) NOT NULL DEFAULT '0',
  `ifcompany` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `groupid` (`groupid`)
) ENGINE=MyISAM AUTO_INCREMENT=154 DEFAULT CHARSET=gbk");
E_D("replace into `qb_admin_menu` values('87','0','��Ҫ����','','','0','7','3','0','0');");
E_D("replace into `qb_admin_menu` values('90','87','��ҳ���಼������','index.php?lfj=module_admin&dirname=f&file=center&job=settable','','0','0','3','0','0');");
E_D("replace into `qb_admin_menu` values('144','0','��������','','','0','8','3','0','0');");
E_D("replace into `qb_admin_menu` values('145','144','ȫ�ֲ�������','index.php?lfj=center&job=config','','0','0','3','0','0');");
E_D("replace into `qb_admin_menu` values('146','144','������ز���','index.php?lfj=module_admin&dirname=f&file=center&job=post','','0','0','3','0','0');");
E_D("replace into `qb_admin_menu` values('147','87','������ҳ��ǩ','index.php?lfj=module_admin&dirname=f&file=center&job=label','','0','10','3','0','0');");
E_D("replace into `qb_admin_menu` values('148','87','������Ϣ����','index.php?lfj=module_admin&dirname=f&file=list&job=list','','0','0','3','0','0');");
E_D("replace into `qb_admin_menu` values('149','87','���۹���','index.php?lfj=module_admin&dirname=f&file=comment&job=list','','0','0','3','0','0');");
E_D("replace into `qb_admin_menu` values('150','87','������Ŀ����','index.php?lfj=module_admin&dirname=f&file=sort&job=listsort','','0','0','3','0','0');");
E_D("replace into `qb_admin_menu` values('151','87','���е�������','index.php?lfj=module_admin&dirname=f&file=city&job=city','','0','0','3','0','0');");
E_D("replace into `qb_admin_menu` values('152','87','�������ӹ���','index.php?lfj=module_admin&dirname=f&file=friendlink&job=list','','0','0','3','0','0');");

require("../../inc/footer.php");
?>