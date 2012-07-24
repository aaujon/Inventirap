<div class="<?php echo $pluralVar;?> view">
<h2>Détail utilisateur</h2>
	<table style="margin-bottom: 30px;">
		<tr><th style="width: 250px;"></th><th></th></tr>
		<?php
		displayElement('Nom', ${$singularVar}[$modelClass]['nom']);
		displayElement('Rôle', ${$singularVar}[$modelClass]['role']);
		displayElement('Groupe métier', ${$singularVar}['GroupesMetier']['nom']);
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
	if ($valeur != '' && $valeur != 'N/A')
		echo '<tr><td><strong>'.$nom.' </strong></td><td>'.$valeur.'</td></tr>';
}
?>