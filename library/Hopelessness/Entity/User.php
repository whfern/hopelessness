<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use RuntimeException;

/**
 * User entity
 *
 * @Entity(repositoryClass="Hopelessness\Repository\Users")
 * @Table(name="users")
 */
class User
{

    /**
     * Characters that belong to the user
     *
     * @OneToMany(targetEntity="Hopelessness\Entity\Character",mappedBy="user")
     * @var Character[]
     */
    protected $characters;

    /**
     * The credential for the user
     *
     * @Column(type="string", length=60, nullable=false)
     * @var string
     */
    protected $credential;

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
     * The identity for the user
     *
     * @Column(type="string", length=40, nullable=false, unique=true)
     * @var string
     */
    protected $identity;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->characters = new ArrayCollection();
    }

    /**
     * Add a character owned by this user
     *
     * Inverse side of the user / character relationship. Do not use directly.
     *
     * @param Character $character
     * @return self
     * @throws RuntimeException
     */
    public function addCharacter(Character $character)
    {
        if ($this->characters->contains($character)) {
            throw new RuntimeException("The user already owns that character");
        }

        if ($character->getUser() !== $this) {
            throw new RuntimeException("The characters user is not this user");
        }

        $this->characters[] = $character;
        return $this;
    }

    /**
     * Get the credential for the user
     *
     * @return string
     */
    public function getCredential()
    {
        return $this->credential;
    }

    /**
     * Get the characters that belong to the user
     *
     * @return Character[]
     */
    public function getCharacters()
    {
        return $this->characters
            ->toArray();
    }

    /**
     * Get the identity for the user
     *
     * @return string
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * Get the universally unique identifier for the user
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set the credential for the user
     *
     * @param string $credential
     * @return self
     */
    public function setCredential($credential)
    {
        $this->credential = $credential;
        return $this;
    }

    /**
     * Set the identity for the user
     *
     * @param string $identity
     * @return self
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;
        return $this;
    }

    /**
     * Get an array of the users information
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            'uuid' => $this->getUuid(),
            'identity' => $this->getIdentity()
        );
    }

}
