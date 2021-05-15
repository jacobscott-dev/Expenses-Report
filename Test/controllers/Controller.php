<?php 
/**
 * Class Controller passes parameters for page render.
 */
class Controller
{
	protected Render $render;
	protected Processor $processor;
	protected $acceptedFiles = array(
		'text/csv', 
		'text/plain', 
		'application/csv', 
		'text/comma-seperated-values', 
		'application/excel', 
		'application/vnd.ms-excel', 
		'application/vnd.msexcel', 
		'text/anytext', 
		'application/text', 
		'application/octet-stream',
		);

	public function __construct()
	{
		$this->render = new Render();
		$this->processor = new Processor();
	}

	public function index()
	{
		//renders home page with dummy data
		$this->processor->seed();
		$params = $this->processor->getDummyData();
		$this->render->renderPage('home', $params);
	}

	public function upload()
	{	
		//if no file is selected
		if ($_FILES['filename']['error'] == UPLOAD_ERR_NO_FILE) {
			$params = "No file selected";
			$this->render->renderPage('error', $params);
		} else {
			//if a correct file type is submitted
			$fileType = $_FILES['filename']['type'];
			if (in_array($fileType, $this->acceptedFiles) ) {
				$this->processor->upload('filename');
				$params = $this->processor->getData(); 
				$this->render->renderPage('upload', $params);
			} else {
				//if wrong type file is submitted
				$params = "Incorrect file type, please upload a csv file";
				$this->render->renderPage('error', $params);
			}
		}
	}

	public function download()
	{
		$this->processor->download();
	}

	public function error()
	{
		$this->render->renderPage('error');
	}
}