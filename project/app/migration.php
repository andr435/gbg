<?php

require_once './core/Config.php';
require_once './core/Database.php';

$sql = 'CREATE TABLE IF NOT EXISTS users (
    `id` int(10) NOT NULL auto_increment,
    `username` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(100) NOT NULL,
    `birthday` Date NOT NULL,
    `phone` varchar(10) NOT NULL,
    `url` varchar(200) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY unique_email (email),
    UNIQUE KEY unique_username (username)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8';

$db = new Database();
$db->query($sql);
$db->execute();