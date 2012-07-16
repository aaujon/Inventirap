<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>Inventirap - Inventaire administratif et technique de l'IRAP</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('inventirap');
		echo $this->Html->css('font-awesome');
		echo $this->Html->script('jquery.min'); 	
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<?php echo $this->Html->image('logo_inventirap.jpg', array(
				'alt' => 'Logo Inventirap', 
				'border' => '0', 
				'height' => '80px',
				'url' => '/')); ?>
			<div class="user">
				<?php
					$userName = $this->Session->read('UserName');
					if (isset($userName)) {
						echo 'Bienvenue '.$userName.'<br/>';
						echo $this->Html->link('Se déconnecter', array('controller' => 'Utilisateurs', 'action' => 'logout')); 
					}
					else {
						echo 'Bienvenue invité<br/>';
						echo $this->Html->link('Se connecter', array('controller' => 'Utilisateurs', 'action' => 'login')); 
					}
				?>
			</div>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->image('logo_irap.jpg', array('alt' => 'Logo IRAP', 'border' => '0', 'height' => '50px')); ?>
		</div>
	</div>
</body>
</html>
