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
	 * Equipment items
	 *
	 * @var Items[]
	 */
	protected $equippedItems = array();

	/**
	 * Active status modifiers
	 *
	 * @var StatusModifier
	 */
    protected $activeStatusModifiers = array();

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
	 * Get all the modifiers for equipped items for attack
	 *
	 * @return integer
	 */
	public function getEquipmentModifiers()
	{
	    return Traversable::reduce(
	        function(Item $item, $memo) {
	            return $memo + $item->getAttackModifier();
	        },
	        $this->equippedItems,
	        0
        );
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
	public function updateItem(Item $item)
	{
        $key = array_search($item, $this->equippedItems, true);

	    if ($item->isEquipped()) {
	        if ($key === false) {
	            $this->equippedItems[] = $item;
	        }
        } else {
            if ($key !== false) {
                unset($this->equippedItems[$key]);
            }
        }

        return $this;
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
