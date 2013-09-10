<?php

/**
 * @todo  Write docblocks
 */
interface ICounterDriver {

	public function setCount($page, $count);
	
	public function getCount($page);
	
}