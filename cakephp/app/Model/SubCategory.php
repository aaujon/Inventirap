<?php
class SubCategory extends AppModel {
	public $name = 'SubCategory';
	public $displayField = 'name';

	var $belongsTo = 'Category';
	var $hasMany = 'TechMaterial';
}
?>
