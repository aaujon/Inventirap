<?php

class DocumentsController extends AppController {

	var $layout = 'xml';

	public function beforeFilter() {
		$ldapUserAuthenticationLevel = $this->Session->read('LdapUserAuthenticationLevel');
		if(isset($ldapUserAuthenticationLevel)) {
			$this->LdapAuth->allow('*');
		} else {
			$this->LdapAuth->deny();;
		}
	}

	public function sortie($irapNumber) {
		if(preg_match('~IRAP-..-[0-9]*~', $irapNumber)) {

			$materiel = ClassRegistry::init('Materiel')->
			find('all', array('conditions' => array('numero_irap' => $irapNumber)));

			$documentFolderPath = $this->prepareGenerator('sortie');
			$sessionFolder = $this->Session->id();

			exec ('sed -i \'s/\$1\$/ /\' ' . $documentFolderPath . '/generator/content.xml');
			exec ('sed -i \'s/\$2\$/ /\' ' . $documentFolderPath . '/generator/content.xml');
			exec ('sed -i \'s/\$3\$/' . $materiel[0]['Materiel']['numero_serie'] . '/\' ' . $documentFolderPath . '/generator/content.xml');
			exec ('sed -i \'s/\$4\$/' . $materiel[0]['Materiel']['numero_irap'] . '/\' ' . $documentFolderPath . '/generator/content.xml');
			exec ('sed -i \'s/\$5\$/' . $materiel[0]['Materiel']['designation'] . '/\' ' . $documentFolderPath . '/generator/content.xml');
			exec ('sed -i \'s/\$6\$/ /\' ' . $documentFolderPath . '/generator/content.xml');
			exec ('sed -i \'s/\$7\$/' . $materiel[0]['Materiel']['date_acquisition'] . '/\' ' . $documentFolderPath . '/generator/content.xml');
			exec ('sed -i \'s/\$8\$/ /\' ' . $documentFolderPath . '/generator/content.xml');
			exec ('sed -i \'s/\$9\$/' . $materiel[0]['Materiel']['lieu_stockage']
			. ', ' . $materiel[0]['Materiel']['lieu_detail']
			. ', ' . $materiel[0]['Materiel']['nom_responsable']
			. ', ' . $materiel[0]['Materiel']['email_responsable']
			. '/\' ' . $documentFolderPath . '/generator/content.xml');
			exec ('sed -i \'s/\$10\$/' . date('d F Y') . '/\' ' . $documentFolderPath . '/generator/content.xml');
			exec ('sed -i \'s/\$11\$/' . date('d F Y') . '/\' ' . $documentFolderPath . '/generator/content.xml');

			$this->uploadFile($documentFolderPath, 'sortie');
		}
	}

	public function admission($irapNumber) {
		if(preg_match('~IRAP-..-[0-9]*~', $irapNumber)) {

			$materiel = ClassRegistry::init('Materiel')->
			find('all', array('conditions' => array('numero_irap' => $irapNumber)));

			$documentFolderPath = $this->prepareGenerator('admission');
			$sessionFolder = $this->Session->id();

			exec ('sed -i \'s/\$1\$/' . $materiel[0]['Materiel']['nom_responsable'] . '/\' ' . $documentFolderPath . '/generator/content.xml');
			exec ('sed -i \'s/\$2\$/ /\' ' . $documentFolderPath . '/generator/content.xml');
			exec ('sed -i \'s/\$3\$/' . $materiel[0]['Materiel']['designation'] . '/\' ' . $documentFolderPath . '/generator/content.xml');
			exec ('sed -i \'s/\$4\$/' . $materiel[0]['Materiel']['date_acquisition'] . '/\' ' . $documentFolderPath . '/generator/content.xml');
			exec ('sed -i \'s/\$5\$/' . $materiel[0]['Materiel']['fournisseur'] . '/\' ' . $documentFolderPath . '/generator/content.xml');
			exec ('sed -i \'s/\$6\$/ /\' ' . $documentFolderPath . '/generator/content.xml');
			exec ('sed -i \'s/\$7\$/' . $materiel[0]['Materiel']['numero_commande'] . '/\' ' . $documentFolderPath . '/generator/content.xml');
			exec ('sed -i \'s/\$8\$/' . date('d F Y') . '/\' ' . $documentFolderPath . '/generator/content.xml');

			$this->uploadFile($documentFolderPath, 'admission');
		}
	}

	private function prepareGenerator($docuementType) {
		$sessionFolder = $this->Session->id();
		$cakephpPath = str_replace('webroot/index.php', '', $_SERVER['SCRIPT_FILENAME']);
		$documentFolderPath = $cakephpPath . 'tmp/documents';

		exec ('cp -R ' . $documentFolderPath . '/odt_templates/' . $docuementType . '.odt ' . $documentFolderPath . '/generator/' . $docuementType . '.zip');
		exec ('unzip ' . $documentFolderPath . '/generator/' . $docuementType . '.zip -d ' . $documentFolderPath . '/generator/');
		exec ('rm ' . $documentFolderPath . '/generator/' . $docuementType . '.zip');

		date_default_timezone_set('UTC');

		return $documentFolderPath;
	}

	private function uploadFile($documentFolderPath, $documentType) {

		$sessionFolder = $this->Session->id();

		exec ('sh ' . $documentFolderPath . '/zip.sh ' . $documentFolderPath . ' ' . $sessionFolder . ' ' . $documentType . '.zip');
		exec ('mv ' . $documentFolderPath . '/' . $sessionFolder . '/' . $documentType . '.zip ' . $documentFolderPath . '/' . $sessionFolder . '/' . $documentType . '.odt');
		exec ('rm -rf ' . $documentFolderPath . '/generator/*');

		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename=' . $documentFolderPath . '/' . $sessionFolder . '/' . $documentType . '.odt');
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($documentFolderPath . '/' . $sessionFolder . '/' . $documentType . '.odt'));
		ob_clean();
		flush();
		readfile($documentFolderPath . '/' . $sessionFolder . '/' . $documentType . '.odt');
	}
}

?>