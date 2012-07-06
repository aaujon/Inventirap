<div class="index">
	<h2>Authentification réussie</h2>
	<?php
		$userName = $this->Session->read('LdapUserName');
		$authenticationLevel = $this->Session->read('LdapUserAuthenticationLevel');
	
		 if(isset($userName))
			echo '<p>Vous êtes maintenant connecté avec l\'utilisateur LDAP "' . $userName . ' avec le niveau d\'autentification : ' . $authenticationLevel . '"</p>';
	?>
</div>
<div class="actions">
<?php echo $this->element('menu'); ?>
</div>