<?php
/**
 * Class Request retrieves uri and request method.
 */
class Request 
{
	
	public static function getPath()
	{
		$path = htmlspecialchars($_SERVER['REQUEST_URI'] ?? '/');//If no REQUEST_URI, it is '/'

		$parts = explode('/', $path);
		$path = '/' . $parts[1];
		return $path;
	}

	public static function getMethod()
	{
		return strtolower($_SERVER['REQUEST_METHOD']);//gets the request such as GET or POST, converts to lowercase.
	}

}