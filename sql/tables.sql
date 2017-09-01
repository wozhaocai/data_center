CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(32) NOT NULL DEFAULT '1bbd886460827015e5d605ed44252251' COMMENT '真实姓名',  
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `lastlogintime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后登录时间',
  `locktime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '帐号锁定时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户';

CREATE TABLE `menus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父节点id',
  `path` varchar(100) NOT NULL DEFAULT '#' COMMENT '文件路径',
  `child_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '子菜单数目',
  `mlevel` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '级别',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `mtype` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '类型',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '记录创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '记录修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_parent_id` (`parent_id`),
  KEY `idx_mlevel` (`mlevel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='菜单表';

CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '用户组名',
  `description` varchar(200) NOT NULL DEFAULT '' COMMENT '描述',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户组';

CREATE TABLE `user_group_map` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '映射id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `gid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户组id',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_uid_gid` (`uid`,`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户和用户组映射表';

CREATE TABLE `group_menu_map` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '映射id',
  `gid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户组id',
  `mid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '菜单id',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_gid_mid` (`gid`,`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户组菜单映射表';

CREATE TABLE `resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '资源id',
  `source_type` varchar(50) NOT NULL DEFAULT 'table' COMMENT '资源类型',
  `content_type` varchar(50) NOT NULL DEFAULT 'xml' COMMENT '文件类型',
  `service_id` varchar(100) NOT NULL DEFAULT '' COMMENT '服务id',  
  `content` text NOT NULL DEFAULT '' COMMENT '类型内容',  
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_resource` (`service_id`,`source_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='资源';

CREATE TABLE `spider` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `code` varchar(50) NOT NULL DEFAULT 'xml' COMMENT '抓取标识名',
  `spider_url` varchar(100) NOT NULL DEFAULT 'to_base64' COMMENT '抓取网址',
  `description` varchar(100) NOT NULL DEFAULT '' COMMENT '抓取描述',
  `keyword_rule` varchar(100) NOT NULL DEFAULT 'to_base64' COMMENT '关键字匹配规则',
  `save_rule` varchar(100) NOT NULL DEFAULT '' COMMENT '保存规则',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_spider` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='抓取列表';

CREATE TABLE `us_china_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `code` varchar(50) NOT NULL DEFAULT 'xml' COMMENT 'code',  
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_us_china_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='中概股代码表';


D:\wozhaocai\data_center\scripts>php job.php -bdc -tworkflow -sus_china -asave_p
rice
string(5) "<pre>"
array(28) {
  [0]=>
  string(8) "中国铝业" 名称
  [1]=>
  string(7) "18.6500"   现价
  [2]=>
  string(4) "1.30"   涨跌幅
  [3]=>
  string(19) "2017-09-01 08:18:12"   抓取时间点
  [4]=>
  string(6) "0.2400"      涨跌价格
  [5]=>
  string(7) "18.5000"     开盘
  [6]=>
  string(7) "18.9900"     最高价
  [7]=>
  string(7) "18.4000"     最低价
  [8]=>
  string(7) "19.2700"     52周最高价
  [9]=>
  string(6) "8.7700"      52周最低价
  [10]=>
  string(6) "132180"      成交量
  [11]=>
  string(5) "77735"       10日均量
  [12]=>
  string(11) "15109670499"    市值
  [13]=>
  string(4) "0.10"      每股收益
  [14]=>
  string(6) "186.50"     市盈率
  [15]=>
  string(4) "0.00"
  [16]=>
  string(4) "0.00"
  [17]=>
  string(4) "0.00"
  [18]=>
  string(4) "0.00"
  [19]=>
  string(9) "810170000"    股本
  [20]=>
  string(4) "1.00"
  [21]=>
  string(7) "18.6500"    收盘价
  [22]=>
  string(4) "0.00"
  [23]=>
  string(4) "0.00"
  [24]=>
  string(18) "Aug 31 08:00PM EDT"    美东时间
  [25]=>
  string(18) "Aug 31 04:02PM EDT"
  [26]=>
  string(7) "18.4100"    前收盘
  [27]=>
  string(4) "4.00"   收盘成交量
}
string(6) "</pre>"

D:\wozhaocai\data_center\scripts>^A