<?php
class EmpruntsController extends AppController {
	public $scaffold;
	public $helpers = array('Js');

	public function beforeFilter() {
		$userAuth = $this->Session->read('LdapUserAuthenticationLevel');
		if ($userAuth > 1)
			$this->LdapAuth->allow('*');
		elseif ($userAuth == 1)
		$this->LdapAuth->allow('index', 'view');
		else
			$this->LdapAuth->deny();
	}

	public function addEmprunt() {
	 if (!empty($this->data)) {
	 		
	 	$nom_emprunt = '';
	 	if(empty($this->data['Emprunt']['nom_emprunteur_combo']) && !empty($this->data['Emprunt']['nom_emprunteur_text'])) {
	 		$nom_emprunt = $this->data['Emprunt']['nom_emprunteur_text'];
	 	} elseif (!empty($this->data['Emprunt']['nom_emprunteur_combo']) && empty($this->data['Emprunt']['nom_emprunteur_text'])) {
	 		$nom_emprunt = $this->data['Emprunt']['nom_emprunteur_combo'];
	 	}

	 	$data_array = $this->data;
	 	$data_array['Emprunt']['nom_emprunteur'] = $nom_emprunt;

	 	if ($this->Emprunt->save($data_array)) {
	 		$this->Session->setFlash('Le nouvel emprunt est bien enregistré.');
	 	} else {
	 		$this->Session->setFlash('Echec de l\'enregirstrement de l\'emprunt');
	 	}
	 	$this->redirect(array('action' => 'index'));
	 }
	}
}
?>
