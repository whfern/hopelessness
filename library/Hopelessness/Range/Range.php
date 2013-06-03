<?php
/**
 *
 */

namespace Hopelessness\Range;
 
/**
 *
 */
class Range
{

	/**
	 * Lower range
	 *
	 * @var integer
	 */
	protected $lower;
	
	/**
	 * Upper range
	 *
	 * @var integer
	 */
	protected $upper;
	
	/**
	 * Constructor
	 *
	 * @param integer $lower
	 * @param integer $upper
	 */
	public function __construct($lower, $upper)
	{
		$this->lower = $lower;
		$this->upper = $upper;
	}

	/**
	 * Get the lower bound of the range
	 *
	 * @return integer
	 */
	public function getLower()
	{
		return $this->lower;
	}
	
	/**
	 * Get a random value in the range
	 *
	 * @return integer
	 */
	public function getRandom()
	{
		return rand($this->getLower(), $this->getUpper());
	}
	
	/**
	 * Get the upper bound of the range
	 *
	 * @return integer
	 */
	public function getUpper()
	{
		return $this->upper;
	}
	
}