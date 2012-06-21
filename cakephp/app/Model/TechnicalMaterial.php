<?php
class TechnicalMaterial extends AppModel {
	public $name = 'TechnicalMaterial';
	public $virtualFields = array(
		'full' => "CONCAT(serial_number, ' - ', model)");
	public $displayField = 'full';
	
	public $belongsTo = 'SubCategory';
	public $hasMany = array(
		'TechnicalMaterialHistory',
		'TechnicalMaterialInternalLoan',
		'TechnicalMaterialExternalLoan');
}
?>
