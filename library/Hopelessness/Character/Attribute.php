<?php
/**
 *
 */

namespace Hopelessness\Character;

/**
 *
 */
class Attribute
{

	/**
	 * Raw attribute value
	 *
	 * @var itneger
	 */
	protected $raw;
	
	/**
	 * Get the current attribute value
	 *
	 * @return integer
	 */
	public function getCurrent()
	{
	}
	
	/**
	 * Get the raw attribute value
	 *
	 * @return integer
	 */
	public function getRaw()
	{
		return $this->raw;
	}

}