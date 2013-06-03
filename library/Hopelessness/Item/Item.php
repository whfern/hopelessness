<?php
/**
 *
 */

namespace Hopelessness\Item;
 
/**
 *
 */
class Item
{

	/**#@+
	 * Item type
	 *
	 * @var string
	 */
	const TYPE_WEAPON = 'weapon';
	/**#@-*/

	/**
	 * Set the equipped status of the item
	 *
	 * @var boolean
	 */
	protected $equipped = false;

	/**
	 * Name of the item
	 *
	 * @var string
	 */
	protected $name;
	
	/**
	 * Type of the item
	 *
	 * @var string
	 */
	protected $type;
	
	/**
	 * Get the equipped status of the item
	 *
	 * @return boolean
	 */
	public function getEquipped()
	{
		return $this->equipped;
	}
	
	/**
	 * Get the name of the item
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * Get the type of the item
	 *
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}
	
	/**
	 * Set the equipped status of the item
	 *
	 * @param boolean $equipped
	 * @return self
	 */
	public function setEquipped($equipped)
	{
		$this->equipped = $equipped;
		return $this;
	}
	
	/**
	 * Set the name of the item
	 *
	 * @param string $name
	 * @return self
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}
	
	/**
	 * Set the type of the item
	 *
	 * @param string $type
	 * @return self
	 */
	public function setType($type)
	{
		$this->type = $type;
		return $this;
	}

}