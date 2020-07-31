/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : db_tp5

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2020-06-19 13:58:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_config
-- ----------------------------
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
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_config
-- ----------------------------
INSERT INTO `tp_config` VALUES ('1', '1', 'sys_isopen', '开启关闭', '开启', '3', '开启|关闭');
INSERT INTO `tp_config` VALUES ('2', '1', 'sys_sitename', '站点名称', '安豪 - 海外进口家电维修中心', '0', '');
INSERT INTO `tp_config` VALUES ('3', '1', 'sys_img1', 'PCLOGO', '/Uploads/image/20200615/2020061506390245.png', '2', '');
INSERT INTO `tp_config` VALUES ('4', '1', 'sys_img2', '手机LOGO', '', '2', '');
INSERT INTO `tp_config` VALUES ('5', '1', 'sys_img3', '底部LOGO', '/Uploads/image/20200615/2020061506393988.png', '2', '');
INSERT INTO `tp_config` VALUES ('6', '1', 'sys_img4', '二维码', '/Uploads/image/20200615/2020061506394835.jpg', '2', '');
INSERT INTO `tp_config` VALUES ('7', '1', 'sys_img5', '公众号', '/Uploads/image/20200404/2020040402593032.jpg', '2', '');
INSERT INTO `tp_config` VALUES ('8', '1', 'sys_address', '地址', '安徽省合肥市北城新区', '0', '');
INSERT INTO `tp_config` VALUES ('9', '1', 'sys_phone', '服务热线', '18792212787', '0', '');
INSERT INTO `tp_config` VALUES ('10', '1', 'sys_fax', '营业时间', 'MON-SAT 9:00-18:00', '0', '');
INSERT INTO `tp_config` VALUES ('13', '1', 'sys_copyright', '版权信息', 'Copyright ©上海安豪家电维修中心粤ICP备19147387号', '1', '');
INSERT INTO `tp_config` VALUES ('14', '2', 'sys_seotitle', '网站标题', '网站首页', '0', '');
INSERT INTO `tp_config` VALUES ('15', '2', 'sys_seokeywords', '网站关键字', '网站关键字', '1', '');
INSERT INTO `tp_config` VALUES ('16', '2', 'sys_seodescription', '网站描述', '网站描述', '1', '');
INSERT INTO `tp_config` VALUES ('17', '3', 'sys_companyname', '公司名称', '中百科电气', '0', '');
INSERT INTO `tp_config` VALUES ('18', '3', 'sys_companyaddress', '公司地址', '安徽省阜阳市阜阳经济技术开发区复兴大道金桥路交叉口', '0', '');
INSERT INTO `tp_config` VALUES ('19', '3', 'sys_ll', '经纬度', '115.872988,32.841086', '0', '');
INSERT INTO `tp_config` VALUES ('20', '4', 'sys_visits', '流量统计', '11ss', '1', '');
INSERT INTO `tp_config` VALUES ('21', '4', 'sys_kefu', '在线客服', '22bb', '1', '');
INSERT INTO `tp_config` VALUES ('22', '4', 'sys_share', '在线分享', '33dd', '1', '');
INSERT INTO `tp_config` VALUES ('23', '1', 'sys_test', '公司电话', '0551-3943321', '0', '');
INSERT INTO `tp_config` VALUES ('24', '1', 'sys_qq', 'qq客服', '22312312', '0', '');
INSERT INTO `tp_config` VALUES ('25', '1', 'sys_email', '邮箱', 'sales@ h111.com', '0', '');

