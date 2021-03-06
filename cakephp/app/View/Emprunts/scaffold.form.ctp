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

	$months = array('01' => 'Janvier', 
					'02' => 'Février',
					'03' => 'Mars',
					'04' => 'Avril',
					'05' => 'Mai',
					'06' => 'Juin',
					'07' => 'Juillet',
					'08' => 'Aout',
					'09' => 'Septembre',
					'10' => 'Octobre',
					'11' => 'Novembre',
					'12' => 'Décembre',
					);
	
	echo $this->Form->create('Emprunt', array('action' => 'addEmprunt')); 
	// echo $this->Form->create();
	echo $this->Form->input('materiel_id', array('label' => 'Matériel concerné', 'value' => $materiel_id));
	echo $this->Form->input('date_emprunt', array('monthNames' => $months, 'dateFormat' => 'DMY', 'label' => 'Date de l\'emprunt'));
	echo $this->Form->input('date_retour_emprunt', array('monthNames' => $months, 'dateFormat' => 'DMY', 'label' => 'Date de retour'));
	echo $this->Form->input('emprunt_interne', array('label' => 'Emprunt interne', 'onchange' => 'emprunt_interne_externe();'));
	echo '<span id="span_emprunteur_combo" hidden=true>';
	echo $this->Form->input('nom_emprunteur_combo', array(
		'options' => $utilisateur->getLdapUsers(), 
		'empty' => 'Choisir un utilisateur', 
		'selected' => '',
		'label' => 'Nom de l\'emprunteur'));
	echo '</span><span id="span_emprunteur_text">';
	echo $this->Form->input('nom_emprunteur_text', array(
		'label' => 'Nom de l\'emprunteur',  
		'readonly' => false));
	echo '</span>';
	echo $this->Form->input('email_emprunteur', array(
		'label' => 'Email de l\'emprunteur', 
		'value' => '', 
		'readonly' => false));
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
	echo $this->Form->end('Valider');
?>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('tools_form');
		echo $this->element('menu_form');
	?>
</div>
<?php

$this->Js->get('#EmpruntEmpruntInterne')->event('change', 
	'
		if($("#EmpruntEmpruntInterne").is(":checked")) {
		 	$("#span_emprunteur_combo").show();
		 	$("#span_emprunteur_text").hide();
			$("#EmpruntNomEmprunteurText").val("");
		 	var url = document.URL;
			var emailUrl = url.replace("emprunts/add", "utilisateurs/getLdapEmail/");
			$.ajax({
				url: emailUrl + $("#EmpruntNomEmprunteurCombo").val()
			}).done(function(data) { 
				$("#EmpruntEmailEmprunteur").val(data)
			});
		 } else {
			$("#span_emprunteur_combo").hide();
		 	$("#span_emprunteur_text").show();
			$("#EmpruntEmailEmprunteur").val("");
			$("#EmpruntNomEmprunteurCombo").val("");
		 }
	');

		
$this->Js->get('#EmpruntNomEmprunteurCombo')->event('change', 
	'var url = document.URL;
	var emailUrl = url.replace("emprunts/add", "utilisateurs/getLdapEmail/");
	$.ajax({
		url: emailUrl + $("#EmpruntNomEmprunteurCombo").val()
	}).done(function(data) { 
		$("#EmpruntEmailEmprunteur").val(data)
	})');
	echo $this->Js->writeBuffer();
?>