<?php echo $this->Html->script('script'); ?>
<div class="<?php echo $pluralVar;?> view">
<h2><?php 
	echo ${$singularVar}[$modelClass]['designation'];
	echo ' <span style="font-size: 70%; color: grey;">('.${$singularVar}[$modelClass]['numero_irap'].')</span>';
?></h2>

<h3 id="t_informations">
	<i class="icon-chevron-down" style="font-size: 14px;" id="i_informations"></i> 
	<span style="cursor: pointer; text-decoration: underline;">Informations</span>
</h3>
<div id="informations" style="margin-bottom: 20px;">
<table>
	<tr><th style="width: 250px;"></th><th></th></tr>
<?php
	if(${$singularVar}[$modelClass]['materiel_administratif'] && ${$singularVar}[$modelClass]['materiel_technique'])
		$type = 'Administratif et technique';
	else if (${$singularVar}[$modelClass]['materiel_administratif'])
		$type = 'Administratif';
	else if (${$singularVar}[$modelClass]['materiel_technique'])
		$type = 'Technique';
	else
		$type = 'Aucun'; 

	$categorie = $this->Html->link(${$singularVar}['Category']['nom'], array(
				'controller' => 'categories',
				'action' => 'view',
				${$singularVar}['Category']['id']));
	$sousCategorie = $this->Html->link(${$singularVar}['SousCategory']['nom'], array(
				'controller' => 'sous_categories',
				'action' => 'view',
				${$singularVar}['SousCategory']['id']));
	$groupeThematique = $this->Html->link(${$singularVar}['ThematicGroup']['nom'], array(
				'controller' => 'thematic_groups',
				'action' => 'view',
				${$singularVar}['ThematicGroup']['id']));
	$groupeTravail = $this->Html->link(${$singularVar}['WorkGroup']['nom'], array(
				'controller' => 'work_groups',
				'action' => 'view',
				${$singularVar}['WorkGroup']['id']));

	displayElement('Description', ${$singularVar}[$modelClass]['description']);
	displayElement('Type du matériel', $type);
	displayElement('Catégorie', $categorie);
	displayElement('Sous catégorie', $sousCategorie);
	displayElement('Groupe thématique', $groupeThematique);
	displayElement('Groupe de travail', $groupeTravail);
	displayElement('Date d\'aquisition', ${$singularVar}[$modelClass]['date_acquisition']);
	displayElement('Organisme', ${$singularVar}[$modelClass]['organisme']);
	displayElement('Status', ${$singularVar}[$modelClass]['status']);
	displayElement('Fournisseur', ${$singularVar}[$modelClass]['fournisseur']);
	displayElement('Prix (HT)', ${$singularVar}[$modelClass]['prix_ht'].'€');
	displayElement('EOTP', ${$singularVar}[$modelClass]['eotp']);
	displayElement('N° commande', ${$singularVar}[$modelClass]['numero_commande']);
	displayElement('Code comptable', ${$singularVar}[$modelClass]['code_comptable']);
	displayElement('N° de série', ${$singularVar}[$modelClass]['numero_serie']);
	displayElement('Lieu de stockage', ${$singularVar}[$modelClass]['full_storage']);
	displayElement('Responsable', $this->Html->link(${$singularVar}[$modelClass]['nom_responsable'], 'mailto:'.${$singularVar}[$modelClass]['email_responsable']));
?>
</table>
</div>


<h3 id="t_suivis">
	<i class="icon-chevron-up" style="font-size: 14px;" id="i_suivis"></i> 
	<span style="cursor: pointer; text-decoration: underline;">Suivi(s) du matériel</span>
</h3>
<div id="suivis" style="margin-bottom: 20px; display: none;">
	<table> 
		<tr> 
			<th>Organisme</th><th>Date du contrôle</th><th>Date prochain contrôle</th><th>Type d'intervention</th><th>Détail</th>
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
</div>




<h3 id="t_emprunts">
	<i class="icon-chevron-up" style="font-size: 14px;" id="i_emprunts"></i> 
	<span style="cursor: pointer; text-decoration: underline;">Emprunt(s) du matériel</span>
</h3>
<div id="emprunts" style="display: none;">
	<table> 
		<tr> 
			<th>Responsable</th><th>Date de l'emprunt</th><th>Date de retour</th><th>Détail</th>
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
