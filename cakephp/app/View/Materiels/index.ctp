<?php
	$userAuth = $this->Session->read('LdapUserAuthenticationLevel');

	$toShow = array(
		'designation' => 'Désignation',
		'numero_irap' => 'Numéro IRAP',
		'categorie_id' => 'Catégorie',
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
	echo '<td class="smallText">'.$this->Html->link($result['Materiel'][$_field], array('action' => 'view', $id)).'</td>';
	echo '<td class="smallText">'.$result['Materiel']['numero_irap'].'</td>';
	echo '<td class="smallText">'.$result['Categorie']['nom'].'</td>';
	echo '<td class="smallText">'.$result['Materiel']['nom_responsable'].'</td>';
	echo '<td class="smallText">'.$statut.'</td>';
	echo $this->element('materiel_actions', array('id' => $id, 'statut' => $statut, 'delete' => ($statut == 'CREATED')));
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
