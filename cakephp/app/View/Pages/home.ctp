<div class="index">
	<h2><i class="icon-home"></i> Accueil</h2>
	<p>Bienvenue sur l'inventaire administratif et technique de l'IRAP.</p>
	<?php
		$userName = $this->Session->read('UserName');
		$userAuth = $this->Session->read('LdapUserAuthenticationLevel');
		if (!isset($userName)) {
			//Non connecté
			echo '<p>Vous n\'êtes pas connecté, veuillez vous authentifier.';
			echo $this->Form->create('Utilisateur', array('action' => 'login'));
			echo $this->Form->input('ldap', array('label' => 'Login (LDAP)', 'div' => 'input required'));
			echo $this->Form->input('password', array('div' => 'input required'));
			echo $this->Form->end('Se connecter');
			echo '</p>';
		}
		else {
			//Utilisateur connecté
			echo '<p>Vous êtes connecté avec l\'utilisateur <b>' . $userName . '</b> ';
			echo 'et avec le niveau d\'autentification <b>';
			echo ClassRegistry::init('Utilisateur')->getRoleFromAuthenticationLevel($userAuth);	
			echo '</b>.</p>';
			if ($userAuth >= 3) {
				//Utilisateur admin/super admin
				?>
				<table cellpadding="0" cellspacing="0" style="width: 800px;">
					<tr><th></th></tr>
					<tr><td><?php echo $this->Html->link('Voir les matériels à valider', array(
						'controller' => 'materiels', 'action' => 'index', 'what' => 'toValidate')); ?></td></tr>
					<tr><td><?php echo $this->Html->link('Voir les matériels à sortir de l\'inventaire', array(
						'controller' => 'materiels', 'action' => 'index', 'what' => 'toBeArchived')); ?></td></tr>
				</table>	
				<?php
			}
		}
	?>
</div>
<div class="actions">
	<?php echo $this->element('menu') ?>
</div>