<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Entity;

/**
 * Item entity
 *
 * @Entity(repositoryClass="Hopelessness\Repository\Items")
 * @Table(name="items")
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
     * Character the item belongs to
     *
     * @var Character
     */
    protected $character;

    /**
     * Name for the character
     *
     * @Column(type="string", length=60, nullable=false, unique=true)
     * @var string
     */
    protected $name;

    /**
     * Observers
     *
     * @var ItemObserver[]
     */
    protected $observers = array();

    /**
     * Type of the item
     *
     * @Column(type="string", length=10, nullable=false)
     * @var string
     */
    protected $type;

    /**
     * Attach an observer
     *
     * @param ItemObserver $itemObserver
     * @return self
     */
    public function attachObserver(ItemObserver $itemObserver)
    {
        $this->observers[] = $itemObserver;
        return $this;
    }

    /**
     * Detach an observer
     *
     * @param ItemObserver $itemObserver
     * @return self
     */
    public function detachObserver(ItemObserver $itemObserver)
    {
        $key = array_search($itemObserver, $this->observers, true);

        if ($key !== false) {
            unset($this->observers[$key]);
        }

        return $this;
    }

    /**
     * Get the character the item belongs to
     *
     * @return Character
     */
    public function getCharacter()
    {
        return $this->character;
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
     * Set the character the item belongs to
     *
     * @param Character $character
     * @return self
     */
    public function setCharacter(Character $character)
    {
        $this->character = $character;
        $character->addItem($this);
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
