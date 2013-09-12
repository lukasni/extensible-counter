<?php

/**
 * @todo Write docblocks
 */
class Validation_Dummy implements IVisitDriver {
	
	public function validate($page)
	{
		return true;
	}

}