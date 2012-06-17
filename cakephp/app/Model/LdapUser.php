<?php

class LdapUser extends AppModel
{
	var $useTable = false;
	var $name = 'LdapUser';

	var $firstName;
	
	var $primaryKey = array ('mail');
	
	var $_schema = array(
        'firstName'		=>array('type'=>'string', 'length'=>255),
		'password'		=>array('type'=>'string', 'length'=>255),
		'mail'		=>array('type'=>'string', 'length'=>255)
	);

	public function __construct($firstName = 'null', $password = 'null', $mail = 'null') {
		parent::__construct();

		$this->firstName = $firstName;
		$this->password = $password;
		$this->mail = $mail;
	}

	public function __destruct(){

	}

	public function __toString() {
		return 'User  class : <br />
			<ul>
				<li>firstName = ' . $this->firstName . '</li>
				<li>password = ' . $this->password . '</li>
				<li>mail = ' . $this->mail . '</li>
			</ul>'; 
	}
}
?>