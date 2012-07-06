<div class="<?php echo $pluralVar;?> form">
<?php
	if ($this->params['action'] == 'add')
		echo '<h2>Ajouter un '.strtolower($singularHumanName).'</h2>';
	else 
		echo '<h2>Éditer un '.strtolower($singularHumanName).'</h2>';
	
	echo $this->Form->create();
	echo $this->Form->input('designation');
	if ($this->params['action'] == 'add') {
		echo $this->Form->input('category_id', 
			array('label' => 'Catégorie', 'empty' => 'Choisir une catégorie', 'selected' => '', 'style' => 'width: 200px'));
		echo $this->Form->input('sous_category_id', 
			array('label' => 'Sous catégorie', 'empty' => 'Choisir une sous-catégorie', 'selected' => '', 'options' => array(), 'style' => 'width: 200px'));
	}
	else {
		echo $this->Form->input('category_id', array('label' => 'Catégorie', 'style' => 'width: 200px'));
		echo $this->Form->input('sous_category_id', array('label' => 'Sous catégorie', 'style' => 'width: 200px'));
	}
	echo $this->Form->input('description');
	echo $this->Form->input('organisme');
	echo $this->Form->input('materiel_administratif', array('label' => 'Matériel administratif'));
	echo $this->Form->input('materiel_technique', array('label' => 'Matériel technique'));
	echo $this->Form->input('lieu_stockage', array('label' => 'Lieu de stockage', 'options' => array('B'=>'Belin', 'R'=>'Roche', 'T'=>'Tarbes', 'C'=>'CNES', 'A'=>'Autre')));
	echo $this->Form->input('lieu_detail', array('label' => 'Détail du lieu'));
	echo $this->Form->input('fournisseur');
	echo $this->Form->input('prix_ht', array('label' => 'Prix HT (€)'));
	echo $this->Form->input('eotp', array('label' => 'EOTP'));
	echo $this->Form->input('numero_commande', array('label' => 'Numéro de commande'));
	echo $this->Form->input('code_comptable', array('label' => 'Code comptable'));
	echo $this->Form->input('numero_serie', array('label' => 'Numéro de série'));
	echo $this->Form->input('thematic_group_id', array('label' => 'Groupe thématique', 'style' => 'width: 100px'));
	echo $this->Form->input('work_group_id', array('label' => 'Groupe de travail', 'style' => 'width: 100px'));
	echo $this->Form->input('ref_existante', array('label' => 'Référence existante'));
	echo $this->Form->input('nom_responsable', array('label' => 'Nom du responsable'));
	echo $this->Form->input('email_responsable', array('label' => 'Email du responsable'));
	echo $this->Form->end(__d('cake', 'Valider'));
?>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('tools_form');
	?>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<?php
$this->Js->get('#MaterielCategoryId')->event('change', 
	$this->Js->request(array('controller' => 'sousCategories', 'action'=>'getByCategory'), 
		array(
			'update'=>'#MaterielSousCategoryId',
			'async' => true,
			'method' => 'post',
			'dataExpression'=>true,
			'data'=> $this->Js->serializeForm(array(
				'isForm' => true,
				'inline' => true
				))
			)
		)
	);
echo $this->Js->writeBuffer();
?>