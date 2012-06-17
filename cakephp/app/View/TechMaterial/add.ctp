<div class="movies form">
<?php
	echo $this->Form2->create('TechMaterial');
	
	echo $this->Form2->input('model');
	echo $this->Form2->input('caracteristic');
	echo $this->Form2->input('serial_number');
	echo $this->Form2->input('have_primary_accessory');
	echo $this->Form2->input('sub_category_id');
	echo $this->Form2->input('accessory');
	echo $this->Form2->input('name_user');
	echo $this->Form2->input('mail_user');
	echo $this->Form2->input('status');
	
	echo $this->Form2->end('Ajouter');
?>
</div>

<div class="actions">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $this->Html->link('Liste des materiels techniques', array('action' => 'index'));?></li>
	</ul>
</div>
