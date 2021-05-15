<?php
/**
 * Class Processor seeds table with dummy data,
 * allows upload and download of csv files,
 * calculates total cost per category.
 */
class Processor extends Data
{
	public function __construct()
	{
		parent::__construct();		
	}

	public function seed()
	{
		$this->seedTable('aFile');
		$this->tempStore();
	}

	public  function upload($filename)
	{
		$this->uploadFile($filename);
		$this->tempStore();
	}

	public function download()
	{
		$this->downloadFile();
	}

	public function totalCost($data)
	{
		$array =[];
		foreach ($data as $key) {
			$price = floatval($key['price']);
			$quantity = floatval($key['quantity']);
			$category = $key['category'];
			$totalCost = $price * $quantity;

			if (array_key_exists($category, $array)) {
				$array[$category] += $totalCost;
			}else {
				$array += [$category => $totalCost];
			}
		}
		return $array;
	} 

	public function tempStore()
	{	
		if (empty($this->data)) {
			$data = $this->getDummyData();
		} else{
			$data = $this->getData();
		}
		
		$file = fopen("../public/uploads/temp.csv", "w");
			foreach ($data as $key => $value) {
				fwrite($file, $key . "," . $value . ",\n");
			}
			fclose($file);
	}

	public function getData()
	{
		$data = $this->totalCost($this->data);
		return $data;
	}

	public function getDummyData()
	{
		$data = $this->totalCost($this->dummyData);
		return $data;
	}
}