<?php

define('TABLES', array(

    'news_content' =>
        'CREATE TABLE `news_content` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `article` longtext,
        `news_link_id` int(11) DEFAULT NULL,
         PRIMARY KEY (`id`),
         KEY `news_link_id_idx` (`news_link_id`),
         CONSTRAINT `news_link_id` FOREIGN KEY (`news_link_id`) REFERENCES `news_links` (`id`) ON DELETE CASCADE ON UPDATE CASCADE 
       ) ENGINE=InnoDB DEFAULT CHARSET=utf8',

    'news_links' =>
        'CREATE TABLE `news_links` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(255) NOT NULL,
        `date` varchar(45) DEFAULT NULL,
        `link` varchar(255) NOT NULL,
        `is_used` enum(\'0\',\'1\') DEFAULT \'0\',
         PRIMARY KEY (`id`)
       ) ENGINE=InnoDB DEFAULT CHARSET=utf8',

));
