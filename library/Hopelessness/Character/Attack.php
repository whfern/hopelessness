<?php
/**
 *
 */

namespace Hopelessness\Character;

/**
 *
 */
class Attack implements EquipmentObserver, StatusEffectsObserver
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
	 * Update the attack attribute of changes to equipment
	 *
	 * @param Equipment $equipment
	 * @return self
	 */
	public function updateEquipment(Equipment $equipment)
	{
	}
	
	/**
	 * Update the attack attribute of changes to status effects
	 *
	 * @param StatusEffects $statusEffects
	 * @return self
	 */
	public function updateStatusEffects(StatusEffects $statusEffects)
	{
	}

}