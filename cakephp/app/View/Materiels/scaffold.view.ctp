<?php 
	$userAuth = $this->Session->read('LdapUserAuthenticationLevel');
	echo $this->Html->script('script'); 
?>
<div class="<?php echo $pluralVar;?> view">
<h2><?php 
	echo ${$singularVar}[$modelClass]['designation'];
	echo ' <span style="font-size: 70%; color: grey;">('.${$singularVar}[$modelClass]['numero_irap'].')</span>';
	
	$qrCodeName = $this->requestAction('/QrCodes/creer/' . ${$singularVar}[$modelClass]['numero_irap']);
	echo $this->Html->image($qrCodeName, array(
		'alt' => 'QrCode : '.${$singularVar}[$modelClass]['numero_irap'],
		'style' => 'float: right'));
?></h2>

<div class="actions" style="margin-bottom: 20px; width: 100%; float: none; padding: 10px 0;"><?php			
	$id = ${$singularVar}[$modelClass]['id'];
	$statut = ${$singularVar}[$modelClass]['status'];
	$administratif = ${$singularVar}[$modelClass]['materiel_administratif'];
	$technique = ${$singularVar}[$modelClass]['materiel_technique'];
	$them_groupe = ${$singularVar}['ThematicGroup']['nom'];
	$trav_groupe = ${$singularVar}['WorkGroup']['nom'];
	
	if ($statut == 'CREATED' && $userAuth >= 2) {
		//Responsable/Admin/Super admin peuvent valider le matériel
		echo $this->Html->link('<i class="icon-ok-sign"></i> Valider le matériel', 
			array('action' => 'statusValidated', $id, 'view'), 
			array('title' => 'Valider', 'style' => 'margin-right: 20px', 'escape' => false));
	}
    else if (($statut == 'VALIDATED' || $statut == 'TOBEARCHIVED') && $userAuth >= 3) {
    	//Admin/Super admin peuvent archiver matériel
		echo $this->Form->postLink('<i class="icon-inbox"></i> Archiver le matériel',
			array('action' => 'statusArchived', $id, 'view'), 
			array('title' => 'Archiver', 'style' => 'margin-right: 20px', 'escape' => false),
			'Êtes-vous sur d\'archiver '.$id.' ?');
	}
	else if ($statut == 'VALIDATED') {
		//Les autres ne peuvent que demander la demande d'archivage
		echo $this->Html->link('<i class="icon-inbox"></i> Demander l\'archivage du matériel', 
			array('action' => 'statusToBeArchived', $id, 'view'), 
			array('title' => 'Demander l\'archivage', 'style' => 'margin-right: 20px', 'escape' => false));
	}
	echo $this->Html->link('<i class="icon-plus"></i> Nouveau suivi', 
		array('controller' => 'suivis', 'action' => 'add', 'mat' => $id), array('escape' => false));
	echo $this->Html->link('<i class="icon-plus"></i> Nouvel emprunt', 
		array('controller' => 'emprunts', 'action' => 'add', 'mat' => $id), array('style' => 'margin-left: 5px', 'escape' => false));
?></div>

<h3 id="t_informations" style="cursor: pointer;">
	<i class="icon-chevron-down" style="font-size: 14px;" id="i_informations"></i> 
	<span style="text-decoration: underline;">Informations</span>
</h3>
<div id="informations" style="margin-bottom: 20px;">
<table>
	<tr><th style="width: 250px;"></th><th></th></tr>
