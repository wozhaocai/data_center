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