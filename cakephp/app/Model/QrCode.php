<?php

class QrCode extends AppModel {

	var $useTable = false;
	var $name = 'QrCode';

	var $text;
	
	var $primaryKey = array ('text');
	
	var $_schema = array(
        'text'		=>array('type'=>'string', 'length'=>255)
	);

	var $validate = array(
    'text' => array(
        'rule'=>array('minLength', 1), 
        'message'=>'Text is required' )
	);

}