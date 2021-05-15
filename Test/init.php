<?php

//autoloader
spl_autoload_register(function ($class_name){
	$class = $class_name;

	$core_path = "../core/$class.php";
	$controllers_path = "../controllers/$class.php";
	$model_path = "../models/$class.php";

	if ( file_exists($core_path) ){
		require_once($core_path);

	}elseif ( file_exists($controllers_path) ){
		require_once($controllers_path);

	}elseif ( file_exists($model_path) ){
		require_once($model_path);

	}else {
		throw new Exception('Failed to include class: '.$class_name);
		
	}
});



