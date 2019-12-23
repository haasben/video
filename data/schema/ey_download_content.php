<?php 
return array (
  'id' => 
  array (
    'name' => 'id',
    'type' => 'int(10)',
    'notnull' => false,
    'default' => NULL,
    'primary' => true,
    'autoinc' => true,
  ),
  'aid' => 
  array (
    'name' => 'aid',
    'type' => 'int(10)',
    'notnull' => false,
    'default' => '0',
    'primary' => false,
    'autoinc' => false,
  ),
  'content' => 
  array (
    'name' => 'content',
    'type' => 'longtext',
    'notnull' => false,
    'default' => NULL,
    'primary' => false,
    'autoinc' => false,
  ),
  'add_time' => 
  array (
    'name' => 'add_time',
    'type' => 'int(11)',
    'notnull' => false,
    'default' => '0',
    'primary' => false,
    'autoinc' => false,
  ),
  'update_time' => 
  array (
    'name' => 'update_time',
    'type' => 'int(11)',
    'notnull' => false,
    'default' => '0',
    'primary' => false,
    'autoinc' => false,
  ),
  'amount' => 
  array (
    'name' => 'amount',
    'type' => 'decimal(10,2)',
    'notnull' => false,
    'default' => '0.00',
    'primary' => false,
    'autoinc' => false,
  ),
  'hours' => 
  array (
    'name' => 'hours',
    'type' => 'int(10)',
    'notnull' => false,
    'default' => NULL,
    'primary' => false,
    'autoinc' => false,
  ),
  'chapter' => 
  array (
    'name' => 'chapter',
    'type' => 'varchar(200)',
    'notnull' => false,
    'default' => '',
    'primary' => false,
    'autoinc' => false,
  ),
  'videorating' => 
  array (
    'name' => 'videorating',
    'type' => 'enum(\'普通\',\'初级\',\'中级\',\'高级\')',
    'notnull' => false,
    'default' => '普通',
    'primary' => false,
    'autoinc' => false,
  ),
  'lecturer' => 
  array (
    'name' => 'lecturer',
    'type' => 'varchar(200)',
    'notnull' => false,
    'default' => '',
    'primary' => false,
    'autoinc' => false,
  ),
  'Instructors' => 
  array (
    'name' => 'Instructors',
    'type' => 'longtext',
    'notnull' => false,
    'default' => NULL,
    'primary' => false,
    'autoinc' => false,
  ),
  'is_free' => 
  array (
    'name' => 'is_free',
    'type' => 'enum(\'免费\',\'收费\')',
    'notnull' => false,
    'default' => '免费',
    'primary' => false,
    'autoinc' => false,
  ),
);