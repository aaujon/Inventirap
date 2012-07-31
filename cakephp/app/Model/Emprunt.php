<?php
class Emprunt extends AppModel {
	public $name = 'Emprunt';
	public $belongsTo = array('Materiel');
			
	var $validate = array(
		'materiel_id' => array(
			'rule' => 'notEmpty',              
			'message' => 'Le champ doit être rempli.'
		),
		'laboratoire' => array(    
			'valid' => array(            
				'rule' => 'check_string',         
				'message' => 'Le champ doit être valide.'        
			), 
			'checkLaboratoire' => array(
				'rule' => 'checkLaboratoire',
				'message' => 'Le champ doit être rempli pour un emprunt externe.'
			)    
		),
		'e_lieu_detail' => array(    
			'valid' => array(            
				'rule' => 'check_string',         
				'message' => 'Le champ doit être valide.'        
			),
			'checkLieu' => array(
				'rule' => 'checkLieu',
				'message' => 'Le champ doit être rempli pour un emprunt interne.'
			)
		),
		'date_retour_emprunt' => array(
			'returnDateAfterLoanDate' => array(
				'rule' => 'returnDateAfterLoanDate',
				'message' => 'La date de retour doit être postérieure à la date de l\'emprunt.'
			)
		),
		'date_emprunt' => array(
			'rule' => 'notEmpty',              
			'message' => 'Le champ doit être rempli.'
		)
	);
	
	function returnDateAfterLoanDate() { 
		$emp = $this->data[$this->name]['date_emprunt'];
		$emp = mktime(0, 0, 0, substr($emp, 5, 2), substr($emp, -2), substr($emp, 0, 4)); 
		$ret = $this->data[$this->name]['date_retour_emprunt'];
		$ret = mktime(0, 0, 0, substr($ret, 5, 2), substr($ret, -2), substr($ret, 0, 4));
		if ($ret <= $emp)
			return false;
		return true;
    }
    
    function checkLaboratoire() {
    	return ((($this->data[$this->name]['emprunt_interne'] == 0) && ($this->data[$this->name]['laboratoire'] != '')) || 
				($this->data[$this->name]['emprunt_interne'] == 1));
    }
    function checkLieu() {
    	return ((($this->data[$this->name]['emprunt_interne'] == 1) && ($this->data[$this->name]['e_lieu_detail'] != '')) || 
				($this->data[$this->name]['emprunt_interne'] == 0));
    }
}
?>
