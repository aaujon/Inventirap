<?php
class ServicesWebController extends AppController {

	var $layout = 'xml';
	
	private $key = 'mykeyislongenoug';

	public function beforeFilter() {
		$this->LdapAuth->allow('*');
	}

	public function materiel($irapNum = '', $login = '', $passwordAES128 = '') {
		if(ClassRegistry::init('LdapConnection')->ldapAuthentication($login, decryptPassword($passwordAES128))) {

			if(preg_match('~IRAP-..-[0-9]*~', $irapNum)) {
				$materiel = ClassRegistry::init('Materiel')->
				find('all', array('conditions' => array('numero_irap' => $irapNum)));

				$this->set('login', $login);
				$this->set('id', $irapNum);
				$this->set('materials', $materiel);
			}
		}
	}

	private function decryptPassword($pass)
	{

		$base64encoded_ciphertext = $pass;

		$res_non = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->key, base64_decode($base64encoded_ciphertext), ‘ecb’);

		$decrypted = $res_non;
		$dec_s2 = strlen($decrypted);

		$padding = ord($decrypted[$dec_s2-1]);
		$decrypted = substr($decrypted, 0, -$padding);

		return  $decrypted;
	}
}

?>