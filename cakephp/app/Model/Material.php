<?php
class Material extends AppModel {
	
	/*
	 * The attribute to manage the web service 
	 */
	public $actsAs = array('webservice'); 
	
	public $name = 'Material';
	var $virtualFields = array(
		'full_storage' => 'CONCAT(storage_place, "-", storage_description)');
	//public $virtualFields = array(
	//	'full' => "CONCAT(serial_number, ' - ', model)");
	public $displayField = 'designation';
	
	public $belongsTo = array('SubCategory', 'ThematicGroup', 'WorkGroup');
	//public $hasMany = array(
	//	'History',
	//	'Loan',
	//	'TechnicalMaterialExternalLoan');
}
?>
