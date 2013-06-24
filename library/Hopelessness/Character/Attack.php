<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Character;

use Hopelessness\Item\Item;
use Hopelessness\Item\ItemObserver;
use Hopelessness\StatusEffect\StatusEffect;
use Hopelessness\StatusEffect\StatusEffectObserver;

/**
 * Attack attribute
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
	 * Constructor
	 *
	 * @param integer $raw
	 */
	public function __construct($raw)
	{
	    $this->raw = $raw;
    }

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
