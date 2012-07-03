
<?php

	echo $this->Form->create('SpecialUser', array('action' => 'edit'));
    echo $this->Form->input('ldap', array('default' => $special_users['SpecialUser']['ldap']));
    
    echo $this->Form->input('role', array(
		'options' => array('Apprentice' => 'Apprentice','Administrator' => 'Administrator','Super Administrator' => 'Super Administrator'),
		'default' => $special_users['SpecialUser']['role']));
    
    echo $this->Form->input('id', array('type' => 'hidden', 'default' => $special_users['SpecialUser']['id']));
    echo $this->Form->end('Edit SpecialUser');
    
?>