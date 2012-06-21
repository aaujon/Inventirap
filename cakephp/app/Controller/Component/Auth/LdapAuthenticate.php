<?php
App::uses('BaseAuthenticate', 'Controller/Component/Auth');

class LdapAuthenticate extends BaseAuthenticate {
	public function authenticate(CakeRequest $request, CakeResponse $response) {
		// Do things for openid here.

		echo 'LdapAuthenticate !!!!';
	}
}

?>