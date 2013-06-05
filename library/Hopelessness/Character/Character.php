<?php
/**
 *
 */

namespace Hopelessness\Character;

use \Doctrine\ORM\Collections\ArrayCollection;
 
/**
 *
 */
class Character
{

	/**
	 * Attack attribtue for the character
	 *
	 * @var Attack
	 */
	protected $attack;
	
	/**
	 * Defense attribute for the character
	 *
	 * @var Defense
	 */
	protected $defense;
	
	/**
	 * Name for the character
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * Items for the character
	 *
	 * @var Item[]
	 */
	protected $items;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->items = new ArrayCollection();
	}
	
	/**
	 * Get the attack attribute for the character
	 *
	 * @return Attack
	 */
	public function getAttack()
	{
		return $this->attack;
	}
	
	/**
	 * Get the current damage range
	 *
	 * @return Range
	 */
	public function getDamageRange()
	{
		return new Range(
			$this->getEquippedWeapon()->getWeaponDamage()->getLower() * (.5 + ($this->getAttack()->getCurrent() / 50)),
			$this->getEquippedWeapon()->getWeaponDamage()->getUpper() * (.5 + ($this->getAttack()->getCurrent() / 50))
		);
	}
	
	/**
	 * Get the equipped items for the character
	 *
	 * @return Item[]
	 */
	public function getEquipment()
	{
		$criteria = new Criteria();
		$criteria->where($criteria->expr()->eq('equipped', true));
		
		return $this->items
			->matching($criteria)
			->toArray();
	}
	
	/**
	 * Get the equipped weapon for the character
	 *
	 * @return Weapon
	 */
	public function getEquippedWeapon()
	{
		$criteria = new Criteria();
		$criteria->where($criteria->andX(
			$criteria->eq("type", Item::TYPE_WEAPON),
			$criteria->eq("equipped", true)
		));
		
		return $this->items
			->matching($criteria)
			->first();
	}
	
	/**
	 * Get the name for the character
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * Set the name for the character
	 *
	 * @param string $name
	 * @return self
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

}