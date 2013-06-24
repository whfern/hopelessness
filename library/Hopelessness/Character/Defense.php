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
 * Defense attribute
 */
class Defense implements ItemObserver, StatusEffectObserver
{

	/**
	 * Raw defense value
	 *
	 * @var integer
	 */
	protected $raw;

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
