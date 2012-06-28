<?php
class MaterialType extends AppModel {
	public $name = 'MaterialType';
	public $displayField = 'name';

	var $hasMany = 'Material';
}
?>