-- ----------------------------
-- Table structure for tp_forms
-- ----------------------------
DROP TABLE IF EXISTS `tp_forms`;
CREATE TABLE `tp_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表单',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `tablename` varchar(50) NOT NULL DEFAULT '' COMMENT '表名',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否成功状态',
  `sendtime` varchar(10) NOT NULL DEFAULT '' COMMENT '登录时间',
  PRIMARY KEY (`id`),
  KEY `forms` (`sendtime`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_forms
-- ----------------------------
INSERT INTO `tp_forms` VALUES ('15', '在线留言', 'message', '1', '1591602217');

-- ----------------------------
-- Table structure for tp_logs
-- ----------------------------
DROP TABLE IF EXISTS `tp_logs`;
CREATE TABLE `tp_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '后台操作日志表',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '操作用户',
  `content` varchar(100) NOT NULL DEFAULT '' COMMENT '操作内容',
  `ip` varchar(15) NOT NULL DEFAULT '' COMMENT 'ip地址',
  `sendtime` varchar(10) NOT NULL DEFAULT '' COMMENT '操作时间',
  PRIMARY KEY (`id`),
  KEY `logs` (`username`,`sendtime`)
) ENGINE=MyISAM AUTO_INCREMENT=281 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_logs
-- ----------------------------
INSERT INTO `tp_logs` VALUES ('112', 'super', '添加分类名称:关于我们(id:1)', '127.0.0.1', '1592200989');
INSERT INTO `tp_logs` VALUES ('113', 'super', '添加分类名称:服务支持(id:1)', '127.0.0.1', '1592201053');
INSERT INTO `tp_logs` VALUES ('114', 'super', '添加分类名称:新闻中心(id:1)', '127.0.0.1', '1592201111');
INSERT INTO `tp_logs` VALUES ('115', 'super', '添加分类名称:联系我们(id:1)', '127.0.0.1', '1592201167');
INSERT INTO `tp_logs` VALUES ('116', 'super', '添加分类名称:辅助栏目(id:1)', '127.0.0.1', '1592201198');
INSERT INTO `tp_logs` VALUES ('117', 'super', '添加分类名称:公司简介(id:1)', '127.0.0.1', '1592201455');
INSERT INTO `tp_logs` VALUES ('118', 'super', '编辑模块名称:[列表]新闻列表(id:1)', '127.0.0.1', '1592201542');
INSERT INTO `tp_logs` VALUES ('119', 'super', '编辑模块名称:[列表]标题+简介(id:8)', '127.0.0.1', '1592201781');
INSERT INTO `tp_logs` VALUES ('120', 'super', '删除模块:(id:22)', '127.0.0.1', '1592201798');
INSERT INTO `tp_logs` VALUES ('121', 'super', '添加分类名称:企业文化(id:1)', '127.0.0.1', '1592201875');
INSERT INTO `tp_logs` VALUES ('122', 'super', '添加分类名称:企业荣誉(id:1)', '127.0.0.1', '1592201910');
INSERT INTO `tp_logs` VALUES ('123', 'super', '添加分类名称:合作品牌(id:1)', '127.0.0.1', '1592201948');
INSERT INTO `tp_logs` VALUES ('124', 'super', '添加分类名称:服务支持(id:1)', '127.0.0.1', '1592201963');
INSERT INTO `tp_logs` VALUES ('125', 'super', '添加分类名称:新闻中心(id:1)', '127.0.0.1', '1592201971');
INSERT INTO `tp_logs` VALUES ('126', 'super', '添加分类名称:联系我们(id:1)', '127.0.0.1', '1592201980');
INSERT INTO `tp_logs` VALUES ('127', 'super', '添加分类名称:首页轮播图(id:1)', '127.0.0.1', '1592202077');
INSERT INTO `tp_logs` VALUES ('128', 'super', '添加首页轮播图栏目内容:(id:1)', '127.0.0.1', '1592202339');
INSERT INTO `tp_logs` VALUES ('129', 'super', '添加首页轮播图栏目内容:(id:1)', '127.0.0.1', '1592202351');
INSERT INTO `tp_logs` VALUES ('130', 'super', '添加首页轮播图栏目内容:(id:1)', '127.0.0.1', '1592202363');
INSERT INTO `tp_logs` VALUES ('131', 'super', '编辑配置信息', '127.0.0.1', '1592203119');
INSERT INTO `tp_logs` VALUES ('132', 'super', '编辑配置信息', '127.0.0.1', '1592203189');
INSERT INTO `tp_logs` VALUES ('133', 'super', '编辑配置信息', '127.0.0.1', '1592203260');
INSERT INTO `tp_logs` VALUES ('134', 'super', '添加配置信息:(id:1)', '127.0.0.1', '1592203320');
INSERT INTO `tp_logs` VALUES ('135', 'super', '编辑分类名称:公司简介(id:6)', '127.0.0.1', '1592357377');
INSERT INTO `tp_logs` VALUES ('136', 'super', '编辑模块名称:[单]标题+副标题+摘要(id:15)', '127.0.0.1', '1592357497');
INSERT INTO `tp_logs` VALUES ('137', 'super', '编辑模块名称:[单]标题+副标题+摘要(id:15)', '127.0.0.1', '1592357529');
INSERT INTO `tp_logs` VALUES ('138', 'super', '编辑模块名称:[单]标题+摘要+详情+图片(id:15)', '127.0.0.1', '1592357589');
INSERT INTO `tp_logs` VALUES ('139', 'super', '添加公司简介栏目内容:公司简介(id:1)', '127.0.0.1', '1592357771');
INSERT INTO `tp_logs` VALUES ('140', 'super', '添加公司简介栏目内容:公司简介(id:1)', '127.0.0.1', '1592357993');
INSERT INTO `tp_logs` VALUES ('141', 'super', '添加公司简介栏目内容:公司简介(id:1)', '127.0.0.1', '1592358004');
INSERT INTO `tp_logs` VALUES ('142', 'super', '添加企业文化栏目内容:(id:1)', '127.0.0.1', '1592358044');
INSERT INTO `tp_logs` VALUES ('143', 'super', '添加企业文化栏目内容:(id:1)', '127.0.0.1', '1592358054');
INSERT INTO `tp_logs` VALUES ('144', 'super', '添加企业文化栏目内容:(id:1)', '127.0.0.1', '1592358063');
INSERT INTO `tp_logs` VALUES ('145', 'super', '添加企业文化栏目内容:(id:1)', '127.0.0.1', '1592358074');
INSERT INTO `tp_logs` VALUES ('146', 'super', '添加企业荣誉栏目内容:(id:1)', '127.0.0.1', '1592358106');
INSERT INTO `tp_logs` VALUES ('147', 'super', '添加企业荣誉栏目内容:(id:1)', '127.0.0.1', '1592358125');
INSERT INTO `tp_logs` VALUES ('148', 'super', '添加企业荣誉栏目内容:(id:1)', '127.0.0.1', '1592358126');
INSERT INTO `tp_logs` VALUES ('149', 'super', '添加企业荣誉栏目内容:(id:1)', '127.0.0.1', '1592358126');
INSERT INTO `tp_logs` VALUES ('150', 'super', '添加企业荣誉栏目内容:(id:1)', '127.0.0.1', '1592358126');
INSERT INTO `tp_logs` VALUES ('151', 'super', '添加企业荣誉栏目内容:(id:1)', '127.0.0.1', '1592358126');
INSERT INTO `tp_logs` VALUES ('152', 'super', '添加企业荣誉栏目内容:(id:1)', '127.0.0.1', '1592358126');
INSERT INTO `tp_logs` VALUES ('153', 'super', '添加企业荣誉栏目内容:(id:1)', '127.0.0.1', '1592358126');
INSERT INTO `tp_logs` VALUES ('154', 'super', '添加合作品牌栏目内容:(id:1)', '127.0.0.1', '1592358155');
INSERT INTO `tp_logs` VALUES ('155', 'super', '添加合作品牌栏目内容:(id:1)', '127.0.0.1', '1592358155');
INSERT INTO `tp_logs` VALUES ('156', 'super', '添加合作品牌栏目内容:(id:1)', '127.0.0.1', '1592358155');
INSERT INTO `tp_logs` VALUES ('157', 'super', '添加合作品牌栏目内容:(id:1)', '127.0.0.1', '1592358155');
INSERT INTO `tp_logs` VALUES ('158', 'super', '添加合作品牌栏目内容:(id:1)', '127.0.0.1', '1592358155');
INSERT INTO `tp_logs` VALUES ('159', 'super', '添加合作品牌栏目内容:(id:1)', '127.0.0.1', '1592358155');
INSERT INTO `tp_logs` VALUES ('160', 'super', '添加服务支持栏目内容:(id:1)', '127.0.0.1', '1592358194');
INSERT INTO `tp_logs` VALUES ('161', 'super', '添加服务支持栏目内容:(id:1)', '127.0.0.1', '1592358215');
INSERT INTO `tp_logs` VALUES ('162', 'super', '添加服务支持栏目内容:(id:1)', '127.0.0.1', '1592358238');
INSERT INTO `tp_logs` VALUES ('163', 'super', '添加服务支持栏目内容:(id:1)', '127.0.0.1', '1592358260');
INSERT INTO `tp_logs` VALUES ('164', 'super', '编辑合作品牌栏目内容:美诺(id:23)', '127.0.0.1', '1592358276');
INSERT INTO `tp_logs` VALUES ('165', 'super', '编辑合作品牌栏目内容:美诺(id:23)', '127.0.0.1', '1592358286');
INSERT INTO `tp_logs` VALUES ('166', 'super', '编辑合作品牌栏目内容:美诺(id:22)', '127.0.0.1', '1592358302');
INSERT INTO `tp_logs` VALUES ('167', 'super', '编辑合作品牌栏目内容:美诺(id:21)', '127.0.0.1', '1592358332');
INSERT INTO `tp_logs` VALUES ('168', 'super', '编辑合作品牌栏目内容:美诺(id:20)', '127.0.0.1', '1592358348');
INSERT INTO `tp_logs` VALUES ('169', 'super', '编辑合作品牌栏目内容:美诺(id:19)', '127.0.0.1', '1592358368');
INSERT INTO `tp_logs` VALUES ('170', 'super', '添加合作品牌栏目内容:(id:1)', '127.0.0.1', '1592358397');
INSERT INTO `tp_logs` VALUES ('171', 'super', '添加公司简介栏目内容:公司简介(id:1)', '127.0.0.1', '1592359017');
INSERT INTO `tp_logs` VALUES ('172', 'super', '添加公司简介栏目内容:公司简介(id:1)', '127.0.0.1', '1592359106');
INSERT INTO `tp_logs` VALUES ('173', 'super', '编辑模块名称:[列表]标题+图片(id:14)', '127.0.0.1', '1592359890');
INSERT INTO `tp_logs` VALUES ('174', 'super', '编辑分类名称:服务支持(id:10)', '127.0.0.1', '1592363980');
INSERT INTO `tp_logs` VALUES ('175', 'super', '编辑服务支持栏目内容:洗衣机维修(id:28)', '127.0.0.1', '1592364000');
INSERT INTO `tp_logs` VALUES ('176', 'super', '编辑服务支持栏目内容:煤气灶(id:27)', '127.0.0.1', '1592364158');
INSERT INTO `tp_logs` VALUES ('177', 'super', '编辑服务支持栏目内容:冰箱维修(id:26)', '127.0.0.1', '1592364174');
INSERT INTO `tp_logs` VALUES ('178', 'super', '编辑服务支持栏目内容:酒柜维修(id:25)', '127.0.0.1', '1592364186');
INSERT INTO `tp_logs` VALUES ('179', 'super', '添加新闻中心栏目内容:(id:1)', '127.0.0.1', '1592364849');
INSERT INTO `tp_logs` VALUES ('180', 'super', '添加新闻中心栏目内容:(id:1)', '127.0.0.1', '1592364873');
INSERT INTO `tp_logs` VALUES ('181', 'super', '添加新闻中心栏目内容:(id:1)', '127.0.0.1', '1592364895');
INSERT INTO `tp_logs` VALUES ('182', 'super', '添加新闻中心栏目内容:(id:1)', '127.0.0.1', '1592364931');
INSERT INTO `tp_logs` VALUES ('183', 'super', '编辑新闻中心栏目内容:中国航集团公司实行母子公司(id:35)', '127.0.0.1', '1592364954');
INSERT INTO `tp_logs` VALUES ('184', 'super', '编辑模块名称:[列表]新闻列表(id:1)', '127.0.0.1', '1592366122');
INSERT INTO `tp_logs` VALUES ('185', 'super', '编辑新闻中心栏目内容:中国航集团公司实行母子公司(id:35)', '127.0.0.1', '1592366130');
INSERT INTO `tp_logs` VALUES ('186', 'super', '编辑新闻中心栏目内容:中国航集团公司实行母子公司(id:34)', '127.0.0.1', '1592366135');
INSERT INTO `tp_logs` VALUES ('187', 'super', '编辑新闻中心栏目内容:中国航集团公司实行母子公司(id:33)', '127.0.0.1', '1592366406');
INSERT INTO `tp_logs` VALUES ('188', 'super', '编辑新闻中心栏目内容:等陪同参观并办方和PI之间的究的质量提供了全面的(id:32)', '127.0.0.1', '1592366413');
INSERT INTO `tp_logs` VALUES ('189', 'super', '编辑新闻中心栏目内容:中国航集团公司实行母子公司(id:33)', '127.0.0.1', '1592366419');
INSERT INTO `tp_logs` VALUES ('190', 'super', '添加配置信息:(id:1)', '127.0.0.1', '1592367087');
INSERT INTO `tp_logs` VALUES ('191', 'super', '编辑模块名称:[列表]标题+摘要+图片+推荐(id:13)', '127.0.0.1', '1592376677');
INSERT INTO `tp_logs` VALUES ('192', 'super', '编辑服务支持栏目内容:洗衣机维修(id:28)', '127.0.0.1', '1592376770');
INSERT INTO `tp_logs` VALUES ('193', 'super', '编辑服务支持栏目内容:煤气灶(id:27)', '127.0.0.1', '1592376775');
INSERT INTO `tp_logs` VALUES ('194', 'super', '编辑服务支持栏目内容:冰箱维修(id:26)', '127.0.0.1', '1592376779');
INSERT INTO `tp_logs` VALUES ('195', 'super', '编辑服务支持栏目内容:酒柜维修(id:25)', '127.0.0.1', '1592376783');
INSERT INTO `tp_logs` VALUES ('196', 'super', '添加分类名称:成功案例(id:1)', '127.0.0.1', '1592376908');
INSERT INTO `tp_logs` VALUES ('197', 'super', '添加分类名称:成功案例(id:1)', '127.0.0.1', '1592376921');
INSERT INTO `tp_logs` VALUES ('198', 'super', '更新栏目排序:(id:1)', '127.0.0.1', '1592376928');
INSERT INTO `tp_logs` VALUES ('199', 'super', '更新栏目排序:(id:6)', '127.0.0.1', '1592376928');
INSERT INTO `tp_logs` VALUES ('200', 'super', '更新栏目排序:(id:7)', '127.0.0.1', '1592376928');
INSERT INTO `tp_logs` VALUES ('201', 'super', '更新栏目排序:(id:8)', '127.0.0.1', '1592376928');
INSERT INTO `tp_logs` VALUES ('202', 'super', '更新栏目排序:(id:9)', '127.0.0.1', '1592376928');
INSERT INTO `tp_logs` VALUES ('203', 'super', '更新栏目排序:(id:2)', '127.0.0.1', '1592376928');
INSERT INTO `tp_logs` VALUES ('204', 'super', '更新栏目排序:(id:10)', '127.0.0.1', '1592376928');
INSERT INTO `tp_logs` VALUES ('205', 'super', '更新栏目排序:(id:3)', '127.0.0.1', '1592376928');
INSERT INTO `tp_logs` VALUES ('206', 'super', '更新栏目排序:(id:11)', '127.0.0.1', '1592376928');
INSERT INTO `tp_logs` VALUES ('207', 'super', '更新栏目排序:(id:4)', '127.0.0.1', '1592376928');
INSERT INTO `tp_logs` VALUES ('208', 'super', '更新栏目排序:(id:12)', '127.0.0.1', '1592376928');
INSERT INTO `tp_logs` VALUES ('209', 'super', '更新栏目排序:(id:5)', '127.0.0.1', '1592376928');
INSERT INTO `tp_logs` VALUES ('210', 'super', '更新栏目排序:(id:13)', '127.0.0.1', '1592376928');
INSERT INTO `tp_logs` VALUES ('211', 'super', '更新栏目排序:(id:14)', '127.0.0.1', '1592376928');
INSERT INTO `tp_logs` VALUES ('212', 'super', '更新栏目排序:(id:15)', '127.0.0.1', '1592376928');
INSERT INTO `tp_logs` VALUES ('213', 'super', '添加成功案例栏目内容:(id:1)', '127.0.0.1', '1592376974');
INSERT INTO `tp_logs` VALUES ('214', 'super', '添加成功案例栏目内容:(id:1)', '127.0.0.1', '1592377001');
INSERT INTO `tp_logs` VALUES ('215', 'super', '添加成功案例栏目内容:(id:1)', '127.0.0.1', '1592377030');
INSERT INTO `tp_logs` VALUES ('216', 'super', '添加成功案例栏目内容:(id:1)', '127.0.0.1', '1592377593');
INSERT INTO `tp_logs` VALUES ('217', 'super', '编辑成功案例栏目内容:成功案例名称(id:37)', '127.0.0.1', '1592377608');
INSERT INTO `tp_logs` VALUES ('218', 'super', '编辑分类名称:关于我们(id:1)', '127.0.0.1', '1592476511');
INSERT INTO `tp_logs` VALUES ('219', 'super', '编辑分类名称:服务支持(id:2)', '127.0.0.1', '1592476531');
INSERT INTO `tp_logs` VALUES ('220', 'super', '编辑分类名称:新闻中心(id:3)', '127.0.0.1', '1592476564');
INSERT INTO `tp_logs` VALUES ('221', 'super', '编辑分类名称:联系我们(id:4)', '127.0.0.1', '1592476581');
INSERT INTO `tp_logs` VALUES ('222', 'super', '添加公司简介栏目内容:公司简介(id:1)', '127.0.0.1', '1592476872');
INSERT INTO `tp_logs` VALUES ('223', 'super', '编辑分类名称:合作品牌(id:9)', '127.0.0.1', '1592477105');
INSERT INTO `tp_logs` VALUES ('224', 'super', '编辑合作品牌栏目内容:嘉格纳(id:29)', '127.0.0.1', '1592477120');
INSERT INTO `tp_logs` VALUES ('225', 'super', '编辑合作品牌栏目内容:美诺(id:24)', '127.0.0.1', '1592477128');
INSERT INTO `tp_logs` VALUES ('226', 'super', '编辑合作品牌栏目内容:倍科(id:23)', '127.0.0.1', '1592477134');
INSERT INTO `tp_logs` VALUES ('227', 'super', '添加公司简介栏目内容:公司简介(id:1)', '127.0.0.1', '1592477429');
INSERT INTO `tp_logs` VALUES ('228', 'super', '编辑新闻中心栏目内容:中国航集团公司实行母子公司(id:35)', '127.0.0.1', '1592530617');
INSERT INTO `tp_logs` VALUES ('229', 'super', '编辑新闻中心栏目内容:中国航集团公司实行母子公司(id:34)', '127.0.0.1', '1592530634');
INSERT INTO `tp_logs` VALUES ('230', 'super', '编辑新闻中心栏目内容:中国航集团公司实行母子公司(id:33)', '127.0.0.1', '1592530650');
INSERT INTO `tp_logs` VALUES ('231', 'super', '编辑新闻中心栏目内容:等陪同参观并办方和PI之间的究的质量提供了全面的(id:32)', '127.0.0.1', '1592530672');
INSERT INTO `tp_logs` VALUES ('232', 'super', '添加新闻中心栏目内容:(id:1)', '127.0.0.1', '1592530705');
INSERT INTO `tp_logs` VALUES ('233', 'super', '编辑新闻中心栏目内容:部分家电维修要“躲雨”(id:42)', '127.0.0.1', '1592530711');
INSERT INTO `tp_logs` VALUES ('234', 'super', '添加新闻中心栏目内容:(id:1)', '127.0.0.1', '1592530744');
INSERT INTO `tp_logs` VALUES ('235', 'super', '添加新闻中心栏目内容:(id:1)', '127.0.0.1', '1592532309');
INSERT INTO `tp_logs` VALUES ('236', 'super', '编辑成功案例栏目内容:成功案例名称(id:39)', '127.0.0.1', '1592532366');
INSERT INTO `tp_logs` VALUES ('237', 'super', '编辑成功案例栏目内容:成功案例名称(id:38)', '127.0.0.1', '1592532395');
INSERT INTO `tp_logs` VALUES ('238', 'super', '编辑成功案例栏目内容:成功案例名称(id:37)', '127.0.0.1', '1592532461');
INSERT INTO `tp_logs` VALUES ('239', 'super', '编辑成功案例栏目内容:12年家电维修老师傅分享多品牌变频空调维修实例(id:39)', '127.0.0.1', '1592532487');
INSERT INTO `tp_logs` VALUES ('240', 'super', '编辑成功案例栏目内容:美的挂烫机原理与维修实例(id:38)', '127.0.0.1', '1592532505');
INSERT INTO `tp_logs` VALUES ('241', 'super', '编辑新闻中心栏目内容:家电维修互联网平台，创新发展新时代家电后服务模式(id:44)', '127.0.0.1', '1592532607');
INSERT INTO `tp_logs` VALUES ('242', 'super', '编辑新闻中心栏目内容:当心！家电维修谨防山寨400电话坑人(id:43)', '127.0.0.1', '1592532622');
INSERT INTO `tp_logs` VALUES ('243', 'super', '编辑新闻中心栏目内容:部分家电维修要“躲雨”(id:42)', '127.0.0.1', '1592532633');
INSERT INTO `tp_logs` VALUES ('244', 'super', '添加分类名称:首页关于我们(id:1)', '127.0.0.1', '1592533374');
INSERT INTO `tp_logs` VALUES ('245', 'super', '编辑分类名称:首页关于我们(id:16)', '127.0.0.1', '1592533387');
INSERT INTO `tp_logs` VALUES ('246', 'super', '编辑分类名称:关于我们(id:1)', '127.0.0.1', '1592533805');
INSERT INTO `tp_logs` VALUES ('247', 'super', '编辑分类名称:关于我们(id:1)', '127.0.0.1', '1592533878');
INSERT INTO `tp_logs` VALUES ('248', 'super', '审核栏目:(id:16)', '127.0.0.1', '1592533905');
INSERT INTO `tp_logs` VALUES ('249', 'super', '编辑分类名称:服务支持(id:2)', '127.0.0.1', '1592533933');
INSERT INTO `tp_logs` VALUES ('250', 'super', '编辑分类名称:新闻中心(id:3)', '127.0.0.1', '1592534001');
INSERT INTO `tp_logs` VALUES ('251', 'super', '添加公司简介栏目内容:公司简介(id:1)', '127.0.0.1', '1592535090');
INSERT INTO `tp_logs` VALUES ('252', 'super', '审核栏目:(id:16)', '127.0.0.1', '1592535100');
INSERT INTO `tp_logs` VALUES ('253', 'super', '添加公司简介栏目内容:公司简介(id:1)', '127.0.0.1', '1592537494');
INSERT INTO `tp_logs` VALUES ('254', 'super', '编辑模块名称:[单]单一内容(id:2)', '127.0.0.1', '1592537521');
INSERT INTO `tp_logs` VALUES ('255', 'super', '添加首页关于我们栏目内容:首页关于我们(id:1)', '127.0.0.1', '1592537627');
INSERT INTO `tp_logs` VALUES ('256', 'super', '编辑模块名称:[单]单一内容(id:2)', '127.0.0.1', '1592537642');
INSERT INTO `tp_logs` VALUES ('257', 'super', '添加首页关于我们栏目内容:首页关于我们(id:1)', '127.0.0.1', '1592537649');
INSERT INTO `tp_logs` VALUES ('258', 'super', '添加公司简介栏目内容:公司简介(id:1)', '127.0.0.1', '1592537655');
INSERT INTO `tp_logs` VALUES ('259', 'super', '编辑分类名称:公司简介(id:6)', '127.0.0.1', '1592537669');
INSERT INTO `tp_logs` VALUES ('260', 'super', '审核栏目:(id:16)', '127.0.0.1', '1592537673');
INSERT INTO `tp_logs` VALUES ('261', 'super', '添加公司简介栏目内容:公司简介(id:1)', '127.0.0.1', '1592537723');
INSERT INTO `tp_logs` VALUES ('262', 'super', '添加公司简介栏目内容:公司简介(id:1)', '127.0.0.1', '1592537873');
INSERT INTO `tp_logs` VALUES ('263', 'super', '编辑分类名称:成功案例(id:14)', '127.0.0.1', '1592538005');
INSERT INTO `tp_logs` VALUES ('264', 'super', '编辑分类名称:公司简介(id:6)', '127.0.0.1', '1592538178');
INSERT INTO `tp_logs` VALUES ('265', 'super', '添加公司简介栏目内容:公司简介(id:1)', '127.0.0.1', '1592538193');
INSERT INTO `tp_logs` VALUES ('266', 'super', '编辑分类名称:公司简介(id:6)', '127.0.0.1', '1592538206');
INSERT INTO `tp_logs` VALUES ('267', 'super', '删除信息:(id:52)', '127.0.0.1', '1592538234');
INSERT INTO `tp_logs` VALUES ('268', 'super', '删除信息:(id:51)', '127.0.0.1', '1592538234');
INSERT INTO `tp_logs` VALUES ('269', 'super', '删除信息:(id:50)', '127.0.0.1', '1592538234');
INSERT INTO `tp_logs` VALUES ('270', 'super', '删除信息:(id:49)', '127.0.0.1', '1592538234');
INSERT INTO `tp_logs` VALUES ('271', 'super', '删除信息:(id:46)', '127.0.0.1', '1592538234');
INSERT INTO `tp_logs` VALUES ('272', 'super', '删除信息:(id:45)', '127.0.0.1', '1592538234');
INSERT INTO `tp_logs` VALUES ('273', 'super', '删除信息:(id:41)', '127.0.0.1', '1592538234');
INSERT INTO `tp_logs` VALUES ('274', 'super', '删除信息:(id:40)', '127.0.0.1', '1592538234');
INSERT INTO `tp_logs` VALUES ('275', 'super', '删除信息:(id:31)', '127.0.0.1', '1592538234');
INSERT INTO `tp_logs` VALUES ('276', 'super', '删除信息:(id:30)', '127.0.0.1', '1592538234');
INSERT INTO `tp_logs` VALUES ('277', 'super', '删除信息:(id:6)', '127.0.0.1', '1592538234');
INSERT INTO `tp_logs` VALUES ('278', 'super', '删除信息:(id:5)', '127.0.0.1', '1592538234');
INSERT INTO `tp_logs` VALUES ('279', 'super', '删除信息:(id:4)', '127.0.0.1', '1592538234');
INSERT INTO `tp_logs` VALUES ('280', 'super', '添加公司简介栏目内容:(id:1)', '127.0.0.1', '1592538298');

