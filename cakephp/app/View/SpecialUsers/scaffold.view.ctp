<?php echo $this->Html->script('script'); ?>
<div class="<?php echo $pluralVar;?> view">
	<h2><?php echo ${$singularVar}[$modelClass]['ldap']; ?></h2>
	
	<table>
		<tr><th style="width: 250px;"></th><th></th></tr>
		<tr><td><strong>Role</strong></td><td><?php echo ${$singularVar}[$modelClass]['role']; ?></td></tr>
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
