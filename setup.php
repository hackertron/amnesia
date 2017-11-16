<?php

$sql = "CREATE DATABASE amnesia;";

$sql = "CREATE TABLE `amnesia`.`patient` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `number` VARCHAR(13) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$sql = "CREATE TABLE `amnesia`.`msg_status` ( `pid` INT NOT NULL AUTO_INCREMENT , `id` VARCHAR(50) NOT NULL , `status` VARCHAR(50) NOT NULL , PRIMARY KEY (`pid`)) ENGINE = InnoDB;";


$sql  = "ALTER TABLE `msg_status` ADD PRIMARY KEY( `id`);";
?>
