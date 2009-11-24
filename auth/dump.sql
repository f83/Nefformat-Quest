-- 
-- Структура таблицы `users`
-- 

CREATE TABLE `users` (
  `id` smallint(8) unsigned NOT NULL auto_increment,
  `login` varchar(50) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `salt` char(3) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `login` (`login`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `users`
-- 

INSERT INTO `users` VALUES (1, 'md5', '84cd3e7ff13bbaed1c1db91671844bcc', '8f*');