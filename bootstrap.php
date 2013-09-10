<?php

define('_CLASSPATH_', __DIR__.DIRECTORY_SEPARATOR.'Class'.DIRECTORY_SEPARATOR);
define('_APPATH_', __DIR__.DIRECTORY_SEPARATOR);

function al_underscore($class)
{
	$classpath = str_replace('_', DIRECTORY_SEPARATOR, $class);
	$filepath = _CLASSPATH_.$classpath.'.php';

	if ( file_exists($filepath) )
	{
		require_once($filepath);
	}
	else
	{
		die ('Class '.$class.' not found in default location');
	}
}

spl_autoload_register('al_underscore');