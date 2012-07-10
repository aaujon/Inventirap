<div class="<?php echo $pluralVar;?> form">
<?php
	$type = '';
	if (isset($this->passedArgs['adm']) && isset($this->passedArgs['tec']))
		if ($this->passedArgs['adm'] == 1 && $this->passedArgs['tec'] == 1)
			$type = 'administratif et technique';
		else if ($this->passedArgs['adm'] == 1)
			$type = 'administratif';
		else if ($this->passedArgs['tec'] == 1)
			$type = 'technique';

	if ($this->params['action'] == 'add')
		echo '<h2><i class="icon-plus"></i> Ajouter un '.strtolower($singularHumanName).' '.$type.'</h2>';
	else 
		echo '<h2><i class="icon-edit"></i> Éditer un '.strtolower($singularHumanName).' '.$type.'</h2>';
	
	if ($this->params['action'] == 'add' && !isset($this->passedArgs['adm']) && !isset($this->passedArgs['tec'])) {
		echo '<div class="actions" style="float: none; width: 100%;">';
		echo 'Veuillez choisir le type de matériel à ajouter: ';
		echo $this->Html->link('Administratif', array(
				'controller' => 'materiels', 'action' => 'add', 'adm' => 1, 'tec' => 0)).' ';
		echo $this->Html->link('Technique', array(
				'controller' => 'materiels', 'action' => 'add', 'adm' => 0, 'tec' => 1)).' ';
		echo $this->Html->link('Administratif et technique', array(
				'controller' => 'materiels', 'action' => 'add', 'adm' => 1, 'tec' => 1));
		echo '</div>';
	}
	else {
		
		//Create form
		echo $this->Form->create();
		echo $this->Form->input('designation', array('label' => 'Désignation'));
		if ($this->params['action'] == 'add') {
			//Afficher les choix par défaut pour catégorie/sous catégorie
			asort($this->viewVars['categories']);
			echo $this->Form->input('category_id', array(
				'label' => 'Catégorie', 'empty' => 'Choisir une catégorie', 'selected' => '', 'style' => 'width: 200px'));
			echo $this->Form->input('sous_category_id', array(
				'label' => 'Sous catégorie', 'empty' => 'Choisir une sous-catégorie', 'selected' => '', 
				'options' => array(), 'style' => 'width: 200px'));
			
			//Champs hidden
			echo $this->Form->hidden('materiel_administratif', array('value' => $this->passedArgs['adm']));
			echo $this->Form->hidden('materiel_technique', array('value' => $this->passedArgs['tec']));

		}
		else {
			echo $this->Form->input('category_id', array('label' => 'Catégorie', 'style' => 'width: 200px'));
			echo $this->Form->input('sous_category_id', array('label' => 'Sous catégorie', 'style' => 'width: 200px'));
		}
		echo $this->Form->input('description');
		if ($type != 'administratif') {
			echo $this->Form->input('organisme', array(
				'options' => array('UPS'=> 'UPS', 'CNRS' => 'CNRS'), 'style' => 'width: 100px'));
			echo $this->Form->input('fournisseur');
			if ($this->Session->read('LdapUserAuthenticationLevel') >= 3) {
				echo $this->Form->input('prix_ht', array('label' => 'Prix HT (€)'));
				echo $this->Form->input('eotp', array('label' => 'EOTP (Centre de crédit)', 'style' => 'width: 100px', 
					'options' => array('Xlab'=>'Xlab', 'SIFAC'=> 'SIFAC')));
			}
			echo $this->Form->input('numero_commande', array('label' => 'Numéro de commande'));
			echo $this->Form->input('code_comptable', array('label' => 'Code comptable'));
			echo $this->Form->input('ref_existante', array('label' => 'Référence existante'));
		}
		
		echo $this->Form->input('lieu_stockage', array('label' => 'Lieu de stockage', 
			'options' => array('B'=>'Belin', 'R'=>'Roche', 'T'=>'Tarbes', 'C'=>'CNES', 'A'=>'Autre'), 'style' => 'width: 100px'));
		echo $this->Form->input('lieu_detail', array('label' => 'Lieu de stockage (pièce)'));
		echo $this->Form->input('date_acquisition', array('label' => 'Date d\'acquisition'));
		echo $this->Form->input('numero_serie', array('label' => 'Numéro de série'));
		echo $this->Form->input('thematic_group_id', array('label' => 'Groupe thématique', 'style' => 'width: 100px'));
		echo $this->Form->input('work_group_id', array('label' => 'Groupe de travail', 'style' => 'width: 100px'));
		if ($this->params['action'] == 'add') {
			echo $this->Form->input('nom_responsable', array('label' => 'Nom du responsable', 
				'value' => $this->Session->read('UserName'), 'readonly' => true));
			echo $this->Form->input('email_responsable', array('label' => 'Email du responsable', 
				'value' => $this->Session->read('LdapUserMail'), 'readonly' => true));
		}
		echo $this->Form->hidden('numero_irap');
		echo $this->Form->end('Valider');
	}
	
?>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('tools_form');
	?>
</div>
<?php
$this->Js->get('#MaterielCategoryId')->event('change', 
	$this->Js->request(array('controller' => 'sousCategories', 'action'=>'getByCategory'), 
		array(
			'update' => '#MaterielSousCategoryId',
			'async' => true, 'method' => 'post', 'dataExpression' => true,
			'data' => $this->Js->serializeForm(array('isForm' => true, 'inline' => true))
	)));
echo $this->Js->writeBuffer();
?>