<?php
	if($administratif && $technique)
		$type = 'Administratif et technique';
	else if ($administratif)
		$type = '';			//Si administratif ne pas le montrer
	else if ($technique)
		$type = 'Technique';
	else
		$type = 'Aucun'; 

	//Catégorie/Sous catégorie
	$categorie = $this->Html->link(${$singularVar}['Category']['nom'], array(
				'controller' => 'categories',
				'action' => 'view',
				${$singularVar}['Category']['id']));
	$sousCategorie = $this->Html->link(${$singularVar}['SousCategory']['nom'], array(
				'controller' => 'sous_categories',
				'action' => 'view',
				${$singularVar}['SousCategory']['id']));
				
	//Groupe thématique/travail
	$groupeThematique = '';
	$groupeTravail = '';
	if ($them_groupe != 'N/A')
		$groupeThematique = $this->Html->link($them_groupe, array(
				'controller' => 'thematic_groups',
				'action' => 'view',
				${$singularVar}['ThematicGroup']['id']));
	if ($trav_groupe != 'N/A')
		$groupeTravail = $this->Html->link($trav_groupe, array(
				'controller' => 'work_groups',
				'action' => 'view',
				${$singularVar}['WorkGroup']['id']));

	$statut = ${$singularVar}[$modelClass]['status'].'<span class="actions">';
	if (${$singularVar}[$modelClass]['status'] == 'CREATED') {
		if (($userAuth >= 2) && ($userAuth != 4))
			$statut .= ' '.$this->Html->link('Valider', 
				array('action' => 'statusValidated', ${$singularVar}[$modelClass][$primaryKey]));
		if (($userAuth >= 1) && ($userAuth != 4))
			$statut .= ' '.$this->Html->link('Archiver', 
				array('action' => 'statusToBeArchived', ${$singularVar}[$modelClass][$primaryKey]));
	}
	if (${$singularVar}[$modelClass]['status'] == 'VALIDATED') {
		if ($userAuth == 3)
			$statut .= ' '.$this->Html->link('Archiver', 
				array('action' => 'statusArchived', ${$singularVar}[$modelClass][$primaryKey]));
	}
	$statut .= '</span>';


	displayElement('Description', ${$singularVar}[$modelClass]['description']);
	displayElement('Type du matériel', $type);
	displayElement('Catégorie', $categorie);
	displayElement('Sous catégorie', $sousCategorie);
	displayElement('Groupe thématique', $groupeThematique);
	displayElement('Groupe de travail', $groupeTravail);
	displayElement('Date d\'aquisition', ${$singularVar}[$modelClass]['date_acquisition']);
	displayElement('Statut', $statut);
	if ($type != '') {
		displayElement('Organisme', ${$singularVar}[$modelClass]['organisme']);
		displayElement('Fournisseur', ${$singularVar}[$modelClass]['fournisseur']);
		displayElement('Prix (HT)', ${$singularVar}[$modelClass]['prix_ht'].'€');
		displayElement('EOTP', ${$singularVar}[$modelClass]['eotp']);
		displayElement('N° commande', ${$singularVar}[$modelClass]['numero_commande']);
		displayElement('Code comptable', ${$singularVar}[$modelClass]['code_comptable']);
		displayElement('N° de série', ${$singularVar}[$modelClass]['numero_serie']);
	}
	displayElement('Lieu de stockage', ${$singularVar}[$modelClass]['full_storage']);
	displayElement('Responsable', $this->Html->link(
		${$singularVar}[$modelClass]['nom_responsable'], 'mailto:'.${$singularVar}[$modelClass]['email_responsable']));
?>
</table>
</div>


<h3 id="t_suivis" style="cursor: pointer;">
	<i class="icon-chevron-up" style="font-size: 14px;" id="i_suivis"></i> 
	<span style="text-decoration: underline;">Suivi(s) du matériel (<?php echo sizeof(${$singularVar}['Suivi']); ?>)</span>
</h3>
<div id="suivis" style="margin-bottom: 20px; display: none;">
	<?php if (sizeof(${$singularVar}['Suivi']) == 0) { echo 'Aucun suivi pour ce matériel.'; } else { ?>
	<table> 
		<tr> 
			<th>Organisme</th>
			<th>Date du contrôle</th>
			<th>Date prochain contrôle</th>
			<th>Type d'intervention</th>
			<th style="width:50px;">Détail</th>
		</tr> 
		
		<?php foreach (${$singularVar}['Suivi'] as $suivi): ?> 
		<tr>
			<td><?php echo $suivi['organisme']; ?></td>
			<td><?php echo $suivi['date_controle']; ?></td> 
			<td><?php echo $suivi['date_prochain_controle']; ?></td>
			<td><?php echo $suivi['type_intervention']; ?></td>
			<td class="actions"><?php echo $this->Html->link('<i class="icon-search"></i>', 
				array('controller' => 'suivis', 'action' => 'view', $suivi['id']), 
				array('escape' => false, 'style' => 'margin:0')); ?></td> 
		</tr> 
		<?php endforeach; ?> 
	</table> 
	<?php } ?>
</div>




<h3 id="t_emprunts" style="cursor: pointer;">
	<i class="icon-chevron-up" style="font-size: 14px;" id="i_emprunts"></i> 
	<span style="text-decoration: underline;">Emprunt(s) du matériel (<?php echo sizeof(${$singularVar}['Emprunt']); ?>)</span>
</h3>
<div id="emprunts" style="display: none;">
	<?php
	echo $this->Html->link('Nouvel emprunt', array(
				'controller' => 'emprunts',
				'action' => 'add',
				${$singularVar}[$modelClass][$primaryKey]), array('class' => 'actions'));
				?>
	<?php if (sizeof(${$singularVar}['Emprunt']) == 0) { echo 'Aucun emprunt pour ce matériel.'; } else { ?>
	<table> 
		<tr> 
			<th>Responsable</th><th>Date de l'emprunt</th><th>Date de retour</th><th style="width:50px;">Détail</th>
		</tr> 
		
		<?php foreach (${$singularVar}['Emprunt'] as $emprunt): ?> 
		<tr>
			<td><?php echo $emprunt['responsable']; ?></td> 
			<td><?php echo $emprunt['date_emprunt']; ?></td>
			<td><?php echo $emprunt['date_retour_emprunt']; ?></td>
			<td class="actions"><?php echo $this->Html->link('<i class="icon-search"></i>', 
				array('controller' => 'emprunts', 'action' => 'view', $emprunt['id']), 
				array('escape' => false, 'style' => 'margin:0')); ?></td> 
		</tr> 
		<?php endforeach; ?> 
	</table>
	<?php } ?>
</div>


</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('tools_edit');
	?>
</div>

<?php
function displayElement($nom, $valeur) {
	if ($valeur != "")
		echo '<tr><td><strong>'.$nom.' </strong></td><td>'.$valeur.'</td></tr>';
}
?>
