<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `qb_help_content_1`;");
E_C("CREATE TABLE `qb_help_content_1` (
  `rid` mediumint(7) NOT NULL AUTO_INCREMENT,
  `subhead` varchar(150) NOT NULL DEFAULT '',
  `id` mediumint(7) NOT NULL DEFAULT '0',
  `fid` mediumint(7) NOT NULL DEFAULT '0',
  `uid` mediumint(7) NOT NULL DEFAULT '0',
  `topic` tinyint(1) NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  `orderid` mediumint(7) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `aid` (`id`,`topic`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=gbk");
E_D("replace into `qb_help_content_1` values('1','','1','3','1','1','<p>���ֻҪ��������ַ</p><p>http://www_qibosoft_com/do/job.php?job=propagandize&amp;uid=1<br /></p><p>ת������ĺ���,�����Ǹ�����̳,ֻҪ���˷�����,��Ϳ��Ի�ȡ2�����ֵĽ���</p><p><br /></p><p>����û��ɹ�ע��Ļ�,��������õ�5�����ֵĽ���</p><p><br /></p><p>���ɹ�ע����û����Ƽ������û��Ļ�,���������Եõ�����,��ͬʱҲ��õ�����,��Ϊ���Ƕ��������������.</p>','0');");
E_D("replace into `qb_help_content_1` values('2','','2','7','1','1','<p>������ʾ,һ������,���ദ��,���ύ���IP��Դ��Ϣ���������ص���ز��Ŵ���.</p>','0');");
E_D("replace into `qb_help_content_1` values('3','','3','2','1','1','<p>����б�Ҫ�Ļ�,��ӭ�������ΪVIP��Ա,Ȩ�޸���!!</p>','0');");

require("../../inc/footer.php");
?>