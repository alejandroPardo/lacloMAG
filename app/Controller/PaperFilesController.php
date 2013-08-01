<?php
App::uses('AppController', 'Controller');
require '../Vendor/WkHtmlToPdf.php';
/**
 * PaperFiles Controller
 *
 * @property PaperFile $PaperFile
 */
class PaperFilesController extends AppController {

	public function index() {
		
	}

	public function view($id = null) {
		//$this->autoRender = false;

		if (!$this->PaperFile->exists($id)) {
		  throw new NotFoundException(__('Invalid pdf'));
		} else {
			//$this->autoRender = false; // we will handle our own rendering

			$pdf_file = $this->PaperFile->findById($id);

			// get an instance of wkhtmltopdf
			/** OSX **/
			$binary = APP . "Vendor/wkhtmltopdf.app/Contents/MacOS/wkhtmltopdf";

			/** LINUX **/
			//$binary = APP . "Vendor/wkhtmltopdf-amd64";

			$pdf = new WkHtmlToPdf(array(
			  'bin'           => $binary,
			  'orientation'   => 'landscape'
			));

			// decode the database and add the html to the pdf
			$html = $pdf_file['PaperFile']['raw'];
			$pdf->addPage($html);

			$this->set('htm', $html);

			// send the file to the user's browser without saving it on the server!
			/*if(!$pdf->send($pdf_file['PaperFile']['name'] . ".pdf")) {
			  throw new Exception('Could not create PDF: '.$pdf->getError());
			}*/
		}
	}
}
