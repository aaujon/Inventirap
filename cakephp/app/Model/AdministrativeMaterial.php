<?php
class AdministrativeMaterial extends AppModel {
	public $name = 'AdministrativeMaterial';
	public $virtualFields = array(
		'full' => "CONCAT(irap_number, ' - ', designation)");
	public $displayField = 'full';
	
	public $belongsTo = 'SubCategory';
	public $hasMany = array(
		'AdministrativeMaterialHistory',
		'AdministrativeMaterialInternalLoan',
		'AdministrativeMaterialExternalLoan');
}
?>
