<?php  
    echo $this->Form->create('Materiel', array('action' => 'find')); 
    echo $this->Form->input('designation', array('label' => 'Designation')); 
    echo $this->Form->input('numero_irap', array('label' => 'N° IRAP')); 
    echo $this->Form->end('Rechercher'); 
?>