<?php
class Category extends AppModel {
	public $name = 'Category';
	public $displayField = 'name';
	
	var $hasMany = 'SubCategory';
}
?>
