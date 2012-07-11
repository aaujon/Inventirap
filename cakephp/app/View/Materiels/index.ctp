<?php
	$userAuth = $this->Session->read('LdapUserAuthenticationLevel');

	$toShow = array(
		'designation' => 'Désignation',
		'numero_irap' => 'Numéro IRAP',
		'category_id' => 'Catégorie',
		'nom_responsable' => 'Responsable',
		'status' => 'Statut'
	);
?>
<div class="index">
<h2><i class="icon-list"></i> Liste des matériels</h2>
<table cellpadding="0" cellspacing="0">
<tr>
	<?php foreach ($toShow as $_field => $label): ?>
	<th><?php echo $this->Paginator->sort($_field, $label); ?></th>
	<?php endforeach;?>
	<th style="width:20px;"></th>
	<th style="width:20px;"></th>
	<th style="width:20px;"></th>
</tr>
<?php
$i = 0;
foreach ($data as $result):
	$id = 		$result['Materiel']['id'];
	$statut = 	$result['Materiel']['status'];
	echo '<tr>';
		foreach ($toShow as $_field => $label) {
			echo '<td class="smallText">';
			if ($_field == 'category_id')
				echo  $this->Html->link($result['Category']['nom'], 
					array('controller' => 'categories', 'action' => 'view', $result['Category']['id']));
			else
				echo h($result['Materiel'][$_field]);
			echo '</td>';
	}
	echo $this->element('materiel_actions', array('id' => $id, 'statut' => $statut));
	echo '</tr>';

endforeach;

?>
</table>
	<p><?php
	echo $this->Paginator->counter(array(
		'format' => __d('cake', 'Page {:page} sur {:pages}')
	));
	?></p>
	<div class="paging">
	<?php
		echo $this->Paginator->first('<<', array('class' => 'prev')).' ';
		echo $this->Paginator->prev('< ' . __d('cake', ''), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__d('cake', '') .' >', array(), null, array('class' => 'next disabled'));
		echo ' '.$this->Paginator->last('>>', array('class' => 'next', 'style' => 'border-left: 1px solid #CCC'));
	?>
	</div>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('tools_view', array(
			'pluralHumanName' => 'Matériels',
			'singularHumanName' => 'matériel'));
	?>
</div>
