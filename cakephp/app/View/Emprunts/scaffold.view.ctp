<div class="<?php echo $pluralVar;?> view">
<h2>Détail emprunt</h2>
	<table style="margin-bottom: 30px;">
		<tr><th style="width: 250px;"></th><th></th></tr>
		<?php
		$materiel = $this->Html->link(${$singularVar}['Materiel']['designation'], array(
				'controller' => 'materiels', 'action' => 'view', ${$singularVar}['Materiel']['id']));
		$interneExterne = 'Externe';
		if (${$singularVar}[$modelClass]['emprunt_interne'] == 1)
			$interneExterne = 'Interne';
			
		displayElement('Matériel concerné', $materiel);
		displayElement('Type d\'emprunt', $interneExterne);
		displayElement('Date de l\'emprunt', ${$singularVar}[$modelClass]['date_emprunt']);
		displayElement('Date de retour', ${$singularVar}[$modelClass]['date_retour_emprunt']);
		displayElement('Pièce', ${$singularVar}[$modelClass]['piece']);
		displayElement('Laboratoire', ${$singularVar}[$modelClass]['laboratoire']);
		displayElement('Responsable', ${$singularVar}[$modelClass]['responsable']);
		?>
	</table>
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