<div class="<?php echo $pluralVar;?> form">
<?php
	if ($this->params['action'] == 'add')
		echo '<h2>Ajouter un utilisateur</h2>';
	else 
		echo '<h2>Éditer un utilisateur</h2>';

	$utilisateur = ClassRegistry::init('Utilisateur');
		
	echo $this->Form->create();
	if ($this->params['action'] == 'add') {
		echo $this->Form->input('nom', array(
			'options' => $utilisateur->getNewLdapUsers(), 
			'empty' => 'Choisir un utilisateur', 
			'selected' => '',
			'label' => 'Nom (LDAP)',
		'div' => 'input required'));
		echo '<div style="color: grey; font-size: 10px;">Note: un utilisateur ne peut pas être présent deux fois dans l\'inventaire.</div>';
	}
	else {
		echo $this->Form->input('nom', array(
			'options' => $utilisateur->getLdapUsers(), 
			'empty' => 'Choisir un utilisateur', 
			'disabled' => true,
			'div' => 'input required'));
	}
	echo $this->Form->input('login', array( 
			'label' => 'Login',
			'div' => 'input required', 
			'readonly' => true));
	echo $this->Form->input('email', array( 
			'label' => 'E-mail',
			'div' => 'input required', 
			'readonly' => true));
	echo $this->Form->input('role', array('label' => 'Rôle', 'options' => array(
		'Utilisateur' => 'Utilisateur', 
		'Responsable' => 'Responsable', 
		'Administration' => 'Administration', 
		'Super Administrateur' => 'Super Administrateur')));
	echo $this->Form->input('groupes_metier_id', array('label' => 'Groupe métier'));
	echo $this->Form->end('Valider');
?>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('menu_form');
	?>
</div>

<?php
$this->Js->get('#UtilisateurNom')->event('change', 
	'var url = document.URL;
	var emailUrl = url.replace("add", "getLdapEmail/");
	$.ajax({
		url: emailUrl + $("#UtilisateurNom").val()
	}).done(function(data) { 
		$("#UtilisateurEmail").val(data)
	});
	var loginUrl = url.replace("add", "getLdapLogin/");
	$.ajax({
		url: loginUrl + $("#UtilisateurNom").val()
	}).done(function(data) {
		$("#UtilisateurLogin").val(data)
	});');
echo $this->Js->writeBuffer();
?>
