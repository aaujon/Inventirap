<?php
class TechMaterial extends AppModel {
	public $name = 'TechMaterial';
	public $virtualFields = array(
		'full' => "CONCAT(serial_number, ' - ', model)");
	public $displayField = 'full';
	
	public $belongsTo = 'SubCategory';
	public $hasMany = 'TechMaterialHistory';
}
?>
