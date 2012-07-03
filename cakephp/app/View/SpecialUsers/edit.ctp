
<?php

	echo $this->Form->create('SpecialUser', array('action' => 'edit'));
    echo $this->Form->input('Ldap');
    echo $this->Form->input('Role');
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end('Edit user');
    
?>