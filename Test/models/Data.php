<?php
/**
 * Class Data reads file data for processing,
 * conducts file download.
 */
class Data
{
	protected $data = [];
	protected $dummyData = [];
	protected $file;

	public function __construct()
	{
		$this->file = 'aFile';
	}

	public function setFile($file)
	{
		$this->file = $file;
	}

	public function getFile()
	{
		return $this->file;
	}

	public function seedTable($filename)
	{
		if (($handle = fopen("../$filename.csv", "r")) !== FALSE) 
		{
			$dataArray = [];
			while(($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$dataArray[] = $data;
			}
			fclose($handle);
			foreach ($dataArray as $key) {
				$array = [
				"category" => $key[0],
				"price" => $key[1],
				"quantity" => $key[2], 
				];
				array_push($this->dummyData, $array);
			}
		}else{
			return false;
		}
	}

	public function uploadFile($filename)
	{

		if ( $handle = fopen($_FILES[$filename]['tmp_name'], "r"))  {
			$dataArray = [];
			while(($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$dataArray[] = $data;
			}
			fclose($handle);
			$this->data = [];
			foreach ($dataArray as $key) {
				$array = [
				"category" => $key[0],
				"price" => $key[1],
				"quantity" => $key[2], 
				];
				array_push($this->data, $array);
			}
		}else{
			return false;
		}
			
	}

	public function downloadFile()
	{
		header('Content-type: application/csv');
		header('Content-Disposition: attachment;filename = "temp.csv"');
		readfile("../public/uploads/temp.csv");
		exit();
		
	}

}