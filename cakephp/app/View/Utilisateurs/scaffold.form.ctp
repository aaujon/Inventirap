<div class="<?php echo $pluralVar;?> form">
<?php
	if ($this->params['action'] == 'add')
		echo '<h2>Ajouter un utilisateur</h2>';
	else 
		echo '<h2>Éditer un utilisateur</h2>';

	$connection = ClassRegistry::init('LdapConnection');
	$utilisateurs = ClassRegistry::init('Utilisateur');
	
	$ldapUsers = array();
	foreach($connection->getAllLdapUsers() as $userInformations)
		if(!empty($userInformations[$connection->getAuthenticationType()][0]))
			$ldapUsers[$userInformations[$connection->getAuthenticationType()][0]] 
				= $userInformations[$connection->getAuthenticationType()][0];
		
	echo $this->Form->create();
	if ($this->params['action'] == 'add')
		echo $this->Form->input('ldap', array(
			'options' => $ldapUsers, 
			'empty' => 'Choisir un utilisateur', 
			'selected' => ''));
	else 
		echo $this->Form->input('ldap', array(
			'options' => $ldapUsers, 
			'empty' => 'Choisir un utilisateur', 
			'disabled' => true));
	echo $this->Form->input('role', array('options' => $utilisateurs->getAcceptedRoles()));
	echo $this->Form->end(__d('cake', 'Valider'));
?>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('tools_form');
	?>
</div>