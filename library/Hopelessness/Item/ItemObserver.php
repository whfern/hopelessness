<?php
/**
 *
 */

namespace Hopelessness\Item;

/**
 *
 */
interface ItemObserver
{

	/**
	 * Update the observer of a change to the item
	 *
	 * @param Item $item
	 * @return self
	 */
	public function updateItem(Item $item);

}
