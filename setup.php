<?php

$sql = "CREATE DATABASE amnesia;";

$sql = "CREATE TABLE `amnesia`.`patient` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `number` VARCHAR(13) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

?>
