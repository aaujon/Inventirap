<?php  
    echo $this->Form->create('Material', array('action' => 'find')); 
    echo $this->Form->input('designation', array('label' => 'Designation')); 
    echo $this->Form->input('irap_number', array('label' => 'N° IRAP')); 
    echo $this->Form->end('Rechercher'); 
?>