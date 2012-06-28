<?php
class Loan extends AppModel {
	public $name = 'Loan';
	
	public $belongsTo = array('Material');
}
?>
