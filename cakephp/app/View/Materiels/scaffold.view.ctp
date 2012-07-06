<?php echo $this->Html->script('script'); ?>
<div class="<?php echo $pluralVar;?> view">
<h2><?php 
	echo ${$singularVar}[$modelClass]['designation'];
	echo ' <span style="font-size: 70%; color: grey;">('.${$singularVar}[$modelClass]['numero_irap'].')</span>';
?></h2>

<h3 style="cursor: pointer; text-decoration: underline;" onclick="hide_show('informations');">Informations</h3>
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
	displayElement('Catégorie', $sousCategorie);
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


<h3 style="cursor: pointer; text-decoration: underline;" onclick="hide_show('suivis');">Suivis</h3>
<div id="suivis" style="border: 1px solid #CCC; margin-bottom: 20px; padding: 10px; display: none;">
TODO
</div>


<h3 style="cursor: pointer; text-decoration: underline;" onclick="hide_show('emprunts');">Emprunts</h3>
<div id="emprunts" style="border: 1px solid #CCC; margin-bottom: 20px; padding: 10px; display: none;">
TODO
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
