<?php

/**
 * Implements the ICounterDriver interface for file-based storage.
 *
 * The data is stored in an XML file. Separate counters are kept for every page.
 *
 * @version 1.0
 * @author Lukas Niederberger <lukas.niederberger@gibmit.ch>
 * @copyright Lukas Niederberger, 2013
 * @license http://opensource.org/licenses/MIT The MIT License
 */
class Counter_File implements ICounterDriver {

	/**
	 * The XML file version supported by the script
	 */
	const XML_VERSION = '0.1';

	/**
	 * Path to the XML file. Passed as a constructor argument
	 * @var string
	 */
	protected $filename;
	
	/**
	 * Constructor. Verifies the XML File version is supported.
	 * @param string $filename Path to the data file.
	 */
	public function __construct($filename)
	{
		$this->filename = $filename;

		$xml = simplexml_load_file($filename);
		if ($xml->attributes()['version'] != self::XML_VERSION)
		{
			throw new Exception('XML File version ('.$xml->version.
				') is not compatible to class version ('.self::XML_VERSION.')');
		}
	}
	
	/**
	 * Set the counter for a page.
	 * @param string $page  Name of the page. Saved in <file> in the XML file
	 * @param int $count New value that will be saved to the XML
	 */
	public function setCount($page, $count)
	{
		$counter = simplexml_load_file($this->filename);
		$node = $this->getPageNode($counter->pages, $page);

		$node->hits = $count;
		$this->saveXML($counter);
	}
	
	/**
	 * Get the current counter value for one page
	 * @param  string $page Name of the page
	 * @return int       	Current counter value 
	 */
	public function getCount($page)
	{
		$counter = simplexml_load_file($this->filename);
		$node = $this->getPageNode($counter->pages, $page);

		return (int) $node->hits;
	}

	/**
	 * Get the SimpleXMLElement for one <page> node containing a given value for <file>
	 *
	 * If the requested node does not exist yet, a new page node will be created.
	 * 
	 * @param  SimpleXMLElement $parent   Parent node containing the page nodes
	 * @param  string           $pagename Name of the page. Saved in a <file> node
	 * @return SimpleXMLElement           requested <page> node 
	 */
	protected function getPageNode(SimpleXMLElement $parent, $pagename)
	{
		$node = $parent->xpath("page[file='$pagename']");

		if (count($node) > 0)
		{
			$node = $node[0];
		}
		else
		{
			$node = $parent->addChild('page');
			$node->file = $pagename;
			$node->hits = 0;
		}

		return $node;
	}

	/**
	 * Save the Data to a neatly formatted XML File. Uses DOMDocument for formatting.
	 *
	 * @param  SimpleXMLElement $xml Complete XML that will be be saved to file
	 */
	protected function saveXML(SimpleXMLElement $xml)
	{
		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($xml->asXML());
		$dom->save($this->filename);
	}
}
