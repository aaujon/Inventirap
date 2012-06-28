<?php
class Material extends AppModel {
	public $name = 'Material';
	//public $virtualFields = array(
	//	'full' => "CONCAT(serial_number, ' - ', model)");
	//public $displayField = 'full';
	
	public $belongsTo = array('SubCategory', 'MaterialType');
	//public $hasMany = array(
	//	'History',
	//	'Loan',
	//	'TechnicalMaterialExternalLoan');
}
?>
