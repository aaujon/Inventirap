<div class="index">
	<h2><i class="icon-home"></i> Inventirap</h2>
	<p>Bienvenue sur l'inventaire administratif et technique de l'IRAP.</p>
	<?php
		$userName = $this->Session->read('LdapUserName');
		$userAuth = $this->Session->read('LdapUserAuthenticationLevel');
		if (!isset($userName)) {
			//Non connecté
			echo '<p>Vous n\'êtes pas connecté, veuillez vous authentifier sur la page de ';
			echo $this->Html->link('connexion', array('controller' => 'utilisateurs', 'action' => 'login'));
			echo '.</p>';
		}
		else {
			//Utilisateur connecté
			echo '<p>Vous êtes connecté avec l\'utilisateur <b>' . $userName . '</b> ';
				echo 'et avec le niveau d\'autentification <b>';
				switch ($userAuth) {
					case 1: echo 'Apprenti'; break;	
					case 2: echo 'Responsable'; break;	
					case 3: echo 'Administrateur'; break;	
					case 4: echo 'Super administrateur'; break;	
					default : $userAuth;
				}
			echo '</b>.</p>';
			if ($userAuth >= 3) {
				//Utilisateur admin/super admin
				?>
				<table cellpadding="0" cellspacing="0" style="width: 400px;">
					<tr><th>Actions</th></tr>
					<tr><td><?php echo $this->Html->link('Voir les matériels à valider', array(
						'controller' => 'materiels', 'action' => 'find', 'toValidate')); ?></td></tr>
					<tr><td><?php echo $this->Html->link('Voir les matériels à sortir de l\'inventaire', array(
						'controller' => 'materiels', 'action' => 'find', 'toBeArchived')); ?></td></tr>
				</table>	
				<?php
			}
		}
	?>
</div>
<div class="actions">
	<?php echo $this->element('menu') ?>
</div>