-- ----------------------------
-- Table structure for tp_manager
-- ----------------------------
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

-- ----------------------------
-- Records of tp_manager
-- ----------------------------
INSERT INTO `tp_manager` VALUES ('1', '1', 'jxadmin', '41a11f74a6b20dac5d6cff0342d22fc7', 'jxadmin', '139', '1', '1590719118');

-- ----------------------------
-- Table structure for tp_message
-- ----------------------------
DROP TABLE IF EXISTS `tp_message`;
CREATE TABLE `tp_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '在线留言表',
  `ip` varchar(15) NOT NULL DEFAULT '' COMMENT 'ip地址',
  `tel` varchar(300) NOT NULL DEFAULT '' COMMENT '电话_',
  `realname` varchar(300) NOT NULL DEFAULT '' COMMENT '姓名_',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `sendtime` varchar(10) NOT NULL DEFAULT '' COMMENT '操作时间',
  PRIMARY KEY (`id`),
  KEY `message` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_message
-- ----------------------------

-- ----------------------------
-- Table structure for tp_model
-- ----------------------------
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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_model
-- ----------------------------
INSERT INTO `tp_model` VALUES ('2', '[单]单一内容', '1,9', 'News', 'Single', '0', '0', '1');
INSERT INTO `tp_model` VALUES ('3', '[列表]标题+文件', '1,11', 'News', 'Index', '0', '0', '1');
INSERT INTO `tp_model` VALUES ('4', '[列表]标题+外链+图片', '1,5,10', 'News', 'Index', '1', '0', '1');
INSERT INTO `tp_model` VALUES ('5', '[列表]标题+简介+链接+图片', '1,5,6,10', 'News', 'Index', '1', '0', '1');
INSERT INTO `tp_model` VALUES ('6', '自定义模块', '', 'Message', 'Index', '0', '0', '1');
INSERT INTO `tp_model` VALUES ('7', '[列表]:招聘模块', '1,2,6,7,8,9,12,13,14', 'News', 'Index', '0', '0', '1');
INSERT INTO `tp_model` VALUES ('8', '[列表]标题+简介', '1,6', 'News', 'Index', '0', '0', '1');
INSERT INTO `tp_model` VALUES ('9', '[列表]标题+详情', '1,9', 'News', 'Index', '0', '0', '1');
INSERT INTO `tp_model` VALUES ('10', '[列表]招聘岗位', '1,2,6,10,12,13', 'News', 'Index', '1', '0', '1');
INSERT INTO `tp_model` VALUES ('11', '[列表]标题+副标题+摘要+图片', '1,2,6,10', 'News', 'Index', '1', '0', '1');
INSERT INTO `tp_model` VALUES ('12', '[单]标题+副标题+图片', '1,2,10', 'Single', 'Index', '1', '0', '1');
INSERT INTO `tp_model` VALUES ('13', '[列表]标题+摘要+图片+推荐', '1,3,6,10', 'News', 'Index', '1', '0', '1');
INSERT INTO `tp_model` VALUES ('14', '[列表]标题+图片', '1,5,10', 'News', 'Index', '1', '0', '1');
INSERT INTO `tp_model` VALUES ('15', '[单]标题+摘要+详情+图片', '1,6,9,10', 'News', 'Single', '1', '0', '1');
INSERT INTO `tp_model` VALUES ('16', '[列表]广告位', '1,6,10', 'News', 'Index', '1', '0', '1');
INSERT INTO `tp_model` VALUES ('1', '[列表]新闻列表', '1,3,7,8,9,10,13', 'News', 'Index', '1', '0', '1');

-- ----------------------------
-- Table structure for tp_news
-- ----------------------------
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
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_news
-- ----------------------------
INSERT INTO `tp_news` VALUES ('1', '0', '5', '13', '0', '0', '1', '', '', '', null, '/Uploads/image/20200615/2020061506253886.jpg', '', '', '', '', '', '', '', '', '', '', null, null, '1', '0', '0', '1', '0', '1592202339');
INSERT INTO `tp_news` VALUES ('2', '0', '5', '13', '0', '0', '2', '', '', '', null, '/Uploads/image/20200615/2020061506255073.jpg', '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', '0', '1', '0', '1592202351');
INSERT INTO `tp_news` VALUES ('3', '0', '5', '13', '0', '0', '3', '', '', '', null, '/Uploads/image/20200615/2020061506260290.jpg', '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', '0', '1', '0', '1592202363');
INSERT INTO `tp_news` VALUES ('53', '0', '1', '6', '0', '0', '公司简介', '', '', null, '<p>\r\n	公司本着“一切为用户着想”的经营方针，不仅在空调、冷库、锅炉、地暖、热水器市场上建立了良好\r\n的信誉，并在家电维护、保养方面有着广大市民的好评。以客户需要为中心、以市场需求为导向、以高质量产品为目标、以服务为后盾，现已广泛应用于各行各业，现代化高科技湿度空气净化控制技术为您创造高品位的生活和工作空间。\r\n</p>\r\n<p>\r\n	代化高科技湿度空气净化控制技术为您创造高品位的生活和工作空间。 公司本着“一切为用户着想”的经营方针，不仅在空调、冷库、锅炉、地暖、热水器市场上建立了良好的信誉，并在家电维护、保养方面有着广大市民的好评。以客户需要为中心、以市场需求为导向、以高质量产品为目标、以服务为后盾，现已广泛应用于各行各业，现代化高科技湿度空气净化控制技术为您创造高品位的生活和工作空间。的好评。以客户需要为中心、以市场需求为导向、以高质量产品为目户需要为中心\r\n</p>', '/Uploads/image/20200619/2020061903445723.jpg', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '0', '1', '0', '1592538298');
INSERT INTO `tp_news` VALUES ('7', '0', '1', '7', '0', '0', '合法合规', '', '', '在公司发展上坚决遵守相关法律规定与规章制度是我们一贯做事的准则。', null, '', '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', '0', '1', '0', '1592358044');
INSERT INTO `tp_news` VALUES ('8', '0', '1', '7', '0', '0', '科技创新', '', '', '以积极的态度迎接和了解行业技术与市场的快速变化，迎合市场，提前布局是好活倡导的企业精神。', null, '', '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', '0', '1', '0', '1592358054');
INSERT INTO `tp_news` VALUES ('9', '0', '1', '7', '0', '0', '实诚守信', '', '', '诚实是我们的基因，诚实正直，言行坦荡是我们做人做事的标准。', null, '', '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', '0', '1', '0', '1592358063');
INSERT INTO `tp_news` VALUES ('10', '0', '1', '7', '0', '0', '客户至上', '', '', '客户作为我们的衣食父母，我们的发展首先要想到的就是将客户的需求和体验放在首位。', null, '', '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', '0', '1', '0', '1592358074');
INSERT INTO `tp_news` VALUES ('11', '0', '1', '8', '0', '0', '企业荣誉名称', '', '', null, null, '/Uploads/image/20200617/2020061701414576.jpg', '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', '0', '1', '0', '1592358106');
INSERT INTO `tp_news` VALUES ('12', '0', '1', '8', '0', '0', '企业荣誉名称', '', '', null, null, '/Uploads/image/20200617/2020061701420410.jpg', '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', '0', '1', '0', '1592358125');
INSERT INTO `tp_news` VALUES ('13', '0', '1', '8', '0', '0', '企业荣誉名称', '', '', null, null, '/Uploads/image/20200617/2020061701420410.jpg', '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', '0', '1', '0', '1592358126');
INSERT INTO `tp_news` VALUES ('14', '0', '1', '8', '0', '0', '企业荣誉名称', '', '', null, null, '/Uploads/image/20200617/2020061701420410.jpg', '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', '0', '1', '0', '1592358126');
INSERT INTO `tp_news` VALUES ('15', '0', '1', '8', '0', '0', '企业荣誉名称', '', '', null, null, '/Uploads/image/20200617/2020061701420410.jpg', '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', '0', '1', '0', '1592358126');
INSERT INTO `tp_news` VALUES ('16', '0', '1', '8', '0', '0', '企业荣誉名称', '', '', null, null, '/Uploads/image/20200617/2020061701420410.jpg', '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', '0', '1', '0', '1592358126');
INSERT INTO `tp_news` VALUES ('17', '0', '1', '8', '0', '0', '企业荣誉名称', '', '', null, null, '/Uploads/image/20200617/2020061701420410.jpg', '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', '0', '1', '0', '1592358126');
INSERT INTO `tp_news` VALUES ('18', '0', '1', '8', '0', '0', '企业荣誉名称', '', '', null, null, '/Uploads/image/20200617/2020061701420410.jpg', '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', '0', '1', '0', '1592358126');
INSERT INTO `tp_news` VALUES ('19', '0', '1', '9', '0', '0', '博世', '', '', null, null, '/Uploads/image/20200617/2020061701460714.jpg', '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', '0', '1', '0', '1592358368');
INSERT INTO `tp_news` VALUES ('20', '0', '1', '9', '0', '0', '利勃海尔', '', '', null, null, '/Uploads/image/20200617/2020061701454663.jpg', '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', '0', '1', '0', '1592358348');
INSERT INTO `tp_news` VALUES ('21', '0', '1', '9', '0', '0', '斯麦格', '', '', null, null, '/Uploads/image/20200617/2020061701453171.jpg', '', '', '', '', '', '', '', '', '', '', null, null, '12', '0', '0', '1', '0', '1592358332');
INSERT INTO `tp_news` VALUES ('22', '0', '1', '9', '0', '0', '东芝', '', '', null, null, '/Uploads/image/20200617/2020061701450147.jpg', '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', '0', '1', '0', '1592358302');
INSERT INTO `tp_news` VALUES ('23', '0', '1', '9', '0', '0', '倍科', '', '', null, '美诺', '/Uploads/image/20200617/2020061701443598.jpg', '', '', '', '', '', '', '', '', '', '', '美诺', '美诺', '1', '0', '0', '1', '0', '1592477134');
INSERT INTO `tp_news` VALUES ('24', '0', '1', '9', '0', '0', '美诺', '', '', null, '美诺', '/Uploads/image/20200617/2020061701423464.jpg', '', '', '', '', '', '', '', '', '', '', '美诺', '美诺', '2', '0', '0', '1', '0', '1592477128');
INSERT INTO `tp_news` VALUES ('25', '0', '2', '10', '0', '0', '酒柜维修', '', '', '发展理念.赢得客户认可和信任.目前上海同类服务行业中是有知名度的企业之一我们全体控制技术为\r\n                    您创造同类服务行业中是有知名度的企公司本着“一切为用户着想”的经营方针，不仅在空调、冷\r\n                    库、锅炉、地暖、热水器市场上建立了良好的信誉，并在家电维护、保养方面有着广大市民的好\r\n                    评。以客户需要为中心、以市场需求为导向、以高质量产品为目标', null, '/Uploads/image/20200617/2020061701431393.jpg', '/Uploads/image/20200617/2020061703230541.png', '', '', '', '', '', '', '', '', '', null, null, '0', '1', '0', '1', '0', '1592376783');
INSERT INTO `tp_news` VALUES ('26', '0', '2', '10', '0', '0', '冰箱维修', '', '', '展理念.赢得客户认可和信任.目前上海同类服务行业中是有知名度的企业之一我们全体控制技术为\r\n                    您创造同类服务行业中是有知名度的企公司本着“一切为用户着想”的经营方针，不仅在空调、冷\r\n                    库、锅炉、地暖、热水器市场上建立了良好的信誉，并在家电维护、保养方面有着广大市民的好\r\n                    评。以客户需要为中心、以市场需求为导向、以高质量产品为目标', null, '/Uploads/image/20200617/2020061701433426.jpg', '/Uploads/image/20200617/2020061703225357.png', '', '', '', '', '', '', '', '', '', null, null, '0', '1', '0', '1', '0', '1592376779');
INSERT INTO `tp_news` VALUES ('27', '0', '2', '10', '0', '0', '煤气灶', '', '', '发展理念.赢得客户认可和信任.目前上海同类服务行业中是有知名度的企业之一我们全体控制技术为\r\n                    您创造同类服务行业中是有知名度的企公司本着“一切为用户着想”的经营方针，不仅在空调、冷\r\n                    库、锅炉、地暖、热水器市场上建立了良好的信誉，并在家电维护、保养方面有着广大市民的好\r\n                    评。以客户需要为中心、以市场需求为导向、以高质量产品为目标', null, '/Uploads/image/20200617/2020061701435779.jpg', '/Uploads/image/20200617/2020061703223743.png', '', '', '', '', '', '', '', '', '', null, null, '0', '1', '0', '1', '0', '1592376775');
INSERT INTO `tp_news` VALUES ('28', '0', '2', '10', '0', '0', '洗衣机维修', '', '', '发展理念.赢得客户认可和信任.目前上海同类服务行业中是有知名度的企业之一我们全体控制技术为\r\n                    您创造同类服务行业中是有知名度的企公司本着“一切为用户着想”的经营方针，不仅在空调、冷\r\n                    库、锅炉、地暖、热水器市场上建立了良好的信誉，并在家电维护、保养方面有着广大市民的好\r\n                    评。以客户需要为中心、以市场需求为导向、以高质量产品为目标', null, '/Uploads/image/20200617/2020061701441819.jpg', '/Uploads/image/20200617/2020061703195958.png', '', '', '', '', '', '', '', '', '', null, null, '0', '1', '0', '1', '0', '1592376770');
INSERT INTO `tp_news` VALUES ('29', '0', '1', '9', '0', '0', '嘉格纳', '', '', null, '嘉格纳', '/Uploads/image/20200617/2020061701463672.jpg', '', '', '', '', '', '', '', '', '', '', '嘉格纳', '嘉格纳', '17', '0', '0', '1', '0', '1592477120');
INSERT INTO `tp_news` VALUES ('32', '0', '3', '11', '0', '0', '空调维修高峰来临 市商务委公布家电维修正规军名单', '', '', null, '<p style=\"text-indent:30px;\">\r\n	中国航空工业集团公司（简称：中航工业）由原中国航空工业第一集团公司、中国航空工业第二集团公司重组整合而成，是一家由\r\n国家出资设立，受中央管理的国有大型企业。集团公司实行母子公司（事业部）管理体制，注册资本640，拥有上市公司21家，其中\r\n3家在香港上市。中航工业是首家进入世界500强的中国航空制造企业，2013年财富世界500强排行榜第212位。\r\n</p>\r\n<p align=\"center\">\r\n	<img src=\"images/hzpp_pic1.jpg\" /> \r\n</p>\r\n<p style=\"text-indent:30px;\">\r\n	高科技的一体化准入终端安全管理平台，通过对总部网络部署ASM入网规范管理系统，整个方案基于策略路由（PBR）准入控制\r\n技术。设备经过客户端安全检查合格后方本方案采用杭州盈高科技的一体化准入终端安全管理平台，通过对总部网络部署ASM入网规\r\n范管理系统，整个方案基于策略路由（PBR）准入控制技术。设备经过客户端安全检查合格后方可入网理员审核批准后才能够接入网\r\n络，并进行终端使用规范管理，整个网络边界明确，入网流程清晰，保障使用安全。M入网规范管理系统审核批准后才能够接入网络，\r\n并进行终端使用规范管理，整个网络边界明确，入网流程清晰，保障使用安全。M入网规范管理系统\r\n</p>', '/Uploads/image/20200617/2020061703340030.jpg', '', '', '', '', '', '', '', '', '臣成', '', '空调维修高峰来临 市商务委公布家电维修正规军名单', '空调维修高峰来临 市商务委公布家电维修正规军名单', '9', '1', '0', '1', '0', '1592530672');
INSERT INTO `tp_news` VALUES ('33', '0', '3', '11', '0', '0', '网搜家电维修不靠谱的还挺多 九成投诉维权无门', '', '', null, '<p style=\"text-indent:30px;\">\r\n	中国航空工业集团公司（简称：中航工业）由原中国航空工业第一集团公司、中国航空工业第二集团公司重组整合而成，是一家由\r\n国家出资设立，受中央管理的国有大型企业。集团公司实行母子公司（事业部）管理体制，注册资本640，拥有上市公司21家，其中\r\n3家在香港上市。中航工业是首家进入世界500强的中国航空制造企业，2013年财富世界500强排行榜第212位。\r\n</p>\r\n<p align=\"center\">\r\n	<img src=\"images/hzpp_pic1.jpg\" /> \r\n</p>\r\n<p style=\"text-indent:30px;\">\r\n	高科技的一体化准入终端安全管理平台，通过对总部网络部署ASM入网规范管理系统，整个方案基于策略路由（PBR）准入控制\r\n技术。设备经过客户端安全检查合格后方本方案采用杭州盈高科技的一体化准入终端安全管理平台，通过对总部网络部署ASM入网规\r\n范管理系统，整个方案基于策略路由（PBR）准入控制技术。设备经过客户端安全检查合格后方可入网理员审核批准后才能够接入网\r\n络，并进行终端使用规范管理，整个网络边界明确，入网流程清晰，保障使用安全。M入网规范管理系统审核批准后才能够接入网络，\r\n并进行终端使用规范管理，整个网络边界明确，入网流程清晰，保障使用安全。M入网规范管理系统\r\n</p>', '/Uploads/image/20200617/2020061703343118.jpg', '', '', '', '', '', '', '', '', '臣成', '', '网搜家电维修不靠谱的还挺多 九成投诉维权无门', '网搜家电维修不靠谱的还挺多 九成投诉维权无门', '4', '1', '0', '1', '0', '1592530650');
INSERT INTO `tp_news` VALUES ('42', '0', '3', '11', '0', '0', '部分家电维修要“躲雨”', '', '', null, '<span style=\"font-family:\" font-size:14px;white-space:normal;background-color:#ebeff0;\"=\"\">日前，家住茶南的吕先生向服务网报修空调移机，并约定当天上午9点半上门。可上午一直阴雨不断，金陵晚报旗下服务网工作人员赶紧给吕先生打了个电话，约定移机顺延到下午2点。</span><br style=\"font-family:\" white-space:normal;background-color:#ebeff0;\"=\"\">\r\n<span style=\"font-family:\" font-size:14px;white-space:normal;background-color:#ebeff0;\"=\"\">　　但吕先生也碰到个为难事：移机是因为搬家，他请来了搬家公司，若是移机推迟了，吕先生得额外承担运输费。听明缘由，本着为客户着想，服务网承诺当日移机免去客户的运输费。</span><br style=\"font-family:\" white-space:normal;background-color:#ebeff0;\"=\"\">\r\n<span style=\"font-family:\" font-size:14px;white-space:normal;background-color:#ebeff0;\"=\"\">　　为什么下雨天不能空调移机呢？</span><br style=\"font-family:\" white-space:normal;background-color:#ebeff0;\"=\"\">\r\n<span style=\"font-family:\" font-size:14px;white-space:normal;background-color:#ebeff0;\"=\"\">　　据专业人士介绍，一方面师傅移外机时会淋雨，加之机体湿滑，威胁到师傅安全；另一方面，从空调本身考虑，拆机需要收氟利昂，室内机与室外机的连接管一旦淋雨，安装时容易产生冰堵，从而影响制冷效果。</span><br style=\"font-family:\" white-space:normal;background-color:#ebeff0;\"=\"\">\r\n<span style=\"font-family:\" font-size:14px;white-space:normal;background-color:#ebeff0;\"=\"\">　　同时，油烟机清洗也不宜雨天进行。师傅通常都将油烟机拿到室外清洗。若遇大雨，自然无法正常操作。另外，改道时师傅需沿着室外墙打管卡，下雨天也是很难进行的。因此，遇到类似情况，服务网还请市民多多谅解。</span><br style=\"font-family:\" white-space:normal;background-color:#ebeff0;\"=\"\">\r\n<span style=\"font-family:\" font-size:14px;white-space:normal;background-color:#ebeff0;\"=\"\">　　咨询电话：</span><br style=\"font-family:\" white-space:normal;background-color:#ebeff0;\"=\"\">\r\n<span style=\"font-family:\" font-size:14px;white-space:normal;background-color:#ebeff0;\"=\"\">　　025-84686500</span>', '/Uploads/image/20200619/2020061901382291.jpg', '', '', '', '', '', '', '', '', '臣成', '', '部分家电维修要“躲雨”', '日前，家住茶南的吕先生向服务网报修空调移机，并约定当天上午9点半上门。可上午一直阴雨不断，金陵晚报旗下服务网工作人员赶紧给吕先生打了个电话，约定移机顺延到下午2点', '3', '1', '0', '1', '0', '1592532633');
INSERT INTO `tp_news` VALUES ('36', '0', '14', '15', '0', '0', '成功案例名称', '', '', null, '成功案例名称', '/Uploads/image/20200617/2020061706561376.jpg', '', '', '', '', '', '', '', '', '', '', '成功案例名称', '成功案例名称', '0', '0', '0', '1', '0', '1592376974');
INSERT INTO `tp_news` VALUES ('37', '0', '14', '15', '0', '0', '品牌空调维修实例', '', '', null, '<p style=\"margin-top:26px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\"><span class=\"bjh-strong\" style=\"font-size:18px;font-weight:700;\">品牌：</span>海尔&nbsp;<span class=\"bjh-strong\" style=\"font-size:18px;font-weight:700;\">空调型号：</span>KFR-28GW/BPA</span>\r\n</p>\r\n<p style=\"margin-top:22px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\"><span class=\"bjh-strong\" style=\"font-size:18px;font-weight:700;\">故障现象：</span>开机运行20秒后，电源指示灯和定时指示灯交变闪烁，运行灯亮。停机后，再次启动，运行20秒后，运转灯灭。3分钟后，再次启动运行，20秒后，运转灯亮，电源和定时灯闪烁3次后熄灭。</span>\r\n</p>\r\n<p style=\"margin-top:22px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\"><span class=\"bjh-strong\" style=\"font-size:18px;font-weight:700;\">故障原因：</span>根据故障现象判断，空调故障为DC（直流）电流过高。导致故障发生有以下几种情况：（1)外机功率模块供电电压过低；(2)功率模块高负载强制运转；(3)电源电压过低；(4)室内机控制板或压缩机功率模块故障；(5)压缩机故障。</span>\r\n</p>\r\n<p style=\"margin-top:26px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\"><span class=\"bjh-strong\" style=\"font-size:18px;font-weight:700;\">检修步骤及故障排除：</span>根据以上几种故障原因，逐一进行排查；测空调供电电源电压符合空调使用要求，检查不存在安装问题，更换室内机电脑板后试机，故障依旧。测整流桥（外机主板）向功率模块输出端电压为310V正常；</span>\r\n</p>\r\n<p style=\"margin-top:26px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\"><span class=\"bjh-strong\" style=\"font-size:18px;font-weight:700;\"><span class=\"bjh-strong\">品牌：</span></span>海尔<span class=\"bjh-strong\" style=\"font-size:18px;font-weight:700;\"><span class=\"bjh-strong\">空调型号：</span></span>KFR-28GW/BPA</span>\r\n</p>\r\n<p style=\"margin-top:22px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\"><span class=\"bjh-strong\" style=\"font-size:18px;font-weight:700;\">故障现象：</span>开机30—40分钟后，室内、外机停止工作，电源灯灭，定时灯闪烁，运转灯也灭，停机2小时后能正常开机，但过30-40分钟后，故障又重复出现。<span class=\"bjh-br\"></span></span>\r\n</p>\r\n<p style=\"margin-top:22px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\"><span class=\"bjh-strong\" style=\"font-size:18px;font-weight:700;\">故障原因：</span>根据故障现象描述判断，此故障为压缩机排气管热敏电阻不良或排气管超温。正常情况下当排气管温度超过120℃时，排气管热敏电阻阻值降低产生的变量电信号，芯片感受到这个电信号后发出指令使保护电路动作，切断室内、外机工作电源空调停止工作。但当压缩机排气管热敏电阻变值或短(断)路时，也会产生该故障现象。</span>\r\n</p>', '/Uploads/image/20200617/2020061707064737.jpg', '', '', '', '', '', '', '', '', '', '', '品牌空调维修实例', '目前市场上受欢迎的品牌，购买量比较大的变频空调的维修实例，希望能更贴近大家的需求', '3', '0', '0', '1', '0', '1592532461');
INSERT INTO `tp_news` VALUES ('38', '0', '14', '15', '0', '0', '美的挂烫机原理与维修实例', '', '', null, '<pre style=\"background-color:#FFFFFF;font-family:宋体;font-size:12pt;\">\r\n<p style=\"margin-top:0px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\">在生活越来越好的今天很多人家里都必备了挂烫机，对于上班一族的我们更是离不开挂烫机，可是有时候挂烫机会出点小问题可以自己动手解决的时候就无须送修理店，又培养了自己的动手能力也会省下一笔不小的维修费。嘿嘿，不闲聊了 进入正题：</span> \r\n</p>\r\n\r\n<p style=\"margin-top:22px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\">今收到一个白领的一台挂烫机，用户反应以前用蒸汽量不够，烫出来的衣服不平整。现在通电又显示竟然热气都不出了，此用户一直抱怨还是买的品牌的机器怎么没用几年就坏了········（此处省略）</span> \r\n</p>\r\n\r\n<p style=\"margin-top:26px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\">当着用户的面，试机通电正常，按到功能键纤维上机器无反应不加热，马上拆开机器用万用表检测后发现1.0uf电容失效不工作。</span> \r\n</p>\r\n</pre>', '/Uploads/image/20200617/2020061706570881.jpg', '', '', '', '', '', '', '', '', '', '', '美的挂烫机原理与维修实例', '在生活越来越好的今天很多人家里都必备了挂烫机,对于上班一族的我们更是离不开挂烫机,可是有时候挂烫机会出点小问题', '0', '1', '0', '1', '0', '1592532505');
INSERT INTO `tp_news` VALUES ('39', '0', '14', '15', '0', '0', '分享多品牌变频空调维修实例', '', '', null, '<p style=\"margin-top:0px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\">变频空调在市面上很受大家的欢迎，它有节能，静音，体感舒适等优势，很多朋友都选择购买变频空调，但是对于变频空调的维修来说，维修次数多而且维修费用高，所以今天小编特意为大家整理目前市场上最受欢迎的品牌，购买量大的变频空调的检修实例，希望更贴近大家的需求，并且对大家有帮助。</span> \r\n</p>\r\n<p style=\"margin-top:26px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\"><span class=\"bjh-strong\" style=\"font-size:18px;font-weight:700;\">品牌：</span>格力<span class=\"bjh-strong\" style=\"font-size:18px;font-weight:700;\">型号：</span>KFR-50LW/EF</span> \r\n</p>\r\n<p style=\"margin-top:22px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\"><span class=\"bjh-strong\" style=\"font-size:18px;font-weight:700;\"><span class=\"bjh-strong\">故障现象：</span></span>不启动，电源灯亮、压缩机工作指示灯不亮、室外机不启动，有时偶尔启动一下，很快就停机，不能工作。</span> \r\n</p>\r\n<p style=\"margin-top:22px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\"><span class=\"bjh-strong\" style=\"font-size:18px;font-weight:700;\">检测检修：</span>因为该机型没有故障自诊断功能，不显示故障代码。所以先用遥控器将工作模式调到送风状态，按风速键，风速大小能调，说明室内CPU正常，<span class=\"bjh-strong\" style=\"font-size:18px;font-weight:700;\">重点检查室外机。</span>分析故障现象，压缩机指示灯不亮，是处于保护状态，而空调有时能启动一下，分析可能有接触不良情况。</span> \r\n</p>\r\n<p style=\"margin-top:26px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\">把所有插头重插了一遍，并用万用表测查发现有一个瓷片电容C101因引脚过长，线路板在密封时没有封住，长期氧化使其一端引脚锈断。此电容为通讯线路抗干扰电容，用同型号电容更换后。开启空调试运行，但随着工作电流的加大，室内的空调电源空气开关发出“吱吱”声响，判断空气开关有接触不良现象，由此现象可以判断，这才是空调不工作的真正原因。因C101电容的损坏使通讯线路抗干扰能力下降，由于控制空调电源的空气开关接触不良产生杂波干扰CPU，从而产生上述空调故障，更换空气开关后故障排除。</span> \r\n</p>', '/Uploads/image/20200617/2020061707063211.jpg', '', '', '', '', '', '', '', '', '', '', '分享多品牌变频空调维修实例', '变频空调在市面上很受大家的欢迎，它有节能，静音，体感舒适等优势，很多朋友都选择购买变频空调，但是对于变频空调的维修来说，维修次数多而且维修费用高', '1', '0', '0', '1', '0', '1592532487');
INSERT INTO `tp_news` VALUES ('34', '0', '3', '11', '0', '0', '家电维修垄断必须打破，六大核心问题阻挠市场发展', '', '', null, '<p style=\"text-indent:30px;\">\r\n	中国航空工业集团公司（简称：中航工业）由原中国航空工业第一集团公司、中国航空工业第二集团公司重组整合而成，是一家由\r\n国家出资设立，受中央管理的国有大型企业。集团公司实行母子公司（事业部）管理体制，注册资本640，拥有上市公司21家，其中\r\n3家在香港上市。中航工业是首家进入世界500强的中国航空制造企业，2013年财富世界500强排行榜第212位。\r\n</p>\r\n<p align=\"center\">\r\n	<img src=\"images/hzpp_pic1.jpg\" /> \r\n</p>\r\n<p style=\"text-indent:30px;\">\r\n	高科技的一体化准入终端安全管理平台，通过对总部网络部署ASM入网规范管理系统，整个方案基于策略路由（PBR）准入控制\r\n技术。设备经过客户端安全检查合格后方本方案采用杭州盈高科技的一体化准入终端安全管理平台，通过对总部网络部署ASM入网规\r\n范管理系统，整个方案基于策略路由（PBR）准入控制技术。设备经过客户端安全检查合格后方可入网理员审核批准后才能够接入网\r\n络，并进行终端使用规范管理，整个网络边界明确，入网流程清晰，保障使用安全。M入网规范管理系统审核批准后才能够接入网络，\r\n并进行终端使用规范管理，整个网络边界明确，入网流程清晰，保障使用安全。M入网规范管理系统\r\n</p>', '/Uploads/image/20200617/2020061703345329.jpg', '', '', '', '', '', '', '', '', '臣成', '', '家电维修垄断必须打破，六大核心问题阻挠市场发展', '家电维修垄断必须打破，六大核心问题阻挠市场发展', '7', '1', '0', '1', '0', '1592530634');
INSERT INTO `tp_news` VALUES ('35', '0', '3', '11', '0', '0', '家电维修人员也能有假？遇到这些情况你可要注意了', '', '', null, '<p style=\"text-indent:30px;\">\r\n	中国航空工业集团公司（简称：中航工业）由原中国航空工业第一集团公司、中国航空工业第二集团公司重组整合而成，是一家由\r\n国家出资设立，受中央管理的国有大型企业。集团公司实行母子公司（事业部）管理体制，注册资本640，拥有上市公司21家，其中\r\n3家在香港上市。中航工业是首家进入世界500强的中国航空制造企业，2013年财富世界500强排行榜第212位。\r\n</p>\r\n<p align=\"center\">\r\n	<img src=\"images/hzpp_pic1.jpg\" /> \r\n</p>\r\n<p style=\"text-indent:30px;\">\r\n	高科技的一体化准入终端安全管理平台，通过对总部网络部署ASM入网规范管理系统，整个方案基于策略路由（PBR）准入控制\r\n技术。设备经过客户端安全检查合格后方本方案采用杭州盈高科技的一体化准入终端安全管理平台，通过对总部网络部署ASM入网规\r\n范管理系统，整个方案基于策略路由（PBR）准入控制技术。设备经过客户端安全检查合格后方可入网理员审核批准后才能够接入网\r\n络，并进行终端使用规范管理，整个网络边界明确，入网流程清晰，保障使用安全。M入网规范管理系统审核批准后才能够接入网络，\r\n并进行终端使用规范管理，整个网络边界明确，入网流程清晰，保障使用安全。M入网规范管理系统\r\n</p>', '/Uploads/image/20200617/2020061703355385.jpg', '', '', '', '', '', '', '', '', '臣成', '', '家电维修人员也能有假？遇到这些情况你可要注意了', '家电维修人员也能有假？遇到这些情况你可要注意了', '12', '1', '0', '1', '0', '1592530617');
INSERT INTO `tp_news` VALUES ('43', '0', '3', '11', '0', '0', '当心！家电维修谨防山寨400电话坑人', '', '', null, '<p style=\"margin-top:0px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\">中国消费者报西安讯(记者徐文智)近年来，捆绑400假网站骗取家电维修费、打400报修电话假冒维修工上门，致使消费者上当受骗时有发生，严重损害了消费者的合法权益。近日，陕西省西安市消费者协会发布消费警示，提醒广大消费者，家电维修时，要谨防山寨400开头的电话号码欺诈行为。</span> \r\n</p>\r\n<p style=\"margin-top:22px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\">家用电器出现故障时，不少消费者稍不留神就会误入“山寨售后”和“黑维修”的坑。“山寨售后”和“黑维修”是借用网络或电话查询平台进行宣传，宣称是品牌的售后电话为消费者提供维修服务，但实际上是不良商家或不法分子的诈骗陷阱。他们常见伎俩是冒充行家、故弄玄虚、无病乱修、小病大修、暗箱操作、以次充好、漫天要价等，质量差、隐患多、风险大，造成的后果往往是和解无门，调解无路。</span> \r\n</p>\r\n<p style=\"margin-top:22px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\">西安市消协提醒消费者，家电需要维修时，正确的做法是通过产品说明书、品牌官网查找，或通过品牌实体销售店咨询售后服务电话。此外，消费者还可登录中国消费者协会官网，点击“售后服务电话查验宝”，在搜索栏输入品牌或厂家名称，点击搜索即可查询相应品牌的售后服务电话。</span> \r\n</p>', '/Uploads/image/20200619/2020061901390386.jpg', '', '', '', '', '', '', '', '', '臣成', '', '当心！家电维修谨防山寨400电话坑人', '中国消费者报西安讯(记者徐文智)近年来，捆绑400假网站骗取家电维修费、打400报修电话假冒维修工上门，致使消费者上当受骗时有发生，严重损害了消费者的合法权益', '8', '1', '0', '1', '0', '1592532622');
INSERT INTO `tp_news` VALUES ('44', '0', '3', '11', '0', '0', '家电维修互联网平台，创新发展新时代家电后服务模式', '', '', null, '<p style=\"margin-top:0px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\">家电维修行业，曾经的朝阳产业现在被无数从业者以及业外人士唱衰，认为它已经从朝阳行业转变成了夕阳行业。</span> \r\n</p>\r\n<p style=\"margin-top:22px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\">不可否认的是，家电维修行业确实不如七八十年代，中国家用电器刚刚兴起的时候，那会儿修一台收音机，收费5元;修一台电风扇，收费15元。但是当年的物价是：一斤白菜2分，一个鸡蛋5分，一斤猪肉价格在7毛左右，家电维修师傅的收入十分可观。不仅如此，旧时代懂电器会修广播的人凤毛麟角，是一般人心中仰不可及的人才，家电维修人的社会地位也可谓高高在上。</span> \r\n</p>\r\n<p style=\"margin-top:22px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\">而现在，伴随着购买成本的降低，家用电器的更新换代已然不再是稀罕事，换新也花不了几个钱，家电用户都认为修的不如买的，维修市场不景气；而且家电维修人数不断增多，维修人员再也不是大家心目中的“高技术”人才，自然而然，维修师傅的地位就逐步降低。</span> \r\n</p>\r\n<p style=\"margin-top:22px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\">但是仅凭这个就认定家电维修行业是夕阳产业未免太过武断。社会在不断发展，人们越来越追求更高品质的生活，更高价值的享受。这样发展就会家用电器用量只增不减，甚至除了黑电、白电、厨卫电器之外，还涌现了许多健康生活小家电等等，有电器就有市场，有市场就要需求。其次，高品质的生活同时带来了家电服务定义的转变，现在的维修行业不仅仅局限于开店维修、坐等上门，在新时代，<span class=\"bjh-strong\" style=\"font-size:18px;font-weight:700;\">家电服务已经向互联网平台服务转变。</span></span> \r\n</p>\r\n<p style=\"margin-top:22px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\">维修有市场，行业在变革，谁还敢大言不惭说家电行业是夕阳行业？估计都是一些故步自封、坐井观天，至今还没看到市场走向，仍旧局限在自身思维模式里的人吧~</span> \r\n</p>\r\n<p style=\"margin-top:22px;margin-bottom:0px;padding:0px;font-size:16px;line-height:24px;color:#333333;text-align:justify;font-family:arial;white-space:normal;background-color:#FFFFFF;\">\r\n	<span class=\"bjh-p\">互联网在中国已经发展了二十多年，除了一些贫困山区，几乎已经做到100%覆盖全国。互联网的发展迎来了万物互联的时代，万物皆可通过一个小小的信号相互连接，让生活更加便利，现在的人都离不开互联网。家电服务行业一些行业引领者洞察先机，成立第三方家电服务线上平台为全国更多的用户，做更便捷的服务。</span> \r\n</p>', '/Uploads/image/20200619/2020061902050795.jpg', '', '', '', '', '', '', '', '', '臣成', '', '家电维修互联网平台，创新发展新时代家电后服务模式', '家电维修行业，曾经的朝阳产业现在被无数从业者以及业外人士唱衰，认为它已经从朝阳行业转变成了夕阳行业。', '16', '1', '0', '1', '0', '1592532607');
INSERT INTO `tp_news` VALUES ('47', '0', '5', '16', '0', '0', '首页关于我们', '', '', null, '123', '', '123', '', '', '', '', '', '', '', '', '', null, null, '0', '0', '0', '0', '0', '0');
INSERT INTO `tp_news` VALUES ('48', '0', '5', '16', '0', '0', '首页关于我们', '', '', null, '213', '', '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for tp_role
-- ----------------------------
DROP TABLE IF EXISTS `tp_role`;
CREATE TABLE `tp_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '角色表',
  `role_name` varchar(20) NOT NULL DEFAULT '' COMMENT '角色名称',
  `role_auth_ids` varchar(128) NOT NULL DEFAULT '' COMMENT '权限ids 1,2,5',
  `role_auth_ac` varchar(3000) DEFAULT '' COMMENT '模块-操作',
  `sendtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '审核状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_role
-- ----------------------------
INSERT INTO `tp_role` VALUES ('1', '超级管理员', '', '', '1513227497', '1');
INSERT INTO `tp_role` VALUES ('2', 'FASDFAS', '23,6', '', '1588919463', '1');

-- ----------------------------
-- Table structure for tp_sort
-- ----------------------------
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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_sort
-- ----------------------------
INSERT INTO `tp_sort` VALUES ('1', '2', '0', '关于我们', 'ABOUT US', '/Uploads/image/20200618/2020061810350796.jpg', '', '', '', '', '', '0', '3', '关于我们', '关于我们', '公司本着“一切为用户着想”的经营方针，不仅在空调、冷库、锅炉、地暖、热水器市场上建立了良好的信誉，并在家电维护、保养方面有着广\r\n                    大市民的好评。以客户需要为中心、以市场需求为导向、以高质量产品为目标、以服务为后盾', '', '', 'News', 'News', 'Single', '', '0', '0', '0', '1', '5', '1592533878');
INSERT INTO `tp_sort` VALUES ('2', '13', '0', '服务支持', 'SERVICE SUPPORT', '/Uploads/image/20200618/2020061810353030.jpg', '', '', '', '460*340', '', '1', '3', '', '', '', '', '', 'News', 'News', 'Index', '', '0', '0', '0', '1', '10', '1592533933');
INSERT INTO `tp_sort` VALUES ('3', '1', '0', '新闻中心', 'NEWS  CENTER', '/Uploads/image/20200618/2020061810360248.jpg', '', '', '', '215*145', '', '1', '3', '新闻中心', '新闻中心', '新闻中心', '', '', 'News', 'News', 'Index', '', '0', '0', '0', '1', '15', '1592534001');
INSERT INTO `tp_sort` VALUES ('4', '2', '0', '联系我们', '', '/Uploads/image/20200618/2020061810362032.jpg', '', '', '', '', '', '0', '3', '联系我们', '联系我们', '联系我们', '', '', 'News', 'News', 'Single', '', '0', '0', '0', '1', '20', '1592476581');
INSERT INTO `tp_sort` VALUES ('5', '5', '0', '辅助栏目', '', '', '', '', '', '', '', '1', '3', '', '', '', '', '', 'News', 'News', 'Index', '', '0', '0', '0', '1', '25', '1592201198');
INSERT INTO `tp_sort` VALUES ('6', '1', '1', '公司简介', 'INTRODUCTION', '', '', '', '', '530*380', '', '1', '3', '公司简介', '公司简介', '公司简介', '', '', 'News', 'News', 'Index', '', '0', '0', '0', '1', '30', '1592538206');
INSERT INTO `tp_sort` VALUES ('7', '8', '1', '企业文化', 'CULTURE', '', '', '', '', '', '', '0', '3', '企业文化', '企业文化', '企业文化', '', '', 'News', 'News', 'Index', '', '0', '0', '0', '1', '35', '1592201875');
INSERT INTO `tp_sort` VALUES ('8', '14', '1', '企业荣誉', 'HONOR', '', '', '', '', '350*240', '', '1', '3', '企业荣誉', '企业荣誉', '企业荣誉', '', '', 'News', 'News', 'Index', '', '0', '0', '0', '1', '40', '1592201910');
INSERT INTO `tp_sort` VALUES ('9', '1', '1', '合作品牌', 'COOPERATIVE BRAND', '', '', '', '', '110*45', '', '1', '3', '合作品牌', '合作品牌', '合作品牌', '', '', 'News', 'News', 'Index', '', '0', '0', '0', '1', '45', '1592477105');
INSERT INTO `tp_sort` VALUES ('10', '13', '2', '服务支持', '', '', '', '', '', '460*340,40*40', '', '2', '3', '', '', '', '', '', 'News', 'News', 'Index', '', '0', '0', '0', '1', '50', '1592363980');
INSERT INTO `tp_sort` VALUES ('11', '1', '3', '新闻中心', '', '', '', '', '', '215*145', '', '1', '3', '新闻中心', '新闻中心', '新闻中心', '', '', 'News', 'News', 'Index', '', '0', '0', '0', '1', '55', '1592201971');
INSERT INTO `tp_sort` VALUES ('12', '2', '4', '联系我们', '', '', '', '', '', '', '', '0', '3', '联系我们', '联系我们', '联系我们', '', '', 'News', 'News', 'Single', '', '0', '0', '0', '1', '60', '1592201980');
INSERT INTO `tp_sort` VALUES ('13', '5', '5', '首页轮播图', '', '', '', '', '', '1920*600', '', '1', '3', '', '', '', '', '', 'News', 'News', 'Index', '', '0', '0', '0', '1', '65', '1592202077');
INSERT INTO `tp_sort` VALUES ('14', '1', '0', '成功案例', 'CASE', '/Uploads/image/20200619/2020061903400485.jpg', '', '', '', '150*150', '', '1', '3', '成功案例', '成功案例', '成功案例', '', '', 'News', 'News', 'Index', '', '0', '0', '0', '1', '21', '1592538005');
INSERT INTO `tp_sort` VALUES ('15', '1', '14', '成功案例', 'CASE', '', '', '', '', '150*150', '', '1', '3', '成功案例', '成功案例', '成功案例', '', '', 'News', 'News', 'Index', '', '0', '0', '0', '1', '75', '1592376921');
INSERT INTO `tp_sort` VALUES ('16', '2', '5', '首页关于我们', '', '', '', '', '', '', '', '1', '3', '', '', '', '', '', 'News', 'News', 'Single', '', '0', '0', '0', '0', '80', '1592533387');

-- ----------------------------
-- Table structure for tp_titlepic
-- ----------------------------
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_titlepic
-- ----------------------------

-- ----------------------------
-- Table structure for tp_yzm
-- ----------------------------
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

-- ----------------------------
-- Records of tp_yzm
-- ----------------------------
INSERT INTO `tp_yzm` VALUES ('1', '2', '252492432@qq.com', '498337', '0', '1587452671');
