<?php
App::uses('AppController', 'Controller');
App::uses('CakePdf', 'CakePdf.Pdf');
//require '../Vendor/WkHtmlToPdf.php';
/**
 * PaperFiles Controller
 *
 * @property PaperFile $PaperFile
 */
class PaperFilesController extends AppController {

	public function index() {
		
	}
	
	public function view($id = null) {
		$this->render = false;
        $this->PaperFile->id = $id;
        if (!$this->PaperFile->exists()) {
            throw new NotFoundException(__('Invalid invoice'));
        }
        $this->pdfConfig = array(
            'orientation' => 'portrait',
            'filename' => 'PaperFile_' . $id,
            'download' => true,
            'options' => array('')
        );

        $html = $this->PaperFile->findById($id);
        $this->set('htm', $html['PaperFile']['raw']);
     /*   $CakePdf = new CakePdf();
	    //$CakePdf->template('newsletter', 'default');
	    //get the pdf string returned
	    $pdf = $CakePdf->output();
	    //or write it to file directly
	    $pdf = $CakePdf->write(APP . 'files' . DS . 'newsletter.pdf');*/
        

     

    //this function is required for wkhtmltopdf to retrieve the viewdump once it's rendered 
    /*public function getViewDump($fileName) 
    { 
        $this->WkHtmlToPdf->getViewDump($fileName); 
    } 
	/*public function view() {
		//$this->autoRender = false;
		$this->layout = 'ajax';

		if (!$this->PaperFile->exists('13')) {
		  throw new NotFoundException(__('Invalid pdf'));
		} else {
			//$this->autoRender = false; // we will handle our own rendering

			$html = $this->PaperFile->findById('13');

			// get an instance of wkhtmltopdf
			/** OSX **/
			//$binary = APP . "Vendor/wkhtmltopdf.app/Contents/MacOS/wkhtmltopdf";

			/** LINUX **/
			//$binary = APP . "Vendor/wkhtmltopdf-amd64";

			/*$pdf = new WkHtmlToPdf(array(
			  'bin'           => $binary,
			  'orientation'   => 'landscape'
			));*/

			// decode the database and add the html to the pdf
			//$html = $pdf_file['PaperFile']['raw'];
			//$pdf->addPage($html);
/*
			$this->set('htm', $html['PaperFile']['raw']);
			$this->WkHtmlToPdf->createPdf(); 
			$this->redirect(array("controller" => "backend", "action" => "index"));

			// send the file to the user's browser without saving it on the server!
			/*if(!$pdf->send() ){
			  throw new Exception('Could not create PDF: '.$pdf->getError());
			}*/
		/*}*/
	}
}
