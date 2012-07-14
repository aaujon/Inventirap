<?php

class QrCodesController extends AppController {

	var $helpers = array('Html', 'Form');
	var $name = 'QrCodes';

	public function index() {
		$message = $this->Session->read('qrCodeMessage');

		if(isset($message))
		{
			App::import('Vendor', 'phpqrcode/qrlib');

			QRcode::png($message);

			$this->Session->delete('qrCodeMessage');
		}
	}

	public function generateQrCode() {
		if(!empty($this->data)) {
			$this->Session->write('qrCodeMessage', $this->data['QrCode']['message']);

			$this->redirect('index');
		}
	}

	public function creer($message) {

		$userName = $this->Session->read('LdapUserName');
		if (isset($userName)) {
			App::import('Vendor', 'phpqrcode/qrlib');

			$fileName = $this->Session->id() . '.png';
			$cakephpPath = str_replace('webroot/index.php', '', $_SERVER['SCRIPT_FILENAME']);
			$qrCodePath = $cakephpPath . 'webroot/img/' . $fileName;
			QRcode::png($message, $qrCodePath);

			return $fileName;
		}
	}
}
?>