<h1> Authentication status </h1>

<?php

	$userName = $this->Session->read('LdapUserName');
	$authenticationLevel = $this->Session->read('LdapUserAuthenticationLevel');

	 if(isset($userName))
	 {
		echo '<p>You are connected with the LdapUser "' . $userName . ' and the authentication level number : ' . $authenticationLevel . '"</p>';

	 } 


	
?>