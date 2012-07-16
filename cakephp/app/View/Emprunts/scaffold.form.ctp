<div class="<?php echo $pluralVar;?> form">
<?php
	$utilisateur = ClassRegistry::init('Utilisateur');
	
	echo $this->Html->script('script');

	if ($this->params['action'] == 'add')
		echo '<h2><i class="icon-plus"></i> Ajouter un emprunt</h2>';
	else 
		echo '<h2><i class="icon-edit"></i> Éditer un emprunt</h2>';

	//Id du matériel choisi
	$materiel_id = '';
	if ($this->params['action'] == 'add' && isset($this->passedArgs['mat']))
		$materiel_id = $this->passedArgs['mat'];
		
	//Gestion du lieu de stockage
	$disp_interne = 'display:none';
	$disp_externe = 'display:block';
	if (isset($this->data['Emprunt']['emprunt_interne']) && $this->data['Emprunt']['emprunt_interne'] == 1) {
		$disp_interne = 'display:block';
		$disp_externe = 'display:none';
	}
	
	echo $this->Form->create();
	echo $this->Form->input('materiel_id', array('label' => 'Matériel concerné', 'value' => $materiel_id));
	echo $this->Form->input('date_emprunt', array('label' => 'Date de l\'emprunt'));
	echo $this->Form->input('date_retour_emprunt', array('label' => 'Date de retour'));
	echo $this->Form->input('nom_responsable', array(
		'options' => $utilisateur->getLdapUsers(), 
		'empty' => 'Choisir un utilisateur', 
		'selected' => $this->Session->read('UserName'),
		'label' => 'Nom du responsable'));
	echo $this->Form->input('email_responsable', array(
		'label' => 'Email du responsable', 
		'value' => $utilisateur->getEmailFromLdapName($this->Session->read('LdapUserName')), 
		'readonly' => true));
	echo $this->Form->input('emprunt_interne', array('label' => 'Emprunt interne', 'onchange' => 'emprunt_interne_externe();'));
	echo '<div id="interne" style="margin: 0; padding: 0; '.$disp_interne.';">';
	echo $this->Form->input('e_lieu_stockage', array('label' => 'Lieu de stockage', 
		'options' => array('B'=>'Belin', 'R'=>'Roche', 'T'=>'Tarbes', 'C'=>'CNES', 'A'=>'Autre'), 
		'div' => 'input required',
		'style' => 'width: 100px'));
	echo $this->Form->input('e_lieu_detail', array('label' => 'Lieu de stockage (pièce)'));
	echo '</div>';
	echo '<div id="externe" style="margin: 0; padding: 0; '.$disp_externe.';">';
	echo $this->Form->input('laboratoire');
	echo '</div>';
	echo $this->Form->end(__d('cake', 'Valider'));
?>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('tools_form');
	?>
</div>
<?php
$this->Js->get('#MaterielNomResponsable')->event('change', 
	'$.ajax({
		url: "/Inventirap/cakephp/utilisateurs/getLdapEmail/" + $("#MaterielNomResponsable").val()
	}).done(function(data) { 
		$("#MaterielEmailResponsable").val(data)
	})');
echo $this->Js->writeBuffer();
?>