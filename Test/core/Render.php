<?php
/**
 * Class Render outputs page with required layout and parameters.
 */
class Render
{
	protected $layout = 'main';

	public function renderPage($path, $params = '')
	{
		$file = "../public/views/$path.php";

		if (file_exists($file) && $path != '/denied') {
		$this->setLayout('main');
		$page = self::requireView($path, $params);
		$layout = self::requireLayout($this->layout);

	} else {
		
		$this->setLayout('error');
		$page = self::requireView('denied', $params);
		$layout = self::requireLayout($this->layout);
	}
		echo str_replace('{{content}}', $page, $layout); 
	}

	public static function requireView($page, $params)
	{
		if (file_exists("../public/views/$page.php")) {
			ob_start();
			$params = $params;
			require_once "../public/views/$page.php";
			return ob_get_clean();
		} else {

			die('Fail, no page.');
		}
	}

	public static function requireLayout($layout)
	{
		if (file_exists("../public/views/layout/$layout.php")) {

			ob_start();
			require_once "../public/views/layout/$layout.php";
			return ob_get_clean();

		} else {

			die('Fail, no layout.');
		}
	}

	public  function setLayout($layout)
	{
		$this->layout = $layout;
	}


}