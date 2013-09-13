<?php

/**
 * Basic visit validation using Sessions. One valid visit per session.
 *
 * @author  Lukas Niederberger <lukas.niederberger@gibmit.ch>
 * @copyright Lukas Niederberger, 2013
 * @license http://opensource.org/licenses/MIT The MIT License
 */
class Validation_Session implements IVisitDriver {

	/**
	 * Validate a visit for the passed page.
	 *
	 * @param string $page Page the visit needs to be validated for.
	 * @return boolean True if the visit is valid.
	 */
	public function validate($page)
	{
		if(in_array($page, $_SESSION))
		{
			return false;
		}

		$_SESSION[$page] = true;
		return true;
	}

}