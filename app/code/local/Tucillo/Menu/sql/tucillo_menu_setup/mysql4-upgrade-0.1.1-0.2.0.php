<?php

$installer = $this;
$installer->startSetup();

$tableMenu = $installer->getTable('menu/menu');
$tableItem = $installer->getTable('menu/item');

$installer->run("
    ALTER TABLE `$tableItem`
    ADD COLUMN `parent_item` SMALLINT(6) UNSIGNED
");

$installer->run("
    ALTER TABLE `$tableItem`
	ADD FOREIGN KEY(parent_item)
            REFERENCES `$tableItem`(id)
            ON UPDATE CASCADE ON DELETE CASCADE
");

$installer->endSetup();