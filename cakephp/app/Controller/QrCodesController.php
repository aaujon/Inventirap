<?php

class QrCodesController extends AppController {

	var $helpers = array('Html', 'Form');
	var $name = 'QrCodes';

	public function index() {
		$message = $this->Session->read('qrCodeMessage');

		if(isset($message))
		{
			App::import('Vendor', 'phpqrcode/qrlib');

			QRcode::png($this->Session->read('qrCodeMessage'));

			$this->Session->delete('qrCodeMessage');
		}
	}

	public function generateQrCode() {

		if(!empty($this->data)) {
			$this->Session->write('qrCodeMessage', $this->data['QrCode']['message']);

			$this->redirect('index');
		}
	}
}