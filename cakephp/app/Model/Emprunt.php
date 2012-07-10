<?php
class Emprunt extends AppModel {
	public $name = 'Emprunt';
	
	public $belongsTo = array('Materiel');
	
			
	var $validate = array(
		'materiel_id' => array(
			'rule' => 'notEmpty',              
			'message' => 'Le champ doit être rempli.'
		),
		'piece' => array(    
			'valid' => array(            
				'rule' => 'check_string',         
				'message' => 'Le champ doit être valide.'        
			),
			'checkPieceLaboratoire' => array(
				'rule' => 'checkPieceLaboratoire',
				'message' => 'L\'un des deux champs suivant doit être renseigné: Pièce et/ou Laboratoire'
			)
		),
		'laboratoire' => array(    
			'valid' => array(            
				'rule' => 'check_string',         
				'message' => 'Le champ doit être valide.'        
			), 
			'checkPieceLaboratoire' => array(
				'rule' => 'checkPieceLaboratoire',
				'message' => 'L\'un des deux champs suivant doit être renseigné: Pièce et/ou Laboratoire'
			)    
		),
		'responsable' => array(    
			'valid' => array(            
				'rule' => 'check_string',            
				'message' => 'Le champ doit être valide.'        
			),      
			'nonVide' => array(
				'rule' => 'notEmpty',              
				'message' => 'Le champ doit être rempli.'
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
    
    function checkPieceLaboratoire() {
		return (($this->data[$this->name]['piece'] != '') || ($this->data[$this->name]['laboratoire'] != ''));
    }
}
?>
