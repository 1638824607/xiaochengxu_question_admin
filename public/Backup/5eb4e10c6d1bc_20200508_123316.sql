-- -----------------------------
-- SDCMS MySQL Data Transfer 
-- 
-- Date:2020-05-08 12:33:16
-- -----------------------------

SET FOREIGN_KEY_CHECKS = 0;


-- -----------------------------
-- Table structure for `tp_config`
-- -----------------------------
DROP TABLE IF EXISTS `tp_config`;
CREATE TABLE `tp_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '基本信息配置表',
  `typeid` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '类型',
  `varname` varchar(20) NOT NULL DEFAULT '' COMMENT '字段名',
  `varinfo` varchar(100) NOT NULL DEFAULT '' COMMENT '参数说明',
  `varvalue` text COMMENT '参数值',
  `vartype` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0=单行文本框,1=多行文本框,2=图片上传框,3=下拉框',
  `varoption` varchar(250) NOT NULL DEFAULT '' COMMENT '选项值',
  PRIMARY KEY (`id`,`typeid`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;


-- -----------------------------
-- Table structure for `tp_forms`
-- -----------------------------
DROP TABLE IF EXISTS `tp_forms`;
CREATE TABLE `tp_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表单',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `tablename` varchar(50) NOT NULL DEFAULT '' COMMENT '表名',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否成功状态',
  `sendtime` varchar(10) NOT NULL DEFAULT '' COMMENT '登录时间',
  PRIMARY KEY (`id`),
  KEY `forms` (`sendtime`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;


-- -----------------------------
-- Table structure for `tp_logs`
-- -----------------------------
DROP TABLE IF EXISTS `tp_logs`;
CREATE TABLE `tp_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '后台操作日志表',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '操作用户',
  `content` varchar(100) NOT NULL DEFAULT '' COMMENT '操作内容',
  `ip` varchar(15) NOT NULL DEFAULT '' COMMENT 'ip地址',
  `sendtime` varchar(10) NOT NULL DEFAULT '' COMMENT '操作时间',
  PRIMARY KEY (`id`),
  KEY `logs` (`username`,`sendtime`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;


-- -----------------------------
-- Table structure for `tp_manager`
-- -----------------------------
DROP TABLE IF EXISTS `tp_manager`;
CREATE TABLE `tp_manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员表',
  `role_id` varchar(20) NOT NULL DEFAULT '' COMMENT '角色ID',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '密码',
  `realname` varchar(20) NOT NULL DEFAULT '' COMMENT '姓名',
  `login_num` int(11) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `sendtime` varchar(10) NOT NULL DEFAULT '' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `manager` (`role_id`,`username`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


-- -----------------------------
-- Table structure for `tp_model`
-- -----------------------------
DROP TABLE IF EXISTS `tp_model`;
CREATE TABLE `tp_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '模块分类表',
  `model_name` varchar(50) NOT NULL DEFAULT '' COMMENT '模块名称',
  `model_fields` varchar(250) NOT NULL DEFAULT '' COMMENT '模块字段',
  `model_c` varchar(100) NOT NULL DEFAULT '' COMMENT '控制器',
  `model_a` varchar(100) NOT NULL DEFAULT '' COMMENT '方法',
  `ispic` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否包含pic',
  `disorder` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '模块状态',
  PRIMARY KEY (`id`),
  KEY `module` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;


-- -----------------------------
-- Table structure for `tp_news`
-- -----------------------------
DROP TABLE IF EXISTS `tp_news`;
CREATE TABLE `tp_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '资讯类表',
  `fid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '栏目一级分类id',
  `ty` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '栏目二级分类id',
  `tty` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '栏目三级分类',
  `ttty` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '栏目四级分类',
  `title` varchar(250) NOT NULL DEFAULT '' COMMENT '标题',
  `tags` varchar(250) NOT NULL DEFAULT '',
  `linkurl` varchar(250) NOT NULL DEFAULT '' COMMENT '跳链接',
  `introduce` text COMMENT '摘要',
  `content` text COMMENT '内容',
  `img1` varchar(100) NOT NULL DEFAULT '' COMMENT '图片1',
  `img2` varchar(100) NOT NULL DEFAULT '' COMMENT '图片2',
  `img3` varchar(100) NOT NULL DEFAULT '',
  `img4` varchar(100) NOT NULL DEFAULT '',
  `img5` varchar(100) NOT NULL DEFAULT '',
  `img6` varchar(100) NOT NULL DEFAULT '',
  `file1` varchar(100) NOT NULL DEFAULT '' COMMENT '附件1',
  `price` varchar(50) NOT NULL DEFAULT '' COMMENT '价格',
  `source` varchar(50) NOT NULL DEFAULT '' COMMENT '来源',
  `author` varchar(50) NOT NULL DEFAULT '' COMMENT '作者',
  `seotitle` varchar(200) NOT NULL DEFAULT '' COMMENT 'seo标题',
  `seokeywords` text COMMENT '关键字',
  `seodescription` text COMMENT '描述',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '点击数',
  `isgood` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `istop` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否置顶',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否显示',
  `disorder` mediumint(9) NOT NULL DEFAULT '0' COMMENT '排序',
  `sendtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `news` (`pid`,`ty`,`title`,`isgood`,`istop`,`status`,`disorder`,`sendtime`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;


-- -----------------------------
-- Table structure for `tp_role`
-- -----------------------------
DROP TABLE IF EXISTS `tp_role`;
CREATE TABLE `tp_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '角色表',
  `role_name` varchar(20) NOT NULL DEFAULT '' COMMENT '角色名称',
  `role_auth_ids` varchar(128) NOT NULL DEFAULT '' COMMENT '权限ids 1,2,5',
  `role_auth_ac` varchar(3000) DEFAULT '' COMMENT '模块-操作',
  `sendtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '审核状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


-- -----------------------------
-- Table structure for `tp_sort`
-- -----------------------------
DROP TABLE IF EXISTS `tp_sort`;
CREATE TABLE `tp_sort` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '栏目分类表',
  `model_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '模块id',
  `pid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '一级Id',
  `catname` varchar(50) NOT NULL DEFAULT '' COMMENT '分类名称',
  `encatname` varchar(50) NOT NULL DEFAULT '' COMMENT '英文分类名称',
  `img1` varchar(150) NOT NULL DEFAULT '' COMMENT '配置图片1',
  `img2` varchar(150) NOT NULL DEFAULT '' COMMENT '配置图片2',
  `img3` varchar(150) NOT NULL DEFAULT '',
  `titleimgsize` varchar(150) NOT NULL COMMENT '多图上传尺寸',
  `imgsize` varchar(250) NOT NULL DEFAULT '' COMMENT '图片尺寸',
  `imgname` varchar(250) NOT NULL DEFAULT '' COMMENT '图片名称',
  `imgnum` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '图片数量',
  `pagesize` tinyint(3) unsigned NOT NULL DEFAULT '3' COMMENT '分页数',
  `seotitle` varchar(200) NOT NULL DEFAULT '' COMMENT 'seo标题',
  `seokeywords` text COMMENT '关键字',
  `seodescription` text COMMENT '描述',
  `inlinkurl` varchar(30) NOT NULL DEFAULT '' COMMENT '内部链接',
  `outlinkurl` varchar(30) NOT NULL DEFAULT '' COMMENT '外部链接',
  `templet` varchar(50) NOT NULL DEFAULT '' COMMENT '模板名称',
  `sort_c` varchar(100) NOT NULL DEFAULT '' COMMENT '控制器',
  `sort_a` varchar(100) NOT NULL DEFAULT '' COMMENT '方法',
  `sort_url` varchar(100) NOT NULL DEFAULT '' COMMENT '内部自定义链接',
  `isgood` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `isopen` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许分类',
  `isdel` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '分类状态',
  `disorder` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `sendtime` varchar(10) NOT NULL DEFAULT '' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `sort` (`pid`,`catname`,`isopen`,`isdel`,`status`,`sendtime`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;


-- -----------------------------
-- Table structure for `tp_titlepic`
-- -----------------------------
DROP TABLE IF EXISTS `tp_titlepic`;
CREATE TABLE `tp_titlepic` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '会员照片表',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '专辑分类id',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `remark` varchar(300) NOT NULL,
  `img1` varchar(150) NOT NULL DEFAULT '' COMMENT '配置图片',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `sendtime` varchar(10) NOT NULL DEFAULT '' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `photo` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


-- -----------------------------
-- Table structure for `tp_yzm`
-- -----------------------------
DROP TABLE IF EXISTS `tp_yzm`;
CREATE TABLE `tp_yzm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` tinyint(1) NOT NULL DEFAULT '1',
  `username` varchar(50) NOT NULL DEFAULT '',
  `yzm` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `sendtime` varchar(10) NOT NULL DEFAULT '' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `tp_config`
-- -----------------------------
INSERT INTO `tp_config` VALUES ('1','1','sys_isopen','开启关闭','开启','3','开启|关闭');
INSERT INTO `tp_config` VALUES ('2','1','sys_sitename','站点名称','中百科电气','0','');
INSERT INTO `tp_config` VALUES ('3','1','sys_img1','PCLOGO','/Uploads/image/20200404/2020040402583661.jpg','2','');
INSERT INTO `tp_config` VALUES ('4','1','sys_img2','手机LOGO','','2','');
INSERT INTO `tp_config` VALUES ('5','1','sys_img3','底部LOGO','/Uploads/image/20200404/2020040402590215.jpg','2','');
INSERT INTO `tp_config` VALUES ('6','1','sys_img4','二维码','/Uploads/image/20200404/2020040402592238.jpg','2','');
INSERT INTO `tp_config` VALUES ('7','1','sys_img5','公众号','/Uploads/image/20200404/2020040402593032.jpg','2','');
INSERT INTO `tp_config` VALUES ('8','1','sys_address','地址','中国上海松江工业区华加路99号 （华滨工业园区1-3号楼）','0','');
INSERT INTO `tp_config` VALUES ('9','1','sys_phone','电话','021-67747698','0','');
INSERT INTO `tp_config` VALUES ('10','1','sys_fax','传真','021-67747678','0','');
INSERT INTO `tp_config` VALUES ('13','1','sys_copyright','版权信息','Copyright©2020 中百科电气 版权所有 ','1','');
INSERT INTO `tp_config` VALUES ('14','2','sys_seotitle','网站标题','网站首页','0','');
INSERT INTO `tp_config` VALUES ('15','2','sys_seokeywords','网站关键字','网站关键字','1','');
INSERT INTO `tp_config` VALUES ('16','2','sys_seodescription','网站描述','网站描述','1','');
INSERT INTO `tp_config` VALUES ('17','3','sys_companyname','公司名称','中百科电气','0','');
INSERT INTO `tp_config` VALUES ('18','3','sys_companyaddress','公司地址','安徽省阜阳市阜阳经济技术开发区复兴大道金桥路交叉口','0','');
INSERT INTO `tp_config` VALUES ('19','3','sys_ll','经纬度','115.872988,32.841086','0','');
INSERT INTO `tp_config` VALUES ('20','4','sys_visits','流量统计','11ss','1','');
INSERT INTO `tp_config` VALUES ('21','4','sys_kefu','在线客服','22bb','1','');
INSERT INTO `tp_config` VALUES ('22','4','sys_share','在线分享','33dd','1','');
INSERT INTO `tp_config` VALUES ('23','1','sys_test','公司电话','0551-3943321','0','');
-- -----------------------------
-- Records of `tp_forms`
-- -----------------------------
-- -----------------------------
-- Records of `tp_logs`
-- -----------------------------
INSERT INTO `tp_logs` VALUES ('1','super','编辑行业新闻栏目内容:aaaa(id:52)','127.0.0.1','1588833578');
INSERT INTO `tp_logs` VALUES ('2','super','添加行业新闻栏目内容:(id:1)','127.0.0.1','1588833584');
INSERT INTO `tp_logs` VALUES ('3','super','编辑行业新闻栏目内容:222(id:63)','127.0.0.1','1588833595');
INSERT INTO `tp_logs` VALUES ('4','super','编辑系统用户:jxadmin(id:1)','127.0.0.1','1588834461');
INSERT INTO `tp_logs` VALUES ('5','jxadmin','登录后台系统!','127.0.0.1','1588834534');
INSERT INTO `tp_logs` VALUES ('6','jxadmin','编辑系统用户:jxadmin(id:1)','127.0.0.1','1588834574');
INSERT INTO `tp_logs` VALUES ('7','jxadmin','审核系统用户:(id:1)','127.0.0.1','1588834671');
INSERT INTO `tp_logs` VALUES ('8','jxadmin','审核系统用户:(id:1)','127.0.0.1','1588834675');
INSERT INTO `tp_logs` VALUES ('9','jxadmin','审核系统用户:(id:1)','127.0.0.1','1588834735');
INSERT INTO `tp_logs` VALUES ('10','jxadmin','审核系统用户:(id:1)','127.0.0.1','1588834738');
INSERT INTO `tp_logs` VALUES ('11','jxadmin','登录后台系统!','127.0.0.1','1588911882');
INSERT INTO `tp_logs` VALUES ('12','jxadmin','登录后台系统!','127.0.0.1','1588911953');
-- -----------------------------
-- Records of `tp_manager`
-- -----------------------------
INSERT INTO `tp_manager` VALUES ('1','1','jxadmin','41a11f74a6b20dac5d6cff0342d22fc7','jxadmin','136','1','1588834574');
-- -----------------------------
-- Records of `tp_model`
-- -----------------------------
INSERT INTO `tp_model` VALUES ('2','[单]单一内容','1,9,16','News','Single','0','0','1');
INSERT INTO `tp_model` VALUES ('3','[列表]标题+文件','1,11','News','Index','0','0','1');
INSERT INTO `tp_model` VALUES ('4','[列表]标题+外链+图片','1,5,10','News','Index','1','0','1');
INSERT INTO `tp_model` VALUES ('5','[列表]标题+简介+链接+图片','1,5,6,10','News','Index','1','0','1');
INSERT INTO `tp_model` VALUES ('6','自定义模块','','Message','Index','0','0','1');
INSERT INTO `tp_model` VALUES ('7','[列表]:招聘模块','1,2,6,7,8,9,12,13,14','News','Index','0','0','1');
INSERT INTO `tp_model` VALUES ('8','[列表]校园生活','1,2,9,12,13','News','Index','0','0','1');
INSERT INTO `tp_model` VALUES ('9','[列表]标题+详情','1,9','News','Index','0','0','1');
INSERT INTO `tp_model` VALUES ('10','[列表]招聘岗位','1,2,6,10,12,13','News','Index','1','0','1');
INSERT INTO `tp_model` VALUES ('11','[列表]标题+副标题+摘要+图片','1,2,6,10','News','Index','1','0','1');
INSERT INTO `tp_model` VALUES ('12','[单]标题+副标题+图片','1,2,10','Single','Index','1','0','1');
INSERT INTO `tp_model` VALUES ('13','[列表]标题+摘要+图片','1,6,10','News','Index','1','0','1');
INSERT INTO `tp_model` VALUES ('14','[列表]标题+图片','1,10','News','Index','1','0','1');
INSERT INTO `tp_model` VALUES ('15','[单]标题+副标题+摘要','1,2,6,10','News','Single','1','0','1');
INSERT INTO `tp_model` VALUES ('16','[列表]广告位','1,6,10','News','Index','1','0','1');
INSERT INTO `tp_model` VALUES ('1','[列表]新闻列表','1,7,8,9,10','News','Index','1','0','1');
-- -----------------------------
-- Records of `tp_news`
-- -----------------------------
INSERT INTO `tp_news` VALUES ('1','0','0','10','33','0','中百介绍','','','','<p>\r\n	<strong>雷兹介绍:</strong> \r\n</p>\r\n<p>\r\n	雷兹工业集团创建于1945年的德国汉堡,创始人为”雷兹基金会”的汉斯·雷兹博士及其夫人。\r\n</p>\r\n<p>\r\n	70年来，雷兹集团凭借着以客户需求为导向的技术创新和不懈进取的企业精神，发展成为电能测量技术方面的世界权威型工业集团,与全球各大顶级的电气企业有着紧密且长期的合作，是互感器世界首屈一指的品牌。\r\n</p>\r\n<p>\r\n	集团的业务主要涉及中/低压领域的供电系统和输配电系统,主打产品有:\r\n</p>\r\n<p>\r\n	1.电流互感器\r\n</p>\r\n<p>\r\n	2.电压互感器\r\n</p>\r\n<p>\r\n	3.树脂浇注的全绝缘的母线系统\r\n</p>\r\n<p>\r\n	4.树脂浇注的全绝缘的电力变压器\r\n</p>\r\n<p>\r\n	5.树脂浇注绝缘件\r\n</p>\r\n<p>\r\n	6.低压元器件和传感器等\r\n</p>\r\n<h4>\r\n	集团旗下的知名品牌有:22233\r\n</h4>\r\n<p>\r\n	<img src=\"static/picture/about-pic2.jpg\" /> \r\n</p>','','','','','','','','','','','','','','0','0','0','1','0','1588760811');
INSERT INTO `tp_news` VALUES ('2','0','1','10','34','0','集团组成','','','','如今，雷兹集团已在德国、美国、奥地利、匈牙利和中国拥有8家生产基地和研发中心,全球员工总计超过1000人,年产值达到13亿欧元,并且仍在稳步提升。','','','','','','','','','','','','','','0','0','0','1','0','1585994109');
INSERT INTO `tp_news` VALUES ('3','0','1','11','35','0','公司介绍','','','','&lt;p&gt;\r\n	&lt;img src=&quot;http://www.ritz-china.com/Upload/ueditor/images/2016-01-27/shanhh1-37c1aa0f-ef5d-44e1-a49e-ebe30f710ef6.jpg&quot; style=&quot;float:left;margin-right:20px;&quot; title=&quot;shanhh1.jpg&quot; /&gt;&lt;span style=&quot;font-size:16px;font-weight:bold;color:#9e1a28;padding-top:30px;&quot;&gt;雷兹上海&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	成立于1999年的雷兹互感器（上海）有限公司，是雷兹集团在中国的全资子公司，致力于以精益求精的产品和服务质量，使雷兹成为客户信赖的战略伙伴。作为雷兹旗下重要成员，上海公司严格遵照与德国总公司相同的生产理念完全同步的技术参数和工艺设计，并使用相同的实验设备和检验手段，保证了品质稳定如一。&amp;nbsp;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;clear:both;height:50px;&quot;&gt;\r\n	&amp;nbsp;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;img src=&quot;http://www.ritz-china.com/Upload/ueditor/images/2016-01-27/shanhh2-52aeafea-05bd-4938-8c76-6029a6622e1b.jpg&quot; style=&quot;float:right;margin-left:20px;&quot; title=&quot;shanhh2.jpg&quot; /&gt;&lt;span style=&quot;font-size:16px;font-weight:bold;color:#9e1a28;padding-top:30px;&quot;&gt;工厂介绍&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	公司位于中国上海的松江进出口加工区, 占地面积10000平方米, 拥有全职员工160人，拥有独立的研发部门和先进的检测校验设备, 目前年产值1亿人民币。主营中压、低压的电流/电压互感器和传感器，是西门子、施奈德、ABB、大中华电力、现代重工等知名企业的战略合作供应商。\r\n&lt;/p&gt;','','','','','','','','','','','','','','0','0','0','1','0','1585994152');
INSERT INTO `tp_news` VALUES ('4','0','1','11','36','0','企业文化','','','','&lt;table class=&quot;culture ke-zeroborder&quot; border=&quot;0&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot;&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td height=&quot;140&quot;&gt;\r\n				&lt;img title=&quot;人.jpg&quot; src=&quot;http://www.ritz-china.com/Upload/ueditor/images/2016-02-22/人-deb2af41-d927-4c51-bb04-54368291ec1d.jpg&quot; /&gt; \r\n			&lt;/td&gt;\r\n			&lt;td style=&quot;-ms-word-break:break-all;&quot;&gt;\r\n				&lt;p&gt;\r\n					&lt;strong&gt;以人为本&lt;/strong&gt; \r\n				&lt;/p&gt;\r\n				&lt;p style=&quot;color:#000000;font-size:14px;font-style:normal;font-weight:normal;margin-top:0px;margin-bottom:0px;&quot;&gt;\r\n					&lt;span style=&quot;font-family:arial, helvetica,sans-serif;font-size:14px;&quot;&gt;礼遇他人，尊重员工，严格执行劳动法和国家各项相关规定，缴纳五险一金，做到同工同酬。&lt;/span&gt; \r\n				&lt;/p&gt;\r\n				&lt;p style=&quot;color:#000000;font-family:;&quot;&gt;\r\n					&lt;span style=&quot;font-family:arial, helvetica,sans-serif;font-size:14px;&quot;&gt;完善的厂纪厂规，做到流程指导事务，制度规范行为。&lt;/span&gt; \r\n				&lt;/p&gt;\r\n				&lt;p style=&quot;color:#000000;font-family:;&quot;&gt;\r\n					&lt;span style=&quot;font-family:arial, helvetica,sans-serif;font-size:14px;&quot;&gt;企业文化建设，让每一位员工保持良好的心态工作，关心员工的成长和生活。&lt;/span&gt; \r\n				&lt;/p&gt;\r\n				&lt;p style=&quot;color:#000000;font-family:;&quot;&gt;\r\n					&lt;span style=&quot;font-family:arial, helvetica,sans-serif;font-size:14px;&quot;&gt;民主选举职工代表，让基层员工参与管理，参与决策。&lt;/span&gt; \r\n				&lt;/p&gt;\r\n				&lt;p style=&quot;color:#000000;font-family:;&quot;&gt;\r\n					&lt;span style=&quot;font-family:arial, helvetica,sans-serif;font-size:14px;&quot;&gt;定期举行“基层的声音我要听”主题茶话会；让一线员工直面公司高层，提出问题，思考问题，解决问题。&lt;/span&gt; \r\n				&lt;/p&gt;\r\n				&lt;p style=&quot;color:#000000;font-family:;&quot;&gt;\r\n					&lt;span style=&quot;font-family:arial, helvetica,sans-serif;font-size:14px;&quot;&gt;公司每年针对如何提升员工素质、技能、管理能力及安全意识等等做出各类培训。&lt;/span&gt; \r\n				&lt;/p&gt;\r\n				&lt;p style=&quot;color:#000000;font-family:;&quot;&gt;\r\n					&lt;span style=&quot;font-family:arial, helvetica,sans-serif;font-size:14px;&quot;&gt;完善的晋升、转岗机制，把机会留给每一位有能力的员工。&lt;/span&gt; \r\n				&lt;/p&gt;\r\n				&lt;p&gt;\r\n					&lt;br /&gt;\r\n				&lt;/p&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td height=&quot;140&quot;&gt;\r\n				&lt;img title=&quot;客户.jpg&quot; src=&quot;http://www.ritz-china.com/Upload/ueditor/images/2016-02-22/客户-c48b94d2-a105-4809-8382-27156080057f.jpg&quot; /&gt; \r\n			&lt;/td&gt;\r\n			&lt;td&gt;\r\n				&lt;p&gt;\r\n					&lt;strong&gt;客户至上信誉第一&lt;/strong&gt; \r\n				&lt;/p&gt;\r\n				&lt;p&gt;\r\n					雷兹公司秉承客户至上，信誉第一的原则, 为客户提供优质的产品和服务，不断提高顾客满意度。同时，为创建一个互动、共赢的良性环境而不懈努力。\r\n				&lt;/p&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td height=&quot;140&quot;&gt;\r\n				&lt;img title=&quot;服务.jpg&quot; src=&quot;http://www.ritz-china.com/Upload/ueditor/images/2016-02-22/服务-3a7bf99d-c445-4350-b9b4-19d0136d9ac7.jpg&quot; /&gt; \r\n			&lt;/td&gt;\r\n			&lt;td&gt;\r\n				&lt;p&gt;\r\n					&lt;strong&gt;专业服务及时周到&lt;/strong&gt; \r\n				&lt;/p&gt;\r\n				&lt;p&gt;\r\n					以终为始的售后服务理念，全过程关注服务质量和客户满意度，贴心服务，真情到永远。\r\n				&lt;/p&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td height=&quot;140&quot;&gt;\r\n				&lt;img title=&quot;创新.jpg&quot; src=&quot;http://www.ritz-china.com/Upload/ueditor/images/2016-02-22/创新-d7071171-4887-4c55-aaa9-dc8802d51c2f.jpg&quot; /&gt; \r\n			&lt;/td&gt;\r\n			&lt;td style=&quot;-ms-word-break:break-all;&quot;&gt;\r\n				&lt;p&gt;\r\n					&lt;strong&gt;改革.创新.进取.贡献&lt;/strong&gt; \r\n				&lt;/p&gt;\r\n				&lt;p&gt;\r\n					&lt;span style=&quot;font-family:arial, helvetica,sans-serif;&quot;&gt;我们从农业文明而来，经历了工业革命、电力革命，而今直面信息时代的大数据、区块链以及新能源技术的快速发展。&lt;/span&gt; \r\n				&lt;/p&gt;\r\n				&lt;p&gt;\r\n					&lt;span style=&quot;font-family:arial, helvetica,sans-serif;&quot;&gt;雷兹作为互感器这一传统行业的重要的不可或缺的一员，唯“匠”之初心，亘古不变，一脉相承。“匠”者，厚学启智，求真修德，以精工立业，志在造福社会&lt;span style=&quot;font-family:宋体;&quot;&gt;。&lt;/span&gt;&lt;/span&gt; \r\n				&lt;/p&gt;\r\n				&lt;p&gt;\r\n					&lt;br /&gt;\r\n				&lt;/p&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;','','','','','','','','','','','','','','0','0','0','1','0','1585994199');
INSERT INTO `tp_news` VALUES ('5','0','1','11','37','0','资质证书','','','','&lt;table class=&quot;zhengshu&quot; style=&quot;border-collapse:collapse;&quot;&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td valign=&quot;top&quot; style=&quot;border:0px solid #CCCCCC;border-image:none;-ms-word-break:break-all;&quot;&gt;\r\n				&lt;p&gt;\r\n					&lt;img width=&quot;380&quot; height=&quot;570&quot; title=&quot;ISO9001:2015.jpg&quot; style=&quot;width:380px;height:570px;&quot; src=&quot;http://www.ritz-china.com/Upload/ueditor/images/2019-12-18/ISO Certificates 2019_页面_1-9ad62bcf-c28d-418f-a352-8d1a655ebf15.jpg&quot; border=&quot;0&quot; vspace=&quot;0&quot; hspace=&quot;0&quot; /&gt;&lt;img width=&quot;380&quot; height=&quot;570&quot; title=&quot;ISO45001:2018.jpg&quot; style=&quot;width:380px;height:570px;&quot; src=&quot;http://www.ritz-china.com/Upload/ueditor/images/2019-12-18/ISO Certificates 2019_页面_3-50586051-4dc4-4271-9818-afa6d8eb8d12.jpg&quot; border=&quot;0&quot; vspace=&quot;0&quot; hspace=&quot;0&quot; /&gt; \r\n				&lt;/p&gt;\r\n				&lt;p&gt;\r\n					&lt;img width=&quot;380&quot; height=&quot;570&quot; title=&quot;ISO14001:2015.jpg&quot; style=&quot;width:380px;height:570px;&quot; src=&quot;http://www.ritz-china.com/Upload/ueditor/images/2019-12-18/ISO Certificates 2019_页面_2-89b48293-a4f6-4146-b169-23a0e87b03a8.jpg&quot; border=&quot;0&quot; vspace=&quot;0&quot; hspace=&quot;0&quot; /&gt;&lt;img title=&quot;5.jpg&quot; src=&quot;/Upload/ueditor/images/2016-01-28/5-dd5e43cc-437d-4b5d-9211-4acd295f1208.jpg&quot; border=&quot;0&quot; vspace=&quot;0&quot; hspace=&quot;0&quot; /&gt; \r\n				&lt;/p&gt;\r\n				&lt;p&gt;\r\n					&lt;img title=&quot;6.jpg&quot; src=&quot;http://www.ritz-china.com/Upload/ueditor/images/2016-01-28/6-ddab76fb-2266-49b4-9a2b-7429d76f9bfe.jpg&quot; border=&quot;0&quot; vspace=&quot;0&quot; hspace=&quot;0&quot; /&gt;&lt;img title=&quot;4.jpg&quot; src=&quot;/Upload/ueditor/images/2016-01-28/4-415750be-f5a4-42a1-9250-2a9f51f1bef9.jpg&quot; border=&quot;0&quot; vspace=&quot;0&quot; hspace=&quot;0&quot; /&gt; \r\n				&lt;/p&gt;\r\n				&lt;p&gt;\r\n					&lt;br /&gt;\r\n				&lt;/p&gt;\r\n				&lt;p style=&quot;text-align:center;&quot;&gt;\r\n					&lt;br /&gt;\r\n				&lt;/p&gt;\r\n				&lt;p&gt;\r\n					&lt;br /&gt;\r\n				&lt;/p&gt;\r\n			&lt;/td&gt;\r\n			&lt;td valign=&quot;top&quot; style=&quot;border:0px solid #CCCCCC;border-image:none;-ms-word-break:break-all;&quot;&gt;\r\n				&lt;br /&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;','','','','','','','','','','','','','','0','0','0','1','0','1585994259');
INSERT INTO `tp_news` VALUES ('6','0','6','23','0','0','人才理念','','','','&lt;p&gt;\r\n	■ 万事人为本.人力资源管理的基本目的，是建立一支高素质、高境界和高度团结的队伍，以及创造一种自我激励、自我约束和促进优秀人才脱颖而出的机制，为企业的快速成长和高效运作提供有效的保障。　　　&amp;nbsp;　　　　　　　　　　　　　　　　　　&lt;br /&gt;\r\n■ 人力资源管理的基本准则是信任、公正、激励、约束、培育、淘汰以及发现人才、量才适用、用人所长。&lt;br /&gt;\r\n■ “兵不在众，而在精”我们在人力资源管理中引入优胜劣汰的选择机制，促进优秀人才的脱颖而出，实现人力资源的合理配置。&lt;br /&gt;\r\n■ 我们力求做到为最优秀的员工提供最广阔的机会与条件，每个员工通过努力工作，以及在工作中增长才干，都可能获得职务或任职资格的晋升。我们不拘泥于资历与级别，对有突出才干和突出贡献者实施破格晋升。但是，我们提倡循序渐进。&lt;br /&gt;\r\n■ “天下难事，必做于易；天下大事，必做于细”我们鼓励每位员工通过做好本职工作为实现企业总目标做贡献，并实行绩效考核制度，工作绩效的考评侧重在绩效的改进上，工作态度和工作能力的考评侧重在长期表现上。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;a href=&quot;jobs.aspx?cateid=100&quot; target=&quot;_self&quot; title=&quot;&quot;&gt;&lt;img src=&quot;http://www.ritz-china.com/Upload/ueditor/images/2016-01-27/jios-6bf73add-67ee-4264-bf3b-ca94ef7b4e13.jpg&quot; title=&quot;jios.jpg&quot; /&gt;&lt;/a&gt;\r\n&lt;/p&gt;','','','','','','','','','','','','','','0','0','0','1','0','1585994293');
INSERT INTO `tp_news` VALUES ('7','0','6','26','0','0','薪资福利','','','','&lt;p&gt;\r\n	&lt;span style=&quot;font-family:arial, helvetica, sans-serif;&quot;&gt;&lt;span style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;&quot;&gt;■&lt;/span&gt;年终奖金&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-family:arial, helvetica, sans-serif;&quot;&gt;&lt;span style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;&quot;&gt;■&lt;/span&gt;定期加薪&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-family:arial, helvetica, sans-serif;&quot;&gt;&lt;span style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;&quot;&gt;■&lt;/span&gt;带薪休假&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-family:arial, helvetica, sans-serif;&quot;&gt;&lt;span style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;&quot;&gt;■&lt;/span&gt;定期体检&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-family:arial, helvetica, sans-serif;&quot;&gt;&lt;span style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;&quot;&gt;■&lt;/span&gt;年度旅游&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-family:arial, helvetica, sans-serif;&quot;&gt;&lt;span style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;&quot;&gt;■&lt;/span&gt;五险一金&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-family:arial, helvetica, sans-serif;&quot;&gt;&lt;span style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;&quot;&gt;■&lt;/span&gt;商业保险&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-family:arial, helvetica, sans-serif;&quot;&gt;&lt;span style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;&quot;&gt;■&lt;/span&gt;生日节日礼&lt;/span&gt;&lt;span style=&quot;font-family:arial, helvetica, sans-serif;font-size:14px;&quot;&gt;金&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;','','','','','','','','','','','','','','0','0','0','1','0','1585994311');
INSERT INTO `tp_news` VALUES ('8','0','6','25','0','0','招聘宗旨','','','','&lt;p&gt;\r\n	&lt;span style=&quot;font-family:宋体;&quot;&gt;&lt;span style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;&quot;&gt;■&lt;/span&gt;&lt;span style=&quot;font-family:arial, helvetica, sans-serif;font-size:16px;&quot;&gt;质量第一&lt;/span&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-family:宋体;&quot;&gt;&lt;span style=&quot;font-family:arial, helvetica, sans-serif;font-size:16px;&quot;&gt;&lt;span style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;&quot;&gt;■&lt;/span&gt;荣誉至上&lt;/span&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-family:宋体;&quot;&gt;&lt;span style=&quot;font-family:arial, helvetica, sans-serif;font-size:16px;&quot;&gt;&lt;span style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;&quot;&gt;■&lt;/span&gt;勇于担当&lt;/span&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-family:宋体;&quot;&gt;&lt;span style=&quot;font-family:arial, helvetica, sans-serif;font-size:16px;&quot;&gt;&lt;span style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;&quot;&gt;■&lt;/span&gt;互尊互信&lt;/span&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-family:宋体;&quot;&gt;&lt;span style=&quot;font-family:arial, helvetica, sans-serif;font-size:16px;&quot;&gt;&lt;span style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;&quot;&gt;■&lt;/span&gt;忠诚履职&lt;/span&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-family:宋体;&quot;&gt;&lt;span style=&quot;font-family:arial, helvetica, sans-serif;font-size:16px;&quot;&gt;&lt;span style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;&quot;&gt;■&lt;/span&gt;敢于创新&lt;/span&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-family:宋体;&quot;&gt;&lt;span style=&quot;font-family:arial, helvetica, sans-serif;font-size:16px;&quot;&gt;&lt;span style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;&quot;&gt;■&lt;/span&gt;合作共赢&lt;/span&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;','','','','','','','','','','','','','','0','0','0','1','0','1585994332');
INSERT INTO `tp_news` VALUES ('49','0','2','0','0','0','aa','','','','aaa','/Uploads/image/20200429/2020042908532564.gif','','','','','','','','','','','','','0','0','0','1','0','1588150406');
INSERT INTO `tp_news` VALUES ('12','0','3','14','38','0','ASX12-02型电流互感器','','','','&lt;p&gt;\r\n	&lt;img src=&quot;http://www.ritz-china.com/Upload/ueditor/images/2016-02-22/QQ图片20160222143813-8a8a0303-6867-4653-8bc8-c44c202465d9.png&quot; title=&quot;QQ图片20160222143813.png&quot; /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;img src=&quot;http://www.ritz-china.com/Upload/ueditor/images/2016-02-22/02外型图-aed1d564-5838-4bf2-a0bc-f67fd7c7f202.png&quot; style=&quot;width:850px;height:459px;&quot; title=&quot;02外型图.png&quot; width=&quot;850&quot; height=&quot;459&quot; border=&quot;0&quot; hspace=&quot;0&quot; vspace=&quot;0&quot; /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;img src=&quot;http://www.ritz-china.com/Upload/ueditor/images/2016-02-22/02绝缘套管-d20c68fd-4e3e-450b-9843-37067155981a.png&quot; style=&quot;width:850px;height:459px;&quot; title=&quot;02绝缘套管.png&quot; width=&quot;850&quot; height=&quot;459&quot; border=&quot;0&quot; hspace=&quot;0&quot; vspace=&quot;0&quot; /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;','/static/picture/02-14340187578.png','','','','','','','','','','','','','7','0','0','1','0','1585995564');
INSERT INTO `tp_news` VALUES ('13','0','0','27','0','0','联系方式1111222','','','','<p>\r\n	以下提供本公司的一些主要联系方式,希望社会各界朋友来电来函与我们联系交流,如果您有任何业务上的问题,我们也可为您做相关的解答和探讨。\r\n</p>\r\n<p>\r\n	公司名称：雷兹互感器(上海)有限公司\r\n</p>\r\n<p>\r\n	联系地址：　　　中国上海松江工业区华加路99号\r\n</p>\r\n<p>\r\n	邮政编码：　　　 201613\r\n</p>\r\n<p>\r\n	电话总机：　　　 021-67747698\r\n</p>\r\n<p>\r\n	销售部电话：　　 15021277238 宋经理\r\n</p>\r\n<p>\r\n	销售部电邮：　　 <a href=\"http://mailto:zhendong.song@ritz-china.com\" target=\"_self\" title=\"\" textvalue=\"zhendong.song\">zhendong.song</a><a href=\"mailto:jiaqi.li@ritz-china.com\">@ritz-china.com</a> \r\n</p>\r\n<p>\r\n	Vietnam/Myanmar/Cambodia market：Thanh My Electric Engineering Co., Ltd\r\n</p>\r\n<p style=\"white-space:normal;\">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tel : +84 8 39373 866\r\n</p>\r\n<p style=\"white-space:normal;\">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fax: +84-8 6299 1034\r\n</p>\r\n<p style=\"white-space:normal;\">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email :&nbsp;<a href=\"http://info@thanhmyelectric.com/\" target=\"_blank\" title=\"\">info@thanhmyelectric.com</a> \r\n</p>\r\n<p>\r\n	售后服务电邮： &nbsp; <a href=\"mailto:yanhua.li@ritz-china.com\">peixin.gao@ritz-china.com</a> \r\n</p>\r\n<p>\r\n	信息部电邮：&nbsp;<a href=\"mailto:mis@ritz-china.com\">mis@ritz-china.com</a> \r\n</p>\r\n<p>\r\n	人事招聘电邮：　&nbsp;<a href=\"mailto:qinghong.li@ritz-china.com\">minjie.miao@ritz-china.com</a> \r\n</p>\r\n<p>\r\n	雷兹愿成为您真诚的朋友和最佳的合作伙伴!222\r\n</p>\r\n<p>\r\n	<br />\r\n</p>','','','','','','','','','','','','','','0','0','0','1','0','1585995942');
INSERT INTO `tp_news` VALUES ('52','0','2','13','0','0','aaaa','','','','aaaaaa','','','','','','','','','','','','bbbb','bbbb','0','0','0','1','0','1588833578');
INSERT INTO `tp_news` VALUES ('60','0','2','12','0','0','aa','','','','ee','/Uploads/image/20200506/2020050602385670.png','','','','','','','','','','','bb','dd','0','0','0','1','11','1588732738');
INSERT INTO `tp_news` VALUES ('14','0','4','18','0','0','客户服务','','','','&lt;p&gt;\r\n	&lt;strong&gt;客户服务&lt;br /&gt;\r\n&lt;/strong&gt;我们致力于提供最好的服务给广大客户。如果您需要有关我们产品及服务的任何帮助，请直接联络我们。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;strong&gt;服务方式&lt;/strong&gt; &amp;nbsp;&lt;br /&gt;\r\n&amp;nbsp;1.远程服务&lt;br /&gt;\r\n如果您的系统出现紧急故障，您可以通过电话、电子邮件或其他方式与我们联系，我们的技术人员将通过互联网来远程解决这些问题。&lt;br /&gt;\r\n&lt;br /&gt;\r\n2.现场服务&lt;br /&gt;\r\n提供给广大客户现场维护服务，不断提高客户的满意度。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;strong&gt;专业服务&lt;/strong&gt; &amp;nbsp;&lt;br /&gt;\r\n我们专业的工程师团队乐于为您提供咨询和实施方面的服务。如需了解优化管理效率和提升业务增长的详情，敬请联络我们。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;strong&gt;服务内容&lt;/strong&gt; &amp;nbsp;&lt;br /&gt;\r\n&amp;nbsp;1.客户需求分析&lt;br /&gt;\r\n通过分析您的业务需求，提供专业的咨询服务。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	2.产品及系统&lt;br /&gt;\r\n根据我们的分析，我们将制定多种产品解决方案，并比较它们的功能和优点。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	3.项目优化&lt;br /&gt;\r\n制定出项目实施流程以及不同的产品解决方案的可行性分析\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	4.系统安装与测试&lt;br /&gt;\r\n选择最终的产品解决方案，并且安装，调试。以确保产品的正常使用。\r\n&lt;/p&gt;','','','','','','','','','','','','','','0','0','0','1','0','1585996395');
INSERT INTO `tp_news` VALUES ('15','0','4','19','0','0','常见问题','','','','&lt;p&gt;\r\n	&lt;span style=&quot;color:#974806;&quot;&gt;&lt;strong&gt;&lt;span style=&quot;font-family:Verdana, Arial;line-height:22px;font-size:14px;background-color:#F6FCFF;&quot;&gt;1. 电压互感器的本体故障&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-size:12px;color:#505050;line-height:22px;word-break:break-all;font-family:Verdana, Arial;background-color:#F6FCFF;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;font-size:12px;color:#505050;line-height:22px;word-break:break-all;font-family:宋体;background-color:#F6FCFF;&quot;&gt;电&lt;/span&gt;&lt;span style=&quot;font-size:12px;color:#505050;line-height:22px;word-break:break-all;font-family:宋体;background-color:#F6FCFF;&quot;&gt;压互感器内部故障，电路导线受潮、腐蚀及损伤使二次绕组接线短路，发生一相接地短路及相见短路等，犹豫短路点在二次保险前面，故障点在高压保险熔解断之前不会自动隔离。&lt;/span&gt;&lt;span lang=&quot;EN-US&quot; style=&quot;font-size:12px;color:#505050;line-height:22px;word-break:break-all;font-family:Verdana, Arial;background-color:#F6FCFF;&quot;&gt;&amp;nbsp;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;word-break:break-all;font-family:Verdana, Arial, Helvetica, sans-serif;margin:0cm 0cm 0pt;font-size:13px;white-space:normal;color:#505050;line-height:22px;background-color:#F6FCFF;&quot;&gt;\r\n	&lt;span style=&quot;word-break:break-all;font-family:宋体, SimSun;font-size:10px;&quot;&gt;&amp;nbsp;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;word-break:break-all;font-family:Verdana, Arial, Helvetica, sans-serif;margin:0cm 0cm 0pt;font-size:13px;white-space:normal;color:#505050;line-height:22px;background-color:#F6FCFF;&quot;&gt;\r\n	&lt;span style=&quot;font-family:宋体, SimSun;font-size:14px;color:#974806;&quot;&gt;&lt;strong style=&quot;word-break:break-all;font-family:Verdana, Arial;&quot;&gt;&lt;span lang=&quot;EN-US&quot; style=&quot;font-size:14px;font-family:宋体, SimSun;word-break:break-all;&quot;&gt;2&lt;/span&gt;&lt;/strong&gt;&lt;strong style=&quot;word-break:break-all;font-family:Verdana, Arial;&quot;&gt;&lt;span style=&quot;font-size:14px;word-break:break-all;font-family:宋体;&quot;&gt;．电压互感器本体故障处理方法&lt;/span&gt;&lt;/strong&gt;&lt;span lang=&quot;EN-US&quot; style=&quot;font-size:14px;word-break:break-all;font-family:Verdana, Arial;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;word-break:break-all;font-family:Verdana, Arial, Helvetica, sans-serif;margin:0cm 0cm 0pt;font-size:13px;white-space:normal;color:#505050;line-height:22px;background-color:#F6FCFF;&quot;&gt;\r\n	&lt;span style=&quot;font-family:宋体, SimSun;font-size:10px;&quot;&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;font-size:12px;&quot;&gt;退出可能误动作的保护及自动装置，断开故障电压互感器二次开关（或拔掉二次保险），电压互感器三相或一相高压保险已熔断，可以拉开隔离开关隔离故障高压保险未熔断高压侧绝缘未损坏的故障，可以拉开隔离开关，隔离故障；所装高压保险上有合格的限流电阻时，可以根据现场规程规定，拉开隔离开关，隔离眼中故障电压互感器；应尽量利用倒运行方式隔离故障，否则在不带电的情况下拉开隔离开关，然后恢复供电&lt;/span&gt;&lt;span style=&quot;font-size:16px;word-break:break-all;font-family:宋体;&quot;&gt;。&lt;/span&gt;&lt;span lang=&quot;EN-US&quot; style=&quot;font-size:16px;word-break:break-all;font-family:Verdana, Arial;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;word-break:break-all;font-family:Verdana, Arial, Helvetica, sans-serif;margin:0cm 0cm 0pt;font-size:13px;white-space:normal;color:#505050;line-height:22px;background-color:#F6FCFF;&quot;&gt;\r\n	&lt;span style=&quot;word-break:break-all;font-family:宋体, SimSun;font-size:10px;&quot;&gt;&amp;nbsp;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;word-break:break-all;font-family:Verdana, Arial, Helvetica, sans-serif;margin:0cm 0cm 0pt;font-size:13px;white-space:normal;color:#505050;line-height:22px;background-color:#F6FCFF;&quot;&gt;\r\n	&lt;span style=&quot;font-family:宋体, SimSun;font-size:14px;color:#974806;&quot;&gt;&lt;strong style=&quot;word-break:break-all;font-family:Verdana, Arial;&quot;&gt;&lt;span lang=&quot;EN-US&quot; style=&quot;font-size:14px;font-family:宋体, SimSun;word-break:break-all;&quot;&gt;3&lt;/span&gt;&lt;/strong&gt;&lt;strong style=&quot;word-break:break-all;font-family:Verdana, Arial;&quot;&gt;&lt;span style=&quot;font-size:14px;word-break:break-all;font-family:宋体;&quot;&gt;．交流电压回路断线故障&lt;/span&gt;&lt;/strong&gt;&lt;span lang=&quot;EN-US&quot; style=&quot;font-size:14px;word-break:break-all;font-family:Verdana, Arial;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;word-break:break-all;font-family:Verdana, Arial, Helvetica, sans-serif;margin:0cm 0cm 0pt;font-size:13px;white-space:normal;color:#505050;line-height:22px;background-color:#F6FCFF;&quot;&gt;\r\n	&lt;span style=&quot;font-family:宋体, SimSun;font-size:10px;&quot;&gt;&lt;span style=&quot;word-break:break-all;font-family:Verdana, Arial;font-size:10px;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;font-family:宋体;font-size:10px;&quot;&gt;电压回路中，常见的故障是一、二次保险熔断或解除不良而断路。二次回路中常见的有：保险熔断或接触不良、一次隔离开关辅助接点接触不良、电压切换回路断线或接触不良，回路中发生短路等。这些故障使继电保护及自动装置失去交流电压，可能误动作，同时表计指示不正确。&lt;/span&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;word-break:break-all;margin:0cm 0cm 0pt;font-size:13px;white-space:normal;color:#505050;line-height:22px;background-color:#F6FCFF;&quot;&gt;\r\n	&lt;span style=&quot;font-size:10px;&quot;&gt;&lt;span style=&quot;font-family:Verdana, Arial;font-size:16px;word-break:break-all;&quot;&gt;&amp;nbsp; &amp;nbsp;&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-size:12px;&quot;&gt;&lt;span style=&quot;font-family:宋体;&quot;&gt;(&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;font-family:宋体, SimSun;font-size:12px;&quot;&gt;&lt;span style=&quot;font-size:12px;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;1).&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;font-size:12px;word-break:break-all;font-family:宋体;&quot;&gt;某一线路报出“电压回路断线”信号的情况。&lt;/span&gt;&lt;span style=&quot;font-size:12px;word-break:break-all;font-family:Verdana, Arial;&quot;&gt;&amp;nbsp;&lt;span lang=&quot;EN-US&quot; style=&quot;font-size:12px;font-family:宋体, SimSun;word-break:break-all;&quot;&gt;a&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;font-size:12px;word-break:break-all;font-family:宋体;&quot;&gt;象征及原因。某一线路报出“电压回路断线”信号，警铃响，该线路的标记指示降低为零，保护失去交流电压，断线闭锁装置做东。故障：交流电压小母线及以上回路和设备无问题，故障只应在与线路有关的二次回路部分。主要原因有：保护及仪表用电压切换回路断线、接触不良。&lt;/span&gt;&lt;span style=&quot;font-size:12px;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;b&lt;/span&gt;&lt;span style=&quot;font-size:12px;word-break:break-all;font-family:宋体;&quot;&gt;处理这种故障原因时应特别注意，距离保护在交流电压断线情况下，&lt;/span&gt;&lt;span style=&quot;font-size:12px;word-break:break-all;font-family:Verdana, Arial;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;font-size:12px;word-break:break-all;font-family:宋体;&quot;&gt;直流操作电源断开，重新合上时，可能会误动跳闸。曾发生过距离保护在交流电压断线时，断线闭锁装置动作，因直流操作保险断续性的接触不良误动作跳闸事故。因此，这种情况下，距离保护未退出时，不能装拔直流操作保险。&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;word-break:break-all;font-family:Verdana, Arial, Helvetica, sans-serif;margin:0cm 0cm 0pt;font-size:13px;white-space:normal;color:#505050;line-height:22px;background-color:#F6FCFF;&quot;&gt;\r\n	&lt;span style=&quot;font-family:宋体, SimSun;font-size:12px;&quot;&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;&amp;nbsp;（&lt;/span&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;2).&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;交流“电压回路断线”、保护“直流电压回路断线”的处理方法&lt;/span&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;:A&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;检查电压切换继电器（交流电压回路中的&lt;/span&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;1ZJ&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;、&lt;/span&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;2ZJ&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;）接点未闭合的原因&lt;/span&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;&amp;nbsp;:a&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;．可以在一次主电路运行母线（在合闸位置的母线侧隔离开关）相对应的切换继电器上，测量线圈两端电压。若电压正常，可能为继电器接点未接通（多次发生操作后），也可能是继电器线圈断线。&lt;/span&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;b&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;．电压很低，而操作电源正常，则可能是隔离开关的辅助接点（&lt;/span&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;1QS&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;、&lt;/span&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;2QS&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;）接触不良，或回路中的连接端子出问题。&lt;/span&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;word-break:break-all;font-family:Verdana, Arial, Helvetica, sans-serif;margin:0cm 0cm 0pt;font-size:13px;white-space:normal;color:#505050;line-height:22px;background-color:#F6FCFF;&quot;&gt;\r\n	&lt;span style=&quot;font-family:宋体, SimSun;font-size:12px;&quot;&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;&amp;nbsp; &amp;nbsp; (3).&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;检查电压切换继电器接点闭合的原因。&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:Verdana, Arial;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;应测量电压的小母线的引入端子和保护回路的交流电压是否正常。若小母线引入端子电压&lt;/span&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;(A630)&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;正常，而保护回路的交流电压（&lt;/span&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;A710&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;）不正常&lt;/span&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;,&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;可能是切换继电器接点接触不良，或端子排、接线柱等有断线点或接触不良。&lt;/span&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;word-break:break-all;font-family:Verdana, Arial, Helvetica, sans-serif;margin:0cm 0cm 0pt;font-size:13px;white-space:normal;color:#505050;line-height:22px;background-color:#F6FCFF;&quot;&gt;\r\n	&lt;span style=&quot;font-family:宋体, SimSun;font-size:12px;&quot;&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;&amp;nbsp; &amp;nbsp; (4).&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;处理时注意防止交流电压回路短路，分别情况如下处理：&lt;/span&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;a.&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;如发现端子线头、辅助接点接触有问题，可自行处理，打开保护继电器，防止保护误动作。&lt;/span&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;b.&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;不能自行处理的赢汇报调度和有关上级，退出可能误动的保护。&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:Verdana, Arial;&quot;&gt;&amp;nbsp;&lt;span lang=&quot;EN-US&quot; style=&quot;font-family:宋体, SimSun;word-break:break-all;&quot;&gt;c.&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;若属隔离开关辅助接点接触不良，不可采用黄永隔离开关操作机构的方法以及防止带电拉隔离开关，造成事故。&lt;/span&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;word-break:break-all;font-family:Verdana, Arial, Helvetica, sans-serif;margin:0cm 0cm 0pt;font-size:13px;white-space:normal;color:#505050;line-height:22px;background-color:#F6FCFF;&quot;&gt;\r\n	&lt;span style=&quot;font-family:宋体, SimSun;font-size:12px;&quot;&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;&amp;nbsp; &amp;nbsp; (5)&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;高压保险熔断的主要原因。&lt;/span&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;word-break:break-all;font-family:Verdana, Arial, Helvetica, sans-serif;margin:0cm 0cm 0pt;font-size:13px;white-space:normal;color:#505050;line-height:22px;background-color:#F6FCFF;&quot;&gt;\r\n	&lt;span style=&quot;font-size:12px;&quot;&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体, SimSun;&quot;&gt;&amp;nbsp;&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;a).&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;系统发生单相间歇性弧光接地。由于此时会出现过电压（可达相电&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:Verdana, Arial;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;压的&lt;/span&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;2.5~3&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;倍），使电压互感器铁芯饱和，励磁电流急剧增加使高压保险熔断。由此可知在报接地信号时，有系统接地信号，可直接怀疑高压保险是否熔断。&lt;/span&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;word-break:break-all;font-family:Verdana, Arial, Helvetica, sans-serif;margin:0cm 0cm 0pt;font-size:13px;white-space:normal;color:#505050;line-height:22px;background-color:#F6FCFF;&quot;&gt;\r\n	&lt;span style=&quot;font-family:宋体, SimSun;font-size:12px;&quot;&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; b).&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;铁磁谐振过电压。系统在操作单相接地或断线故障时，在一定条件&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:Verdana, Arial;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;下，可能产生铁磁谐振，也出现过电压，励磁电流正大十几倍，使高压保险熔断。&lt;/span&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;word-break:break-all;font-family:Verdana, Arial, Helvetica, sans-serif;margin:0cm 0cm 0pt;font-size:13px;white-space:normal;color:#505050;line-height:22px;background-color:#F6FCFF;&quot;&gt;\r\n	&lt;span style=&quot;font-family:宋体, SimSun;font-size:12px;&quot;&gt;&lt;span style=&quot;font-family:Verdana, Arial;font-size:16px;word-break:break-all;&quot;&gt;&amp;nbsp; &amp;nbsp;&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;font-family:宋体, SimSun;font-size:12px;&quot;&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt;c).&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;电压互感器内部短路接地、严重的出现匝间短路等故障。&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;word-break:break-all;font-family:Verdana, Arial, Helvetica, sans-serif;margin:0cm 0cm 0pt;font-size:13px;white-space:normal;color:#505050;line-height:22px;background-color:#F6FCFF;&quot;&gt;\r\n	&lt;span style=&quot;font-family:宋体, SimSun;font-size:12px;&quot;&gt;&lt;span style=&quot;font-family:Verdana, Arial;font-size:16px;word-break:break-all;&quot;&gt;&amp;nbsp; &amp;nbsp;&lt;/span&gt;&lt;span style=&quot;font-family:宋体, SimSun;font-size:12px;&quot;&gt;&lt;span style=&quot;font-family:Verdana, Arial;word-break:break-all;&quot;&gt; d).&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;二次保险（或二次断路器）以上发生短路，或二次回路短路而二次&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:Verdana, Arial;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;word-break:break-all;font-family:宋体;&quot;&gt;保险未熔断。&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;','','','','','','','','','','','','','','0','0','0','1','0','1585996411');
INSERT INTO `tp_news` VALUES ('16','0','4','20','0','0','AIS 样本2017','','','','','','','','','','','/Uploads/file/20200404/2020040410361558.zip','','','','','','','0','0','0','1','0','1585996578');
INSERT INTO `tp_news` VALUES ('17','0','4','20','0','0','GIS 样本2017','','','','','','','','','','','/Uploads/file/20200404/2020040410363210.zip','','','','','','','0','0','0','1','0','1585996594');
INSERT INTO `tp_news` VALUES ('18','0','6','24','0','0','生产操作工','若干名','','&lt;p style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;white-space:normal;&quot;&gt;\r\n	&lt;span style=&quot;font-family:arial, helvetica, sans-serif;&quot;&gt;税前月薪：2500-3500元；&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;white-space:normal;&quot;&gt;\r\n	&lt;span style=&quot;font-family:arial, helvetica, sans-serif;&quot;&gt;其他补充：钳工类中高级技能者薪资面议；&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;white-space:normal;&quot;&gt;\r\n	&lt;span style=&quot;font-family:arial, helvetica, sans-serif;&quot;&gt;补充医疗保障、生日/节日礼金；&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;white-space:normal;&quot;&gt;\r\n	&lt;span style=&quot;font-family:arial, helvetica, sans-serif;&quot;&gt;加班按国家规定另行计算。&lt;/span&gt;\r\n&lt;/p&gt;','&lt;p style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;white-space:normal;&quot;&gt;\r\n	&lt;span style=&quot;font-family:arial, helvetica, sans-serif;&quot;&gt;技能要求：&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;white-space:normal;&quot;&gt;\r\n	&lt;span style=&quot;font-family:arial, helvetica, sans-serif;&quot;&gt;1. 年龄在23-40岁。&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;white-space:normal;&quot;&gt;\r\n	&lt;span style=&quot;font-family:arial, helvetica, sans-serif;&quot;&gt;2. 职校、技校以上学历，机械类相关专业优先；&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#444444;font-family:&amp;quot;font-size:14px;white-space:normal;&quot;&gt;\r\n	&lt;span style=&quot;font-family:arial, helvetica, sans-serif;&quot;&gt;3. 能适应两班制/三班制的工作时间，8小时双休。&lt;/span&gt;\r\n&lt;/p&gt;','','','','','','','','67747698-2033　何小姐','上海市松江区','2020-11-14','','','','2','0','0','1','0','1585996761');
INSERT INTO `tp_news` VALUES ('19','0','9','31','0','0','首页轮播','','#','','','/static/picture/banner1.jpg','','','','','','','','','','','','','0','0','0','1','0','1585997387');
INSERT INTO `tp_news` VALUES ('20','0','9','31','0','0','首页轮播','','','','','/static/picture/banner2.jpg','','','','','','','','','','','','','0','0','0','1','0','1585997398');
INSERT INTO `tp_news` VALUES ('21','0','9','31','0','0','首页轮播','','','','','/static/picture/banner3.jpg','','','','','','','','','','','','','0','0','0','1','0','1585997409');
INSERT INTO `tp_news` VALUES ('22','0','9','31','0','0','首页轮播','','','','','/static/picture/banner4.jpg','','','','','','','','','','','','','0','0','0','1','0','1585997419');
INSERT INTO `tp_news` VALUES ('23','0','9','32','0','0','产品技术','','/List-About-pid-4-ty-18.html','拥有超过200年历史的互感器专业技术，为客户量身定制各类输配电的解决方案。','','/static/picture/indexmian-pic1.jpg','','','','','','','','','','','','','0','0','0','1','0','1585997527');
INSERT INTO `tp_news` VALUES ('24','0','9','32','0','0','服务支持','','/List-About-pid-4-ty-18.html','在国内、亚洲及全球范围都有快速且成熟的售前、售后的服务支持网络。','','/static/picture/indexmian-pic2.jpg','','','','','','','','','','','','','0','0','0','1','0','1585997553');
INSERT INTO `tp_news` VALUES ('25','0','9','32','0','0','关于中百','','/List-About-pid-4-ty-18.html','1945年创建于德国汉堡的雷兹集团是全球互感器制造业和技术工艺的领导者。','','/static/picture/indexmian-pic3.jpg','','','','','','','','','','','','','0','0','0','1','0','1585997600');
INSERT INTO `tp_news` VALUES ('26','0','9','32','0','0','企业形象','','/List-About-pid-4-ty-18.html','在国内、亚洲及全球范围都有快速且成熟的售前、售后的服务支持网络。','','/static/picture/indexmian-pic3.jpg','','','','','','','','','','','','','0','0','0','1','0','1585997658');
INSERT INTO `tp_news` VALUES ('27','0','5','22','0','0','知名客户','','','','&lt;img src=&quot;http://www.ritz-china.com/Upload/ueditor/images/2016-03-22/%E5%90%88%E4%BD%9C%E5%93%81%E7%89%8C-ae24a058-b163-4f04-b0b5-596a71467a41.jpg&quot; alt=&quot;&quot; /&gt;','','','','','','','','','','','','','','0','0','0','1','0','1585998812');
INSERT INTO `tp_news` VALUES ('28','0','5','21','0','0','营销网络','','','','&lt;table width=&quot;100%&quot; cellpadding=&quot;0&quot; cellspacing=&quot;0&quot;&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td&gt;\r\n				负责区域\r\n			&lt;/td&gt;\r\n			&lt;td&gt;\r\n				销售经理\r\n			&lt;/td&gt;\r\n			&lt;td&gt;\r\n				手机\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td colspan=&quot;1&quot; rowspan=&quot;1&quot;&gt;\r\n				北方大区\r\n			&lt;/td&gt;\r\n			&lt;td colspan=&quot;1&quot; rowspan=&quot;1&quot;&gt;\r\n				宋振栋\r\n			&lt;/td&gt;\r\n			&lt;td colspan=&quot;1&quot; rowspan=&quot;1&quot;&gt;\r\n				15021277238\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td&gt;\r\n				&lt;p&gt;\r\n					&amp;nbsp; &amp;nbsp; &amp;nbsp; 江苏，安徽，浙江\r\n				&lt;/p&gt;\r\n				&lt;p&gt;\r\n					&amp;nbsp; &amp;nbsp; &amp;nbsp; 山西，陕西，新疆，甘肃，内蒙古，青海，宁夏\r\n				&lt;/p&gt;\r\n				&lt;p&gt;\r\n					&amp;nbsp; &amp;nbsp; &amp;nbsp; 北京，天津，河北，黑龙江，吉林，辽宁\r\n				&lt;/p&gt;\r\n			&lt;/td&gt;\r\n			&lt;td&gt;\r\n				&lt;br /&gt;\r\n			&lt;/td&gt;\r\n			&lt;td&gt;\r\n				&lt;br /&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td&gt;\r\n				&lt;p&gt;\r\n					南方大区\r\n				&lt;/p&gt;\r\n			&lt;/td&gt;\r\n			&lt;td&gt;\r\n				许文岳\r\n			&lt;/td&gt;\r\n			&lt;td&gt;\r\n				13599501525\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td colspan=&quot;1&quot; rowspan=&quot;1&quot;&gt;\r\n				&lt;p style=&quot;margin-top:0px;margin-bottom:0px;padding:0px;white-space:normal;&quot;&gt;\r\n					&amp;nbsp; &amp;nbsp; &amp;nbsp; 广西，福建，江西，湖南\r\n				&lt;/p&gt;\r\n				&lt;p style=&quot;margin-top:0px;margin-bottom:0px;padding:0px;white-space:normal;&quot;&gt;\r\n					&amp;nbsp; &amp;nbsp; &amp;nbsp; 广东，海南\r\n				&lt;/p&gt;\r\n				&lt;p style=&quot;margin-top:0px;margin-bottom:0px;padding:0px;white-space:normal;&quot;&gt;\r\n					&amp;nbsp; &amp;nbsp; &amp;nbsp; 西藏，四川，湖北，云南，重庆，贵州\r\n				&lt;/p&gt;\r\n			&lt;/td&gt;\r\n			&lt;td colspan=&quot;1&quot; rowspan=&quot;1&quot;&gt;\r\n				&lt;br /&gt;\r\n			&lt;/td&gt;\r\n			&lt;td colspan=&quot;1&quot; rowspan=&quot;1&quot;&gt;\r\n				&lt;br /&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td&gt;\r\n				&lt;p&gt;\r\n					大客户\r\n				&lt;/p&gt;\r\n			&lt;/td&gt;\r\n			&lt;td&gt;\r\n				李佳琦\r\n			&lt;/td&gt;\r\n			&lt;td&gt;\r\n				13918093117\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td colspan=&quot;1&quot; rowspan=&quot;1&quot;&gt;\r\n				&lt;p style=&quot;margin-top:0px;margin-bottom:0px;padding:0px;white-space:normal;&quot;&gt;\r\n					&amp;nbsp; &amp;nbsp; &amp;nbsp; 上海，山东，河南\r\n				&lt;/p&gt;\r\n				&lt;p style=&quot;margin-top:0px;margin-bottom:0px;padding:0px;white-space:normal;&quot;&gt;\r\n					&amp;nbsp; &amp;nbsp; &amp;nbsp; 大客户\r\n				&lt;/p&gt;\r\n			&lt;/td&gt;\r\n			&lt;td colspan=&quot;1&quot; rowspan=&quot;1&quot;&gt;\r\n				&lt;br /&gt;\r\n			&lt;/td&gt;\r\n			&lt;td colspan=&quot;1&quot; rowspan=&quot;1&quot;&gt;\r\n				&lt;br /&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td rowspan=&quot;2&quot;&gt;\r\n				&lt;p&gt;\r\n					海外市场\r\n				&lt;/p&gt;\r\n			&lt;/td&gt;\r\n			&lt;td rowspan=&quot;2&quot; colspan=&quot;1&quot;&gt;\r\n				&lt;p&gt;\r\n					李沿桦\r\n				&lt;/p&gt;\r\n				&lt;p&gt;\r\n					李伟明\r\n				&lt;/p&gt;\r\n			&lt;/td&gt;\r\n			&lt;td rowspan=&quot;2&quot; colspan=&quot;1&quot;&gt;\r\n				&lt;p&gt;\r\n					13817909975\r\n				&lt;/p&gt;\r\n				&lt;p&gt;\r\n					15921001562\r\n				&lt;/p&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td rowspan=&quot;1&quot; colspan=&quot;1&quot;&gt;\r\n				&lt;p style=&quot;margin-top:0px;margin-bottom:0px;padding:0px;white-space:normal;&quot;&gt;\r\n					&amp;nbsp; &amp;nbsp; &amp;nbsp; 互感器\r\n				&lt;/p&gt;\r\n				&lt;p style=&quot;margin-top:0px;margin-bottom:0px;padding:0px;white-space:normal;&quot;&gt;\r\n					&amp;nbsp; &amp;nbsp; &amp;nbsp; 特种干变，全绝缘母排\r\n				&lt;/p&gt;\r\n			&lt;/td&gt;\r\n			&lt;td rowspan=&quot;1&quot; colspan=&quot;1&quot;&gt;\r\n				&lt;br /&gt;\r\n			&lt;/td&gt;\r\n			&lt;td rowspan=&quot;1&quot; colspan=&quot;1&quot;&gt;\r\n				&lt;br /&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;','','','','','','','','','','','','','','0','0','0','1','0','1585998840');
INSERT INTO `tp_news` VALUES ('11','0','3','14','38','0','ASX12-01型电流互感器','','','','&lt;img src=&quot;http://www.ritz-china.com/Upload/ueditor/images/2016-02-17/cp1d-1ae79b37-b922-4eac-8484-d654f25165fc.jpg&quot; alt=&quot;&quot; /&gt;','/static/picture/cp1-11354116468.jpg','','','','','','','','','','','','','0','0','0','1','0','1585995512');
INSERT INTO `tp_news` VALUES ('63','0','2','13','0','0','222','','','','33','/Uploads/image/20200507/2020050706395458.png','','','','','','','','','','','','','0','0','0','1','0','1588833595');
-- -----------------------------
-- Records of `tp_role`
-- -----------------------------
INSERT INTO `tp_role` VALUES ('1','超级管理员','','','1513227497','1');
-- -----------------------------
-- Records of `tp_sort`
-- -----------------------------
INSERT INTO `tp_sort` VALUES ('1','1','0','中百介绍','','/static/picture/banner-page.jpg','/static/picture/side-top-about.jpg','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','5','1585993100');
INSERT INTO `tp_sort` VALUES ('2','1','0','新闻中心','','/static/picture/banner-page.jpg','/static/picture/side-top-news.jpg','','','160 x 120','','1','3','','','','News','','News','News','Index','','0','0','0','1','10','1585972380');
INSERT INTO `tp_sort` VALUES ('3','1','0','产品展示','','/static/picture/banner-page.jpg','/static/picture/side-top-product.jpg','','','240 x 180','','1','3','','','','Product','','News','News','Index','','0','0','0','1','15','1585972391');
INSERT INTO `tp_sort` VALUES ('4','2','0','技术服务','','/static/picture/banner-page.jpg','/static/picture/side-top-service.jpg','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','20','1585970198');
INSERT INTO `tp_sort` VALUES ('5','2','0','营销网络','','/static/picture/banner-page.jpg','/static/picture/side-top-sales.jpg','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','25','1585970218');
INSERT INTO `tp_sort` VALUES ('6','2','0','加入中百','','/static/picture/banner-page.jpg','/static/picture/side-top-contact2.jpg','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','30','1585970248');
INSERT INTO `tp_sort` VALUES ('7','2','0','联系我们','','/static/picture/banner-page.jpg','/static/picture/side-top-contact2.jpg','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','35','1585972408');
INSERT INTO `tp_sort` VALUES ('8','2','0','什么是互感器','','','','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','40','1585970287');
INSERT INTO `tp_sort` VALUES ('9','4','0','辅助栏目','','','','','','1920*600','','1','3','','','','','','News','News','Index','','0','0','0','1','45','1585972051');
INSERT INTO `tp_sort` VALUES ('10','1','1','中百集团','','','','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','50','1586246598');
INSERT INTO `tp_sort` VALUES ('11','2','1','中百上海','','','','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','55','1585970676');
INSERT INTO `tp_sort` VALUES ('12','1','2','公司新闻','','','','','','160 x 120','','1','3','','','','News','','News','News','Index','','0','0','0','1','60','1585970693');
INSERT INTO `tp_sort` VALUES ('13','1','2','行业新闻','','','','','','160 x 120','','1','3','','','','News','','News','News','Index','','0','0','0','1','65','1585970702');
INSERT INTO `tp_sort` VALUES ('14','1','3','电流互感器','','','','','','240 x 180','','1','3','','','','Product','','News','News','Index','','0','0','0','1','70','1585970714');
INSERT INTO `tp_sort` VALUES ('15','1','3','电压互感器','','','','','','240 x 180','','1','3','','','','Product','','News','News','Index','','0','0','0','1','75','1585970723');
INSERT INTO `tp_sort` VALUES ('16','1','3','绝缘套管系列','','','','','','240 x 180','','1','3','','','','Product','','News','News','Index','','0','0','0','1','80','1585970734');
INSERT INTO `tp_sort` VALUES ('17','1','3','传感器系列','','','','','','240 x 180','','1','3','','','','Product','','News','News','Index','','0','0','0','1','85','1585970742');
INSERT INTO `tp_sort` VALUES ('18','2','4','客户服务','','','','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','90','1585970753');
INSERT INTO `tp_sort` VALUES ('19','2','4','常见问题','','','','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','95','1585970762');
INSERT INTO `tp_sort` VALUES ('20','3','4','下载中心','','','','','','','','0','3','','','','Download','','News','News','Index','','0','0','0','1','100','1585970792');
INSERT INTO `tp_sort` VALUES ('21','2','5','营销网络','','','','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','105','1585970804');
INSERT INTO `tp_sort` VALUES ('22','2','5','知名客户','','','','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','110','1585970814');
INSERT INTO `tp_sort` VALUES ('23','2','6','人才理念','','','','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','115','1585970823');
INSERT INTO `tp_sort` VALUES ('24','7','6','社会招聘','','','','','','','','0','3','','','','Jobs','','Jobs','News','Index','','0','0','0','0','120','1585970873');
INSERT INTO `tp_sort` VALUES ('25','2','6','招聘宗旨','','','','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','125','1585970894');
INSERT INTO `tp_sort` VALUES ('26','2','6','薪资福利','','','','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','130','1585970907');
INSERT INTO `tp_sort` VALUES ('27','2','7','联系方式','','','','','','','','0','3','','','','Contact','','News','News','Single','','0','0','0','1','135','1585996105');
INSERT INTO `tp_sort` VALUES ('28','2','7','在线留言','','','','','','','','0','3','','','','Message','','Forms','Forms','Infos','typeid/1/zid/2','0','0','0','1','140','1588818728');
INSERT INTO `tp_sort` VALUES ('29','2','8','功能与作用','','','','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','145','1585971862');
INSERT INTO `tp_sort` VALUES ('30','2','8','主要分类','','','','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','150','1585971875');
INSERT INTO `tp_sort` VALUES ('31','4','9','首页轮播','','','','','','1920*600','','1','3','','','','','','News','News','Index','','0','0','0','1','155','1585972082');
INSERT INTO `tp_sort` VALUES ('32','5','9','首页快捷导航','','','','','','215*153','','1','3','','','','','','News','News','Index','','0','0','0','1','160','1585972237');
INSERT INTO `tp_sort` VALUES ('33','2','10','中百介绍','','','','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','165','1585976331');
INSERT INTO `tp_sort` VALUES ('34','2','10','集团组成','','','','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','170','1585972267');
INSERT INTO `tp_sort` VALUES ('35','2','11','公司介绍','','','','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','175','1585972275');
INSERT INTO `tp_sort` VALUES ('36','2','11','企业文化','','','','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','180','1585972283');
INSERT INTO `tp_sort` VALUES ('37','2','11','资质证书','','','','','','','','0','3','','','','About','','News','News','Single','','0','0','0','1','185','1585972292');
INSERT INTO `tp_sort` VALUES ('38','1','14','12kV电流互感器','','','','','','240 x 180','','1','3','','','','Product','','News','News','Index','','0','0','0','1','190','1585972310');
INSERT INTO `tp_sort` VALUES ('39','1','14','24kV电流互感器','','','','','','240 x 180','','1','3','','','','Product','','News','News','Index','','0','0','0','1','195','1585972318');
INSERT INTO `tp_sort` VALUES ('40','1','14','35kV电流互感器','','','','','','240 x 180','','1','3','','','','Product','','News','News','Index','','0','0','0','1','200','1585972325');
INSERT INTO `tp_sort` VALUES ('41','1','14','SF6充气柜用电流互感器','','','','','','240 x 180','','1','3','','','','Product','','News','News','Index','','0','0','0','1','205','1585972335');
INSERT INTO `tp_sort` VALUES ('42','1','15','12kV电流互感器','','','','','','240 x 180','','1','3','','','','Product','','News','News','Index','','0','0','0','1','210','1585972342');
INSERT INTO `tp_sort` VALUES ('43','1','15','24kV电流互感器','','','','','','240 x 180','','1','3','','','','Product','','News','News','Index','','0','0','0','1','215','1585972351');
INSERT INTO `tp_sort` VALUES ('44','1','15','35kV电流互感器','','','','','','240 x 180','','1','3','','','','Product','','News','News','Index','','0','0','0','1','220','1585972359');
INSERT INTO `tp_sort` VALUES ('45','1','15','SF6充气柜用电流互感器','','','','','','240 x 180','','1','3','','','','Product','','News','News','Index','','0','0','0','1','225','1585972368');
-- -----------------------------
-- Records of `tp_titlepic`
-- -----------------------------
INSERT INTO `tp_titlepic` VALUES ('1','1','aa','bb','/Uploads/image/20200417/2020041710445741.jpg','1','1588760811');
INSERT INTO `tp_titlepic` VALUES ('2','1','ee','ff','/Uploads/image/20200417/2020041710235777.jpg','1','1588760811');
INSERT INTO `tp_titlepic` VALUES ('3','1','dd','cc','/Uploads/image/20200417/2020041710235758.jpg','1','1588760811');
-- -----------------------------
-- Records of `tp_yzm`
-- -----------------------------
INSERT INTO `tp_yzm` VALUES ('1','2','252492432@qq.com','498337','0','1587452671');
