<?php

$installer = $this;
$installer->startSetup();

$tableMenu = $installer->getTable('menu/menu');
$tableItem = $installer->getTable('menu/item');

$installer->run("
    CREATE TABLE IF NOT EXISTS `$tableMenu`( 
        `id` SMALLINT(6) UNSIGNED NOT NULL AUTO_INCREMENT , 
        `name` VARCHAR(150) NOT NULL , 
        `position` VARCHAR(50) NOT NULL , 
        PRIMARY KEY (`id`)
    )
");

$installer->run("
    CREATE TABLE IF NOT EXISTS `$tableItem`( 
        `id` SMALLINT(6) UNSIGNED NOT NULL AUTO_INCREMENT , 
        `parent_menu` SMALLINT(6) UNSIGNED NOT NULL, 
        `title_type` INT(2) UNSIGNED NOT NULL,
        `title_text` VARCHAR(100) , 
        `link_type` INT(2) NOT NULL , 
        `link_url` VARCHAR(200) , 
        `sort_order` SMALLINT(6) NOT NULL DEFAULT 0,
        `cms_page` SMALLINT(6),
        PRIMARY KEY (`id`)
    )
");

$installer->run("
    ALTER TABLE `$tableItem`
	ADD FOREIGN KEY(cms_page)
            REFERENCES cms_page(page_id)
            ON UPDATE CASCADE ON DELETE CASCADE,
        ADD FOREIGN KEY (parent_menu)
            REFERENCES `$tableMenu`(id)
            ON DELETE CASCADE ON UPDATE CASCADE
");

Mage::getModel('menu/menu')->setData(array(
    'name'      => 'Main Menu',
    'position'  => 'main_menu'
))->save();

$installer->endSetup();