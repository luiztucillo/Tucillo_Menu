<?php

$installer = $this;
$installer->startSetup();

$tableMenu = $installer->getTable('menu/menu');
$tableItem = $installer->getTable('menu/item');

$installer->run("
    ALTER TABLE `$tableItem`
    ADD COLUMN `target` VARCHAR(20)
");

$installer->endSetup();