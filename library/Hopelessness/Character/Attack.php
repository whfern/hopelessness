<?php
/**
 *
 */

namespace Hopelessness\Character;

/**
 *
 */
class Attack implements ItemObserver, StatusEffectObserver
{

	/**
	 * Equipment modifiers
	 *
	 * @var integer
	 */
	protected $equipmentModifiers = 0;
	
	/**
	 * Status effect modifiers
	 *
	 * @var integer
	 */
	protected $statusEffectModifiers = 0;

	/**
	 * Raw attack value
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
		return $this->getRaw() +
			$this->getEquipmentModifiers() +
			$this->getStatusEffectModifiers();
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
	
	/**
	 * Update the attack attribute of changes to item
	 *
	 * @param Item $item
	 * @return self
	 */
	public function updateItem(Item $equipment)
	{
	}
	
	/**
	 * Update the attack attribute of changes to a status effect
	 *
	 * @param StatusEffect $statusEffect
	 * @return self
	 */
	public function updateStatusEffect(StatusEffect $statusEffect)
	{
	}

}