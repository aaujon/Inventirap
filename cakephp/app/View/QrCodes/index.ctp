<h1> The QrCode creation page </h1>

<h2> Write what you want into your QrCode</h2>

<?php

	    echo $this->Form->create('QrCode', array('action' => 'generateQrCode'));
	    echo $this->Form->input('message');
	    echo $this->Form->end('Send');
	    
?>