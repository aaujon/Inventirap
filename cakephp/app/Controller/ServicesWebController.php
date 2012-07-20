<?php
class ServicesWebController extends AppController {

	var $layout = 'xml';
	
	private $key = 'mykeyislongenoug';

	public function beforeFilter() {
		$this->LdapAuth->allow('*');
	}

	public function materiel($irapNum = '', $login = '', $passwordAES128 = '') {

	  $this->set('login', $this->decryptPassword($this->encryptPassword('ldap')));

	  /*
		if(ClassRegistry::init('LdapConnection')->ldapAuthentication($login, decryptPassword($passwordAES128))) {

			if(preg_match('~IRAP-..-[0-9]*~', $irapNum)) {
				$materiel = ClassRegistry::init('Materiel')->
				find('all', array('conditions' => array('numero_irap' => $irapNum)));

				$this->set('login', $login);
				$this->set('id', $irapNum);
				$this->set('materials', $materiel);
			}
		}
	  */
	}

	private function encryptPassword($clearPass) {
		# open cipher module (do not change cipher/mode)
		
		if ( ! $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '') )
            return false;

            
        $msg = serialize($clearPass);                         # serialize
 
        if ( mcrypt_generic_init($td, $this->key, '') !== 0 )  # initialize buffers
            return false;
 
        $msg = mcrypt_generic($td, $msg);               # encrypt
 
        mcrypt_generic_deinit($td);                     # clear buffers
        mcrypt_module_close($td);                       # close cipher module
 
        $msg = base64_encode($msg);      # base64 encode?
 
        return $msg;    
	}
	
	private function decryptPassword($cryptPass)
	{
		$msg = base64_decode($cryptPass);          # base64 decode?
 
        # open cipher module (do not change cipher/mode)
        if ( ! $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '') )
            return false;
 
        if ( mcrypt_generic_init($td, $this->key, '') !== 0 )      # initialize buffers
            return false;
 
        $msg = mdecrypt_generic($td, $msg);                 # decrypt
        $msg = unserialize($msg);                           # unserialize
 
        mcrypt_generic_deinit($td);                         # clear buffers
        mcrypt_module_close($td);                           # close cipher module
 
        return $msg;       
	}
}

?>