<?php
	$userAuth = $this->Session->read('LdapUserAuthenticationLevel');
	
	echo '<td class="actions" style="padding: 6px 0;">';
	echo $this->Html->link('<i class="icon-pencil"></i>', 
		array('action' => 'edit', $id), 
		array('title' => 'Éditer', 'style' => 'margin: 0 2px', 'escape' => false));
	echo '</td>';
	echo '<td class="actions" style="padding: 6px 0;">';
	if ($statut == 'CREATED' && $userAuth >= 2) {
		//Responsable/Admin/Super admin peuvent valider le matériel
		echo $this->Html->link('<i class="icon-ok-sign"></i>', 
			array('action' => 'statusValidated', $id), 
			array('title' => 'Valider', 'style' => 'margin: 0 2px', 'escape' => false));
	}
	if (($statut == 'VALIDATED' || $statut == 'TOBEARCHIVED') && $userAuth == 3) {
    	//Admin peut archiver matériel
		echo $this->Html->link('<i class="icon-inbox"></i>',
			array('action' => 'statusArchived', $id), 
			array('title' => 'Sortir de l\'inventaire', 'style' => 'margin: 0 2px', 'escape' => false),
			'Êtes-vous sur d\'archiver ' . $nom . ' ?');
	}
	else if ($statut == 'VALIDATED') {
		//Les autres ne peuvent que demander la demande d'archivage
		echo $this->Html->link('<i class="icon-inbox"></i>', 
			array('action' => 'statusToBeArchived', $id), 
			array('title' => 'Demander la sortie de l\'inventaire', 'style' => 'margin: 0 2px', 'escape' => false));
	}
	echo '</td>';
	echo '<td class="actions" style="padding: 6px 0;">';
	if ($delete)
		echo $this->Form->postLink('<i class="icon-trash"></i>',
			array('action' => 'delete', $id),
			array('title' => 'Supprimer', 'style' => 'margin: 0 2px', 'escape' => false),
			'Êtes-vous sur de supprimer '.$nom.' ?');
	echo '</td>';
?>