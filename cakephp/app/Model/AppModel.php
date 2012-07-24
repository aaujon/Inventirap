<?php
App::uses('Model', 'Model');

class AppModel extends Model {
	
	function check_string($check) {
		$value = array_shift($check);
		
		return preg_match('/^[a-zA-Z0-9éèàùâêôîôûç_.,"\/\'\s-]*$/', $value);
	}
}
?>
