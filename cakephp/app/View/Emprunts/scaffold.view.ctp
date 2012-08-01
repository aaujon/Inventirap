<div class="<?php echo $pluralVar;?> view">
<h2>Détail emprunt</h2>
	<table style="margin-bottom: 30px;">
		<tr><th style="width: 250px;"></th><th></th></tr>
		<?php
		$materiel = $this->Html->link(${$singularVar}['Materiel']['designation'], array(
				'controller' => 'materiels', 'action' => 'view', ${$singularVar}['Materiel']['id']));
		$interneExterne = 'Externe';
		$lieuStockage = ${$singularVar}[$modelClass]['laboratoire'];
		if (${$singularVar}[$modelClass]['emprunt_interne'] == 1) {
			$interneExterne = 'Interne';
			$lieuStockage = ${$singularVar}[$modelClass]['e_lieu_stockage'].'-'.${$singularVar}[$modelClass]['e_lieu_detail'];
		}
			
		displayElement('Matériel concerné', $materiel);
		
		setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
		
		displayElement('Date de l\'emprunt', strftime("%e %B %Y", strtotime(${$singularVar}[$modelClass]['date_emprunt'])));
		displayElement('Date de retour', strftime("%e %B %Y", strtotime(${$singularVar}[$modelClass]['date_retour_emprunt'])));
		displayElement('Type d\'emprunt', $interneExterne);
		displayElement('Lieu de stockage', $lieuStockage);
		displayElement('Responsable', ${$singularVar}[$modelClass]['nom_emprunteur']);
		?>
	</table>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('menu_view');
	?>
</div>

<?php
function displayElement($nom, $valeur) {
	if ($valeur != "")
		echo '<tr><td><strong>'.$nom.' </strong></td><td>'.$valeur.'</td></tr>';
}
?>