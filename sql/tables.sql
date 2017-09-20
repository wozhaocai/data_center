# Host: localhost  (Version: 5.5.53)
# Date: 2017-09-10 12:57:14
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "group_menu_map"
#

CREATE TABLE `group_menu_map` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '映射id',
  `gid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户组id',
  `mid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '菜单id',
  `enable` tinyint(3) NOT NULL DEFAULT '1' COMMENT '启用',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_gid_mid` (`gid`,`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户组菜单映射表';

#
# Structure for table "groups"
#

CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '用户组名',
  `description` varchar(200) NOT NULL DEFAULT '' COMMENT '描述',
  `enable` tinyint(3) NOT NULL DEFAULT '1' COMMENT '启用',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户组';

#
# Structure for table "menus"
#

CREATE TABLE `menus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父节点id',
  `path` varchar(100) NOT NULL DEFAULT '#' COMMENT '文件路径',
  `child_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '子菜单数目',
  `mlevel` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '级别',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `mtype` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '类型',
  `css_style` varchar(50) DEFAULT NULL,
  `enable` tinyint(3) NOT NULL DEFAULT '1' COMMENT '启用',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '记录创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '记录修改时间',
  PRIMARY KEY (`id`),
  KEY `idx_parent_id` (`parent_id`),
  KEY `idx_mlevel` (`mlevel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='菜单表';

#
# Structure for table "resource"
#

CREATE TABLE `resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '资源id',
  `source_type` varchar(50) NOT NULL DEFAULT 'table' COMMENT '资源类型',
  `content_type` varchar(50) NOT NULL DEFAULT 'xml' COMMENT '文件类型',
  `service_id` varchar(100) NOT NULL DEFAULT '' COMMENT '服务id',
  `content` text NOT NULL COMMENT '类型内容',
  `enable` tinyint(3) NOT NULL DEFAULT '1' COMMENT '启用',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_resource` (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='资源';

#
# Structure for table "spider"
#

CREATE TABLE `spider` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `code` varchar(50) NOT NULL DEFAULT 'xml' COMMENT '抓取标识名',
  `spider_url` varchar(200) NOT NULL DEFAULT 'to_base64' COMMENT '抓取网址',
  `description` varchar(100) NOT NULL DEFAULT '' COMMENT '抓取描述',
  `keyword_rule` varchar(200) NOT NULL DEFAULT 'to_base64' COMMENT '关键字匹配规则',
  `save_rule` text NOT NULL COMMENT '保存规则',
  `enable` tinyint(3) NOT NULL DEFAULT '1' COMMENT '启用',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_spider` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='抓取列表';

#
# Structure for table "us_china_code"
#

CREATE TABLE `us_china_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `code` varchar(50) NOT NULL DEFAULT '' COMMENT 'code',
  `enable` tinyint(3) NOT NULL DEFAULT '1' COMMENT '启用',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_us_china_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='中概股代码表';

#
# Structure for table "china_sh_code"
#

CREATE TABLE `china_sh_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `code` varchar(50) NOT NULL DEFAULT '' COMMENT 'code',
  `enable` tinyint(3) NOT NULL DEFAULT '1' COMMENT '启用',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_china_sh_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='沪市代码表';

#
# Structure for table "us_china_price"
#

CREATE TABLE `us_china_price` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `day` varchar(10) NOT NULL DEFAULT '' COMMENT '抓取日期',
  `code` varchar(50) NOT NULL DEFAULT '' COMMENT '股票代码',
  `cname` varchar(100) NOT NULL DEFAULT '' COMMENT '股票名称',
  `now_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '现价',
  `up_rate` varchar(20) NOT NULL DEFAULT '0' COMMENT '涨跌幅',
  `up_price` varchar(20) NOT NULL DEFAULT '0' COMMENT '涨跌价格',
  `start_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '开盘价',
  `highest_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '最高价',
  `lowest_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '最低价',
  `highest_price_52week` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '52周最高价',
  `lowest_price_52week` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '52周最低价',
  `buy_sum` int(10) NOT NULL DEFAULT '0' COMMENT '交易量',
  `buy_money` int(10) NOT NULL DEFAULT '0' COMMENT '交易额',
  `hand_rate` varchar(20) NOT NULL DEFAULT '0' COMMENT '换手率',
  `buy_sum_avg_10day` int(10) NOT NULL DEFAULT '0' COMMENT '10日均量',
  `market_cap` bigint(20) NOT NULL DEFAULT '0' COMMENT '市值',
  `seller_market_cap` bigint(20) NOT NULL DEFAULT '0' COMMENT '流通市值',
  `earn_per` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '每股收益',
  `earn_rate` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '市净率',
  `compare_num` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '量比',
  `market_rate` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '市盈率',
  `swing_rate` varchar(20) NOT NULL DEFAULT '0' COMMENT '振幅',
  `pager_sum` bigint(20) NOT NULL DEFAULT '0' COMMENT '股本',
  `end_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '收盘价',
  `yesterday_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '昨收盘',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_us_china_price` (`code`,`day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='中概股价表';

#
# Structure for table "china_sh_price"
#

CREATE TABLE `china_sh_price` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `day` varchar(10) NOT NULL DEFAULT '' COMMENT '抓取日期',
  `code` varchar(50) NOT NULL DEFAULT '' COMMENT '股票代码',
  `cname` varchar(100) NOT NULL DEFAULT '' COMMENT '股票名称',
  `now_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '现价',
  `up_rate` varchar(20) NOT NULL DEFAULT '0' COMMENT '涨跌幅',
  `up_price` varchar(20) NOT NULL DEFAULT '0' COMMENT '涨跌价格',
  `start_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '开盘价',
  `highest_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '最高价',
  `lowest_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '最低价',
  `highest_price_52week` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '52周最高价',
  `lowest_price_52week` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '52周最低价',
  `buy_sum` int(10) NOT NULL DEFAULT '0' COMMENT '交易量',
  `buy_money` int(10) NOT NULL DEFAULT '0' COMMENT '交易额',
  `hand_rate` varchar(20) NOT NULL DEFAULT '0' COMMENT '换手率',
  `buy_sum_avg_10day` int(10) NOT NULL DEFAULT '0' COMMENT '10日均量',
  `market_cap` bigint(20) NOT NULL DEFAULT '0' COMMENT '市值',
  `seller_market_cap` bigint(20) NOT NULL DEFAULT '0' COMMENT '流通市值',
  `earn_per` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '每股收益',
  `earn_rate` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '市净率',
  `compare_num` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '量比',
  `market_rate` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '市盈率',
  `swing_rate` varchar(20) NOT NULL DEFAULT '0' COMMENT '振幅',
  `pager_sum` bigint(20) NOT NULL DEFAULT '0' COMMENT '股本',
  `end_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '收盘价',
  `yesterday_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '昨收盘',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_china_sh_price` (`code`,`day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='上证股价表';

#
# Structure for table "china_sz_price"
#

CREATE TABLE `china_sz_price` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `day` varchar(10) NOT NULL DEFAULT '' COMMENT '抓取日期',
  `code` varchar(50) NOT NULL DEFAULT '' COMMENT '股票代码',
  `cname` varchar(100) NOT NULL DEFAULT '' COMMENT '股票名称',
  `now_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '现价',
  `up_rate` varchar(20) NOT NULL DEFAULT '0' COMMENT '涨跌幅',
  `up_price` varchar(20) NOT NULL DEFAULT '0' COMMENT '涨跌价格',
  `start_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '开盘价',
  `highest_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '最高价',
  `lowest_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '最低价',
  `highest_price_52week` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '52周最高价',
  `lowest_price_52week` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '52周最低价',
  `buy_sum` int(10) NOT NULL DEFAULT '0' COMMENT '交易量',
  `buy_money` int(10) NOT NULL DEFAULT '0' COMMENT '交易额',
  `hand_rate` varchar(20) NOT NULL DEFAULT '0' COMMENT '换手率',
  `buy_sum_avg_10day` int(10) NOT NULL DEFAULT '0' COMMENT '10日均量',
  `market_cap` bigint(20) NOT NULL DEFAULT '0' COMMENT '市值',
  `seller_market_cap` bigint(20) NOT NULL DEFAULT '0' COMMENT '流通市值',
  `earn_per` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '每股收益',
  `earn_rate` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '市净率',
  `compare_num` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '量比',
  `market_rate` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '市盈率',
  `swing_rate` varchar(20) NOT NULL DEFAULT '0' COMMENT '振幅',
  `pager_sum` bigint(20) NOT NULL DEFAULT '0' COMMENT '股本',
  `end_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '收盘价',
  `yesterday_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '昨收盘',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_china_sz_price` (`code`,`day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='深证股价表';

#
# Structure for table "china_hk_price"
#

CREATE TABLE `china_hk_price` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `day` varchar(10) NOT NULL DEFAULT '' COMMENT '抓取日期',
  `code` varchar(50) NOT NULL DEFAULT '' COMMENT '股票代码',
  `cname` varchar(100) NOT NULL DEFAULT '' COMMENT '股票名称',
  `now_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '现价',
  `up_rate` varchar(20) NOT NULL DEFAULT '0' COMMENT '涨跌幅',
  `up_price` varchar(20) NOT NULL DEFAULT '0' COMMENT '涨跌价格',
  `start_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '开盘价',
  `highest_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '最高价',
  `lowest_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '最低价',
  `highest_price_52week` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '52周最高价',
  `lowest_price_52week` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '52周最低价',
  `buy_sum` int(10) NOT NULL DEFAULT '0' COMMENT '交易量',
  `buy_money` int(10) NOT NULL DEFAULT '0' COMMENT '交易额',
  `hand_rate` varchar(20) NOT NULL DEFAULT '0' COMMENT '换手率',
  `buy_sum_avg_10day` int(10) NOT NULL DEFAULT '0' COMMENT '10日均量',
  `market_cap` bigint(20) NOT NULL DEFAULT '0' COMMENT '市值',
  `seller_market_cap` bigint(20) NOT NULL DEFAULT '0' COMMENT '流通市值',
  `earn_per` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '每股收益',
  `earn_rate` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '市净率',
  `compare_num` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '量比',
  `market_rate` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '市盈率',
  `swing_rate` varchar(20) NOT NULL DEFAULT '0' COMMENT '振幅',
  `pager_sum` bigint(20) NOT NULL DEFAULT '0' COMMENT '股本',
  `end_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '收盘价',
  `yesterday_price` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '昨收盘',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_china_hk_price` (`code`,`day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='港股股价表';

#
# Structure for table "user_group_map"
#

CREATE TABLE `user_group_map` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '映射id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `gid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户组id',
  `enable` tinyint(3) NOT NULL DEFAULT '1' COMMENT '启用',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_uid_gid` (`uid`,`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户和用户组映射表';

#
# Structure for table "users"
#

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `nickname` varchar(100) DEFAULT NULL COMMENT '昵称',
  `password` varchar(32) NOT NULL DEFAULT '1bbd886460827015e5d605ed44252251' COMMENT '密码',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `lastlogintime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后登录时间',
  `locktime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '帐号锁定时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `enable` tinyint(3) NOT NULL DEFAULT '1' COMMENT '启用',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户';


CREATE TABLE `china_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '资源id',
  `code` varchar(50) NOT NULL DEFAULT '' COMMENT '股票代码',
  `news_type` varchar(20) NOT NULL DEFAULT 'finance' COMMENT '新闻类型',
  `publish_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '发布时间',
  `news_name` varchar(500) NOT NULL DEFAULT 'to_urlencode' COMMENT '新闻标题',
  `news_url` varchar(100) NOT NULL DEFAULT 'to_urlencode' COMMENT '新闻url',
  `content` text NOT NULL COMMENT '新闻内容|to_urlencode',
  `enable` tinyint(3) NOT NULL DEFAULT '1' COMMENT '启用',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_china_news` (`code`,`news_url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='A股新闻';

CREATE TABLE `china_hk_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '资源id',
  `code` varchar(50) NOT NULL DEFAULT '' COMMENT '股票代码',
  `news_type` varchar(20) NOT NULL DEFAULT 'finance' COMMENT '新闻类型',
  `publish_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '发布时间',
  `news_name` varchar(500) NOT NULL DEFAULT 'to_urlencode' COMMENT '新闻标题',
  `news_url` varchar(100) NOT NULL DEFAULT 'to_urlencode' COMMENT '新闻url',
  `content` text NOT NULL COMMENT '新闻内容|to_urlencode',
  `enable` tinyint(3) NOT NULL DEFAULT '1' COMMENT '启用',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_china_hk_news` (`code`,`news_url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='港股新闻';

CREATE TABLE `us_china_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '资源id',
  `code` varchar(50) NOT NULL DEFAULT '' COMMENT '股票代码',
  `news_type` varchar(20) NOT NULL DEFAULT 'finance' COMMENT '新闻类型',
  `publish_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '发布时间',
  `news_name` varchar(500) NOT NULL DEFAULT 'to_urlencode' COMMENT '新闻标题',
  `news_url` varchar(100) NOT NULL DEFAULT 'to_urlencode' COMMENT '新闻url',
  `content` text NOT NULL COMMENT '新闻内容|to_urlencode',
  `enable` tinyint(3) NOT NULL DEFAULT '1' COMMENT '启用',
  `ctime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_us_china_news` (`code`,`news_url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='美股中概股新闻';