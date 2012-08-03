<?php
	if(!empty($message)) {
		echo $message;
	} else {	
		echo json_encode(compact('materials', 'id'));
	} 
?>