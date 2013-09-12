<?php

/**
 * Core counter class. Uses an implementation of ICounterDriver for storage.
 * 
 * Increments the stored count for a passed ID (e.g. Pagename) for each valid visit.
 * An implementation of IVisitDriver is used to validate visits.
 * 
 * @author Lukas Niederberger <lukas.niederberger@gibmit.ch>
 * @copyright Lukas Niederberger, 2013
 * @license http://opensource.org/licenses/MIT The MIT License
 */
class Counter {

	public $page;
	protected $cdriver;
	protected $vdriver;

	/**
	 * Constructor. Takes an argument to determine which page to count, 
	 * as well as 2 arguments for which driver to use.
	 *
	 * @see   ICounterDriver, IVisitDriver
	 * @param string         $page    ID of the page to use
	 * @param ICounterDriver $cdriver CounterDriver to be used
	 * @param IVisitDriver   $vdriver VisitDriver to be used
	 */
	public function __construct($page, ICounterDriver $cdriver, IVisitDriver $vdriver)
	{
		$this->cdriver = $cdriver;
		$this->vdriver = $vdriver;
		$this->page = $page;
	}
	
	/**
	 * Increments the counter for a valid visit. 
	 * The Validation driver passed in the constructor is used to check if a visit is valid
	 * @return boolean True if the counter gets updated, false if the visit is invalid.
	 */
	public function update()
	{
		if ($this->vdriver->validate($this->page) === FALSE)
		{
			return false;
		}

		$newcount = $this->cdriver->getCount($this->page) + 1;
		$this->cdriver->setCount($this->page, $newcount);
		return true;
	}

	/**
	 * Sets the counter back to 0 using the counter driver.
	 */
	public function reset()
	{
		$this->cdriver->setCount($this->page, 0);
	}
	
	/**
	 * Get the current counter value from the driver
	 * @return int Current counter value
	 */
	public function getCount()
	{
		return $this->cdriver->getCount($this->page);
	}

}