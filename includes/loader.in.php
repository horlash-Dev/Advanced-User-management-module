<?php 
spl_autoload_register('autoLoad');
function autoLoad($file)
{
	$path = "assets/config/";
	$ext = ".class.php";
	$call = $path . $file . $ext;
	
	if (!file_exists($call)) {
		return  false;
	}
	include_once $call;
}

// spl_autoload_register('autoLoad');
// function autoLoad($fil)
// {	
// 	$url= $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
// 	if (strpos($url, 'includes') !==false ) {
// 	$path = "../classes/";
// 	} else{
// 		$path = "classes/";
// 	}
// 	$ext = ".class.php";
// 	require_once $path . $fil . $ext;
// }


// spl_autoload_register('auto');
// function auto($classname)
// {
// 	$file= ABSPATH . 'classes/' . $classname . '.php';
// 	if (file_exists($file)) {
// 	 	include $file;
// 	 }else{
// 	 	$file= ABSPATH . 'assets/config/' . $classname . '.php';
// 	 	if (file_exists($file)) {
// 	 	include $file;
// 	 }
// 	 }

// }


// function MyAutoload($className) { $extension = spl_autoload_extensions(); $className = str_replace('\\', DIRECTORY_SEPARATOR, $className); $filename = __DIR__ . DIRECTORY_SEPARATOR . $className . $extension; if (is_readable($filename)) { require_once($filename); } else { die("Not Found Class ($filename)"); } } spl_autoload_extensions('.php'); spl_autoload_register('MyAutoload'); 

 ?>