<?php
class ThematicGroup extends AppModel {
	public $name = 'ThematicGroup';
	public $displayField = 'name';

	var $hasMany = 'Material';
}
?>
