<?php

$installer = $this;
$installer->startSetup();

$tableItem = $installer->getTable('menu/item');

$installer->run("
    ALTER TABLE `$tableItem`
    ADD COLUMN `customer_group` TEXT NULL AFTER `parent_item`;
");

$installer->endSetup();
