<?php
class WorkGroup extends AppModel {
	public $name = 'WorkGroup';
	public $displayField = 'name';

	var $hasMany = 'Material';
}
?>
