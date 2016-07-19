<?php

$installer = $this;
$installer->startSetup();

$tableItem = $installer->getTable('menu/item');

$installer->run("
    ALTER TABLE `$tableItem`
    ADD COLUMN `category_id` INT UNSIGNED NULL AFTER `cms_page`;
");

$installer->run("
  INSERT INTO `tucillo_menu_item`(`id`,`parent_menu`,`title_type`,`title_text`,`link_type`,`link_url`,`sort_order`,`cms_page`,`category_id`,`target`,`parent_item`)
  VALUES
    (1,1,2,NULL,3,NULL,0,NULL,130,NULL,NULL),
    (2,1,2,NULL,3,NULL,10,NULL,124,NULL,NULL),
    (3,1,2,NULL,3,NULL,0,NULL,163,NULL,1),
    (4,1,1,'Edições Limitadas',3,NULL,0,NULL,169,NULL,3),
    (5,1,1,'Categorias',1,NULL,10,NULL,NULL,NULL,1),
    (6,1,1,'Life Style e Casual',1,NULL,0,NULL,NULL,NULL,5),
    (7,1,1,'Tênis',1,NULL,20,NULL,NULL,NULL,1),
    (8,1,1,'Lifestyle e Casual',1,NULL,0,NULL,NULL,NULL,7),
    (9,1,1,'Confecções',1,NULL,30,NULL,NULL,NULL,1),
    (11,1,1,'Performance',1,NULL,40,NULL,NULL,NULL,1),
    (13,1,1,'Fila X-Training',1,NULL,10,NULL,NULL,NULL,3),
    (14,1,1,'Linha Kenya Racer 3',1,NULL,20,NULL,NULL,NULL,3),
    (15,1,1,'Pólos Archive',1,NULL,30,NULL,NULL,NULL,3),
    (16,1,1,'Tênis Zimwi',1,NULL,40,NULL,NULL,NULL,3),
    (17,1,1,'Linha Archive',1,NULL,20,NULL,NULL,NULL,5),
    (18,1,1,'Running Performance',1,NULL,30,NULL,NULL,NULL,5),
    (19,1,1,'Sportswear',1,NULL,40,NULL,NULL,NULL,5),
    (20,1,1,'Tennis Performance',1,NULL,50,NULL,NULL,NULL,5),
    (21,1,1,'Training',1,NULL,60,NULL,NULL,NULL,5),
    (22,1,1,'Linha Archive',1,NULL,10,NULL,NULL,NULL,7),
    (23,1,1,'Running Performance',1,NULL,20,NULL,NULL,NULL,7),
    (24,1,1,'Tennis Performance',1,NULL,30,NULL,NULL,NULL,7),
    (25,1,1,'Training',1,NULL,40,NULL,NULL,NULL,7),
    (26,1,1,'Agasalhos',1,NULL,0,NULL,NULL,NULL,9),
    (27,1,1,'Camisetas',1,NULL,10,NULL,NULL,NULL,9),
    (28,1,1,'Jaquetas',1,NULL,20,NULL,NULL,NULL,9),
    (29,1,1,'Pólos',1,NULL,30,NULL,NULL,NULL,9),
    (30,1,1,'Shorts',1,NULL,40,NULL,NULL,NULL,9),
    (31,1,1,'Running',1,NULL,0,NULL,NULL,NULL,11),
    (32,1,1,'Tennis',1,NULL,10,NULL,NULL,NULL,11),
    (33,1,1,'Performance',1,NULL,0,NULL,NULL,NULL,2),
    (34,1,1,'Lifestyle',1,NULL,10,NULL,NULL,NULL,2),
    (35,1,1,'Active',1,NULL,20,NULL,NULL,NULL,2),
    (36,1,1,'Running Performance',1,NULL,0,NULL,NULL,NULL,33),
    (37,1,1,'Lifestyle',1,NULL,0,NULL,NULL,NULL,34),
    (38,1,1,'Sportswear',1,NULL,0,NULL,NULL,NULL,35),
    (39,1,1,'Training',1,NULL,10,NULL,NULL,NULL,35);
");

$installer->endSetup();
