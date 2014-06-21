SET NAMES utf8;

DROP TABLE IF EXISTS `acos`;
CREATE TABLE IF NOT EXISTS `acos`(
	`id` int(11) NOT NULL AUTO_INCREMENT, 
	`parent_id` int(11), 
	`model` varchar(64), 
	`foreign_key` int(11), 
	`alias` varchar(128), 
	`lft` int(11), 
	`rght` int(11), 
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `aros`;
CREATE TABLE IF NOT EXISTS `aros`(
	`id` int(11) NOT NULL AUTO_INCREMENT, 
	`parent_id` int(11), 
	`model` varchar(64), 
	`foreign_key` int(11), 
	`alias` varchar(128), 
	`lft` int(11), 
	`rght` int(11), 
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `aros_acos`;
CREATE TABLE IF NOT EXISTS `aros_acos`(
	`id` int(11) NOT NULL AUTO_INCREMENT, 
	`aro_id` int(11), 
	`aco_id` int(11), 
	`_create` int(2) DEFAULT NULL, 
	`_read` int(2) DEFAULT NULL, 
	`_update` int(2) DEFAULT NULL, 
	`_delete` int(2) DEFAULT NULL, 
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members`(
	`id` int(11) NOT NULL AUTO_INCREMENT, 
	`group_id` int(11), 
	`username` varchar(64), 
	`password` varchar(48), 
	`user_status` varchar(1) DEFAULT 'N', 
	`created` datetime, 
	`modified` datetime, 
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups`(
	`id` int(11) NOT NULL AUTO_INCREMENT, 
	`parent_id` int(11), 
	`name` varchar(64), 
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `group_permissions`;
CREATE TABLE IF NOT EXISTS `group_permissions`(
	`id` int(11) NOT NULL AUTO_INCREMENT, 
	`parent_id` int(11), 
	`order` int(11), 
	`name` varchar(64), 
	`description` varchar(255) DEFAULT NULL, 
	`acos` varchar(255), 
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `parliamentarians`;
CREATE TABLE IF NOT EXISTS `parliamentarians`(
	`id` int(11) NOT NULL AUTO_INCREMENT, 
	`Party_id` int(11), 
	`name` varchar(255), 
	`district` varchar(255) DEFAULT NULL, 
	`contacts_phone` varchar(255) DEFAULT NULL, 
	`contacts_fax` varchar(255) DEFAULT NULL, 
	`contacts_email` varchar(255) DEFAULT NULL, 
	`contacts_address` varchar(255) DEFAULT NULL, 
	`links_council` varchar(255) DEFAULT NULL, 
	`gender` varchar(255) DEFAULT NULL, 
	`image_url` varchar(255) DEFAULT NULL, 
	`experience` text DEFAULT NULL, 
	`platform` text DEFAULT NULL, 
	`birth` date DEFAULT NULL, 
	`party` varchar(255) DEFAULT NULL, 
	`constituency` varchar(255) DEFAULT NULL, 
	`education` text DEFAULT NULL, 
	`group` varchar(255) DEFAULT NULL, 
	`ad` int(11) DEFAULT NULL, 
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `motions_parliamentarians`;
CREATE TABLE IF NOT EXISTS `motions_parliamentarians`(
	`id` int(11) NOT NULL AUTO_INCREMENT, 
	`Parliamentarian_id` int(11), 
	`Motion_id` int(11), 
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `parties`;
CREATE TABLE IF NOT EXISTS `parties`(
	`id` int(11) NOT NULL AUTO_INCREMENT, 
	`name` varchar(255), 
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `motions`;
CREATE TABLE IF NOT EXISTS `motions`(
	`id` int(11) NOT NULL AUTO_INCREMENT, 
	`sequence` varchar(255) DEFAULT NULL, 
	`type` varchar(255) DEFAULT NULL, 
	`group_type` varchar(255) DEFAULT NULL, 
	`number` varchar(255) DEFAULT NULL, 
	`source` varchar(255) DEFAULT NULL, 
	`requested_date` date DEFAULT NULL, 
	`requested_number` varchar(255) DEFAULT NULL, 
	`requester` text DEFAULT NULL, 
	`petition_people` text DEFAULT NULL, 
	`summary` text DEFAULT NULL, 
	`description` text DEFAULT NULL, 
	`rules` varchar(255) DEFAULT NULL, 
	`comments` varchar(255) DEFAULT NULL, 
	`result` text DEFAULT NULL, 
	`status` varchar(255) DEFAULT NULL, 
	`result_date` date DEFAULT NULL, 
	`posting_date` date DEFAULT NULL, 
	`posting_number` varchar(255) DEFAULT NULL, 
	`attachments` varchar(255) DEFAULT NULL, 
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

