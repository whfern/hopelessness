<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Entity;

use Item;
use Character;

/**
 * Inventoryt class
 */
class Inventory
{

    /**
     * The character the inventory belongs to
     *
     * @ManyToOne()
     * @var Character
     */
    protected $character;

    /**
     * Flagged indicating if the item is equipped
     *
     * @var boolean
     */
    protected $equipped = false;

    /**
     * The item the inventory represents
     *
     * @ManyToOne()
     * @var Item
     */
    protected $item;

    /**
     * Get the character the inventory belongs to
     *
     * @return Character
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * Get the item the inventory represents
     *
     * @return Item
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Check if the item is equipped
     *
     * @return boolean
     */
    public function isEquipped()
    {
        return $this->equipped;
    }


}
