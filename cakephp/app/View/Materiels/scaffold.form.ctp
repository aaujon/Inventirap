<div class="<?php echo $pluralVar;?> form">
<?php
	$userAuth = $this->Session->read('LdapUserAuthenticationLevel');
	
	if ($this->params['action'] == 'add')
		echo '<h2><i class="icon-plus"></i> Ajouter un matériel</h2>';
	else 
		echo '<h2><i class="icon-edit"></i> Éditer un matériel</h2>';
	
	//Create form
	echo $this->Form->create();
	echo $this->Form->input('designation', array('label' => 'Désignation'));
	if ($this->params['action'] == 'add') {
		//Afficher les choix par défaut pour catégorie/sous catégorie
		asort($this->viewVars['categories']);
		echo $this->Form->input('categorie_id', array(
			'label' => 'Catégorie', 'empty' => 'Choisir une catégorie', 'selected' => '', 'style' => 'width: 200px'));
		echo $this->Form->input('sous_categorie_id', array(
			'label' => 'Sous catégorie', 'empty' => 'Choisir une sous-catégorie', 'selected' => '', 
			'options' => array(), 'style' => 'width: 200px'));
	}
	else {
		echo $this->Form->input('categorie_id', array('label' => 'Catégorie', 'style' => 'width: 200px'));
		echo $this->Form->input('sous_categorie_id', array('label' => 'Sous catégorie', 'style' => 'width: 200px'));
		echo $this->Form->input('materiel_administratif', array('label' => 'Matériel inventoriable'));
		echo $this->Form->input('materiel_technique', array('label' => 'Matériel non inventoriable et technique'));
	}
	echo $this->Form->input('description');
	echo $this->Form->input('lieu_stockage', array('label' => 'Lieu de stockage', 
		'options' => array('B'=>'Belin', 'R'=>'Roche', 'T'=>'Tarbes', 'C'=>'CNES', 'A'=>'Autre'), 'style' => 'width: 100px'));
	echo $this->Form->input('lieu_detail', array('label' => 'Lieu de stockage (pièce)'));
	echo $this->Form->input('date_acquisition', array('label' => 'Date d\'acquisition'));
	echo $this->Form->input('numero_serie', array('label' => 'Numéro de série'));
	echo $this->Form->input('groupes_thematique_id', array('label' => 'Groupe thématique', 'style' => 'width: 100px'));
	echo $this->Form->input('groupes_metier_id', array('label' => 'Groupe métier', 'style' => 'width: 100px'));
	
	$utilisateur = ClassRegistry::init('Utilisateur');
	echo $this->Form->input('nom_responsable', array(
		'options' => $utilisateur->getLdapUsers(), 
		'empty' => 'Choisir un utilisateur', 
		'selected' => $this->Session->read('UserName'),
		'label' => 'Nom du responsable'));
	echo $this->Form->input('email_responsable', array(
		'label' => 'Email du responsable', 
		'value' => $utilisateur->getEmailFromLdapName($this->Session->read('LdapUserName')), 
		'readonly' => true));
	if ($userAuth >= 3) {
		echo '<div style="border-top: 1px solid #CCC; border-bottom: 1px solid #CCC; margin-bottom: 0; background: #EEE;"><span style="font-size: 9px; color: red;">Partie administrative</span>';
		echo $this->Form->input('organisme', array(
			'options' => array('UPS'=> 'UPS', 'CNRS' => 'CNRS'), 'style' => 'width: 100px'));
		echo $this->Form->input('fournisseur');
		if ($this->Session->read('LdapUserAuthenticationLevel') >= 3) {
			echo $this->Form->input('prix_ht', array('label' => 'Prix HT (€)'));
			echo $this->Form->input('eotp', array('label' => 'EOTP (Centre de crédit)'));
		}
		echo $this->Form->input('numero_commande', array('label' => 'Numéro de commande'));
		echo $this->Form->input('code_comptable', array('label' => 'Code comptable'));
		echo $this->Form->input('numero_inventaire_organisme', array('label' => 'Numéro inventaire organisme'));
		echo '</div>';
	}
		
	echo $this->Form->hidden('numero_irap');
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
$this->Js->get('#MaterielCategorieId')->event('change', 
	$this->Js->request(array('controller' => 'sousCategories', 'action'=>'getByCategorie'), 
		array(
			'update' => '#MaterielSousCategorieId',
			'async' => true, 'method' => 'post', 'dataExpression' => true,
			'data' => $this->Js->serializeForm(array('isForm' => true, 'inline' => true))
	)));
$this->Js->get('#MaterielNomResponsable')->event('change', 
	'$.ajax({
		url: "/Inventirap/cakephp/utilisateurs/getLdapEmail/" + $("#MaterielNomResponsable").val()
	}).done(function(data) { 
		$("#MaterielEmailResponsable").val(data)
	})');
echo $this->Js->writeBuffer();

?>