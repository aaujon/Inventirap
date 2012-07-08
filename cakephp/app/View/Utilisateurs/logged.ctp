<div class="index">
	<h2>Authentification réussie</h2>
	
	<?php
		$userName = $this->Session->read('LdapUserName');
		$authenticationLevel = $this->Session->read('LdapUserAuthenticationLevel');
	
		 if(isset($userName)) {
			$utilisateurs = ClassRegistry::init('Utilisateur');
			echo '<p>Vous êtes maintenant connecté avec l\'utilisateur LDAP <b>"' . $userName . '"</b> et avec le niveau d\'autentification : <b>"' . $utilisateurs->getRoleFromAuthenticationLevel($authenticationLevel) . '"</b></p>';
		}
	?>
</div>
<div class="actions">
<?php echo $this->element('menu'); ?>
</div>