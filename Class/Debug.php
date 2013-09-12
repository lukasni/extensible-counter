<?php

/**
 * Helper class used for displaying debug variables.
 *
 * @author Lukas Niederberger <lukas.niederberger@gibmit.ch>
 * @license http://opensource.org/licenses/MIT The MIT License
 */
class Debug {

	/**
	 * Dump all passed arguments using var_dump surrounded by html <pre> tags for better readability.
	 */
	public static function dump()
	{
	    if (func_num_args() === 0)
	    {
        	return;
	    }
 
	    // Get all passed variables
	    $variables = func_get_args();

	    echo '<pre>';
	 
	    foreach ($variables as $var)
	    {
	        var_dump($var);
	    }

	    echo '</pre>';

	}

}