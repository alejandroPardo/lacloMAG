<?php
App::uses('AbstractPdfEngine', 'CakePdf.Pdf/Engine');

class WkHtmlToPdfEngine extends AbstractPdfEngine {

/**
 * Path to the wkhtmltopdf executable binary
 *
 * @access protected
 * @var string
 */
	protected $binary = '/usr/bin/wkhtmltopdf';

/**
 * Constructor
 *
 * @param $Pdf CakePdf instance
 */
	public function __construct(CakePdf $Pdf) {
		parent::__construct($Pdf);
	}

/**
 * Generates Pdf from html
 *
 * @return string raw pdf data
 */
	public function output() {

		//debug($this->_Pdf->html());
		$mag = explode ( '!!!COVER!!!' , $this->_Pdf->html() );

		//debug($mag);
		//die();

		if(isset($mag[1])){
			$coverFinal='http://localhost/lacloMAG/magazineFiles/view/'.$mag[1];
			$contentFinal=$mag[0].$mag[3];
			//debug($mag);
			//die();
			$content = $this->_exec($this->_getCommand($coverFinal), $contentFinal);
		} else {
			$content = $this->_exec($this->_getCommand('null'), $mag[0]);	
		}

		if (strpos(mb_strtolower($content['stderr']), 'error')) {
			throw new CakeException("System error <pre>" . $content['stderr'] . "</pre>");
		}

		if (mb_strlen($content['stdout'], $this->_Pdf->encoding()) === 0) {
			throw new CakeException("WKHTMLTOPDF didn't return any data");
		}

		if ((int)$content['return'] !== 0 && !empty($content['stderr'])) {
			throw new CakeException("Shell error, return code: " . (int)$content['return']);
		}

		return $content['stdout'];
	}

/**
 * Execute the WkHtmlToPdf commands for rendering pdfs
 *
 * @param string $cmd the command to execute
 * @param string $input
 * @return string the result of running the command to generate the pdf
 */
	protected function _exec($cmd, $input) {
		$result = array('stdout' => '', 'stderr' => '', 'return' => '');

		//if ($cover!=null){
		/*
			$proc = proc_open($cmd, array(0 => array('pipe', 'r'), 1 => array('pipe', 'w'), 2 => array('pipe', 'w')), $pipes, APP.DS.'Vendor'.DS.'cover.pdf');
			fwrite($pipes[0], $cover);
			fclose($pipes[0]);
			$cover=stream_get_contents($pipes[1]) ;
			proc_close($proc);

			$coverCommand = $this->_getCommandCover($cover);

			$proc = proc_open($coverCommand, array(0 => array('pipe', 'r'), 1 => array('pipe', 'w'), 2 => array('pipe', 'w')), $pipes);
			fwrite($pipes[0], $input);
			fclose($pipes[0]);

			$code=stream_get_contents($pipes[1]) ;

			$result['stdout'] = stream_get_contents($pipes[1]);
			fclose($pipes[1]);

			$result['stderr'] = stream_get_contents($pipes[2]);
			fclose($pipes[2]);

			$result['return'] = proc_close($proc);

			//echo $cover;
			//debug($coverCommand);
			//die();
*/
		//} else {
			$proc = proc_open($cmd, array(0 => array('pipe', 'r'), 1 => array('pipe', 'w'), 2 => array('pipe', 'w')), $pipes);
			fwrite($pipes[0], $input);
			fclose($pipes[0]);

			//$code=stream_get_contents($pipes[1]) ;

			$result['stdout'] = stream_get_contents($pipes[1]);
			fclose($pipes[1]);

			$result['stderr'] = stream_get_contents($pipes[2]);
			fclose($pipes[2]);

			$result['return'] = proc_close($proc);
		//}

		//echo $result['stderr']; 
		//die();

		return $result;
	}

/**
 * Get the command to render a pdf
 *
 * @return string the command for generating the pdf
 */
	protected function _getCommand($cover) {
		$binary = $this->config('binary');

		if ($binary) {
			$this->binary = $binary;
		}
		if (!is_executable($this->binary)) {
			throw new CakeException(sprintf('wkhtmltopdf binary is not found or not executable: %s', $this->binary));
		}

		$options = array(
			'quiet' => true,
			'print-media-type' => true,
			'orientation' => $this->_Pdf->orientation(),
			'page-size' => $this->_Pdf->pageSize(),
			'encoding' => $this->_Pdf->encoding(),
			'title' => $this->_Pdf->title(),
			'footer-center' => '[page]/[topage]'

		);
		
		/*$margin = $this->_Pdf->margin();

		foreach ($margin as $key => $value) {
			if ($value !== null) {
				$options['margin-' . $key] = $value . 'mm';
			}
		}*/
		$options = array_merge($options, (array)$this->config('options'));

		$command = $this->binary;
		foreach ($options as $key => $value) {
			if (empty($value)) {
				continue;
			} elseif ($value === true) {
				$command .= ' --' . $key;
			} else {
				$command .= sprintf(' --%s %s', $key, escapeshellarg($value));
			}
		}
		//$command .= ' cover '.$cover;
		if($cover!='null'){
			$command .= ' -B 10mm -T 0mm -L 0mm -R 0mm cover '.$cover.' toc --xsl-style-sheet '.APP.'Vendor'.DS.'default.xsl ';
		}
		$command .= " - - ";
	
		//debug($command);
		//die();
		return $command;
	}
	/**
 * Get the command to render a pdf
 *
 * @return string the command for generating the pdf
 */
	protected function _getCommandCover($cover) {
		$binary = $this->config('binary');

		if ($binary) {
			$this->binary = $binary;
		}
		if (!is_executable($this->binary)) {
			throw new CakeException(sprintf('wkhtmltopdf binary is not found or not executable: %s', $this->binary));
		}

		$options = array(
			'quiet' => true,
			'print-media-type' => true,
			'orientation' => $this->_Pdf->orientation(),
			'page-size' => $this->_Pdf->pageSize(),
			'encoding' => $this->_Pdf->encoding(),
			'title' => $this->_Pdf->title(),
			'footer-center' => '[page]/[topage]'

		);
		
		$margin = $this->_Pdf->margin();
		foreach ($margin as $key => $value) {
			if ($value !== null) {
				$options['margin-' . $key] = $value . 'mm';
			}
		}
		$options = array_merge($options, (array)$this->config('options'));

		$command = $this->binary;
		foreach ($options as $key => $value) {
			if (empty($value)) {
				continue;
			} elseif ($value === true) {
				$command .= ' --' . $key;
			} else {
				$command .= sprintf(' --%s %s', $key, escapeshellarg($value));
			}
		}
		$command .= ' cover '.$cover;
		$command .= " - -";
	
		//debug($command);
		//echo 'aqui';
		//die();
		return $command;
	}
}
