-- 创建表love_note
CREATE TABLE IF NOT EXISTS `love_note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` mediumtext NOT NULL,
  `object` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
-- 创建表love_note_comment
CREATE TABLE IF NOT EXISTS `love_note_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `love_note_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `love_note_id` (`love_note_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
-- 创建表night_say
CREATE TABLE IF NOT EXISTS `night_say` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- 创建表user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `QQ` varchar(255) NOT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `header` varchar(255) NOT NULL DEFAULT '/img/default_header.jpg',
  `sex` int(11) NOT NULL DEFAULT '0',
  `class` int(11) NOT NULL DEFAULT '0',
  `grade` int(11) NOT NULL DEFAULT '0',
  `real_name` varchar(255) DEFAULT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
-- 创建表night_say_comment
CREATE TABLE IF NOT EXISTS `night_say_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `night_say_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `night_say_id` (`night_say_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
-- 外键约束限制
ALTER TABLE `love_note`
  ADD CONSTRAINT `love_note_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `love_note_comment`
  ADD CONSTRAINT `love_note_comment_ibfk_2` FOREIGN KEY (`love_note_id`) REFERENCES `love_note` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `love_note_comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `night_say_comment`
  ADD CONSTRAINT `night_say_comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `night_say_comment_ibfk_2` FOREIGN KEY (`night_say_id`) REFERENCES `night_say` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
