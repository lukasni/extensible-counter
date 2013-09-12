<?php

/**
 * @todo Docblocks, implementation
 */
class Validation_Session implements IVisitDriver {

	/**
	 * @todo Not implemented yet
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