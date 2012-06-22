<h1> Vous venez de vous authentifier </h1>

<?php

	$userName = $this->Session->read('LdapUserName');
	$authenticationLevel = $this->Session->read('LdapUserAuthenticationLevel');

	 if(isset($userName))
	 {
		echo '<p>You are connected with the LdapUser "' . $userName . ' and the authentication level number : ' . $authenticationLevel . '"</p>';

	 } 


	
?>