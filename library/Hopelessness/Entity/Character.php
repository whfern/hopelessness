<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Hopelessness\Character\Attack;
use Hopelessness\Character\Defense;

/**
 * Character entity
 *
 * @Entity(repositoryClass="Hopelessness\Repository\Users")
 * @Table(name="characters")
 */
class Character
{

	/**
	 * Attack attribtue for the character
	 *
	 * @Column(type="attack")
	 * @var Attack
	 */
	protected $attack;

	/**
	 * Defense attribute for the character
	 *
	 * @Column(type="defense")
	 * @var Defense
	 */
	protected $defense;

	/**
	 * Name for the character
	 *
	 * @Column(type="string", length=60, nullable=false, unique=true)
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
	 * User that owns the character
	 *
	 * @ManyToOne(targetEntity="Hopelessness\Entity\User",inversedBy="characters")
	 * @var User
	 */
	protected $user;

    /**
     * Universally unique identifier for the user
     *
     * @Column(type="string", length=36, nullable=false, unique=true)
     * @GeneratedValue(strategy="UUID")
     * @Id
     * @var string
     */
    protected $uuid;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->attack  = new Attack(0);
		$this->defense = new Defense(0);
		$this->items   = new ArrayCollection();

		$this->setupObservers();
	}

	/**
	 * Add an item to the character
	 *
	 * Inverse side of the character / item relationship. Do not use directly.
	 *
	 * @param Item $item
	 * @return self
	 */
	public function addItem(Item $item)
	{
	    $this->items[] = $item;

	    $item->attachObserver($this->getAttack())
	        ->attachObserver($this->getDefense());

	    return $this;
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
	 * Get the user the character belongs to
	 *
	 * @return User
	 */
	public function getUser()
    {
        return $this->user;
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
	 * Remove an item from the character
	 *
	 * @param Item $item
	 * @return self
	 */
	public function removeItem(Item $item)
	{
	    $this->items
	        ->removeElement($item);

        return $this;
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

	/**
	 * Setup the observers
	 *
	 * @return self
	 */
	public function setupObservers()
	{
		foreach ($this->getItems() as $item) {
			$item->attachObserver($this->getAttack());
			$item->attachObserver($this->getDefense());
		}

		return $this;
	}

	/**
	 * Set the user the character belongs to
	 *
	 * @param User $user
	 * @return self
	 */
	public function setUser(User $user)
	{
	    $this->user = $user;
	    $user->addCharacter($this);
	    return $this;
    }

}
