
<div class="<?php echo $pluralVar;?> view">
<h2><?php 
	echo ${$singularVar}[$modelClass]['designation'];
	echo ' <span style="font-size: 70%; color: grey;">('.${$singularVar}[$modelClass]['irap_number'].'IRAP-12-0001)</span>';
?></h2>
<?php echo $this->Html->script('script'); ?>
<h3 style="cursor: pointer; text-decoration: underline;" onclick="hide_show('informations');">
	Informations
</h3>
<div id="informations" style="border: 1px solid #CCC; margin-bottom: 20px; padding: 10px;">
<table>
	<tr><th style="width: 250px;"></th><th></th></tr>
<?php
	if(${$singularVar}[$modelClass]['isAdministrative'] && ${$singularVar}[$modelClass]['isTechnical'])
		$type = 'Administratif et technique';
	else if (${$singularVar}[$modelClass]['isAdministrative'])
		$type = 'Administratif';
	else if (${$singularVar}[$modelClass]['isTechnical'])
		$type = 'Technique';
	else
		$type = 'Aucun'; 

	$sousCategorie = $this->Html->link(${$singularVar}['SubCategory']['name'], array(
				'controller' => 'sub_categories',
				'action' => 'view',
				${$singularVar}['SubCategory']['id']));
	$groupeThematique = $this->Html->link(${$singularVar}['ThematicGroup']['name'], array(
				'controller' => 'thematic_groups',
				'action' => 'view',
				${$singularVar}['ThematicGroup']['id']));
	$groupeTravail = $this->Html->link(${$singularVar}['WorkGroup']['name'], array(
				'controller' => 'work_groups',
				'action' => 'view',
				${$singularVar}['WorkGroup']['id']));

	displayElement('Description', ${$singularVar}[$modelClass]['description']);
	displayElement('Type du matériel', $type);
	displayElement('Catégorie', $sousCategorie);
	displayElement('Sous catégorie', $sousCategorie);
	displayElement('Groupe thématique', $groupeThematique);
	displayElement('Groupe de travail', $groupeTravail);
	displayElement('Date d\'aquisition', ${$singularVar}[$modelClass]['acquisition_date']);
	displayElement('Organisme', ${$singularVar}[$modelClass]['organism']);
	displayElement('Status', ${$singularVar}[$modelClass]['status']);
	displayElement('Fournisseur', ${$singularVar}[$modelClass]['supplier_name']);
	displayElement('Prix (HT)', ${$singularVar}[$modelClass]['price_ht'].'€');
	displayElement('EOTP', ${$singularVar}[$modelClass]['eotp']);
	displayElement('N° commande', ${$singularVar}[$modelClass]['command_number']);
	displayElement('Code comptable', ${$singularVar}[$modelClass]['accountable_code']);
	displayElement('N° de série', ${$singularVar}[$modelClass]['serial_number']);
	displayElement('Lieu de stockage', ${$singularVar}[$modelClass]['full_storage']);
	displayElement('Responsable', $this->Html->link(${$singularVar}[$modelClass]['user_name'], 'mailto:'.${$singularVar}[$modelClass]['user_mail']));
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

<?php
	//Affichage de facon TRES CRADE du QR code du matériel
	//echo '<img src="/Inventirap/cakephp/qr_codes/qrCode/'.${$singularVar}[$modelClass]['id'].'"/>';
?>
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
