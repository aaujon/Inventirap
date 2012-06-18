<?php
class TechMaterial extends AppModel {
	public $name = 'TechMaterial';
	public $displayField = 'name';
	
	var $belongsTo = 'SubCategory';
}
?>
