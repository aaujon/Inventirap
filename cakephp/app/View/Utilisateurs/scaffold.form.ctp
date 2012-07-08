
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
	
	$inputRoles = array();
	foreach($utilisateurs->getAcceptedRoles() as $role)
		$inputRoles[$role] = $role;
	
	echo $this->Form->create();
	if ($this->params['action'] == 'add')
		echo $this->Form->input('ldap', 
			array('options' => $ldapUsers, 'empty' => 'Choisir un utilisateur', 'selected' => ''));
	else 
		echo $this->Form->input('ldap', 
			array('options' => $ldapUsers, 'empty' => 'Choisir un utilisateur', 'disabled' => true));
	echo $this->Form->input('role', 
		array('options' => $inputRoles));
	echo $this->Form->input('email', array('disabled' => true));
	echo $this->Form->end(__d('cake', 'Valider'));
?>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('tools_form');
	?>
</div>


<script>	
	$('#UtilisateurLdap').change(
		function() {
			if($('#UtilisateurLdap').val()) {
				$.ajax({
	                type: "post",
	                url: "\/Inventirap\/cakephp\/utilisateurs\/getEmailFromName\/" + $('#UtilisateurLdap').val(),
	                success: function(data,textStatus,xhr){
	                        $('#UtilisateurEmail').val(data);
	                }
	            })
			}
		}
	)
</script>