<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Entity;

use Hopelessness\String;
use Hopelessness\HashAlgorithm\HashAlgorithm;

/**
 * User entity
 *
 * @Entity
 * @Table(name="users")
 */
class User
{

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
     * Check if the supplied credential matches the credential for the user
     *
     * @param string $credential
     * @return boolean
     */
    public function checkCredential($credential)
    {
        return String::constantTimeComparison(
            crypt($credential, $this->getCredential()),
            $this->getCredential()
        );
    }

    /**
     * Get the credential for the user
     *
     * The credential will be returned as a bcrypt hashed string.
     *
     * @return string
     */
    public function getCredential()
    {
        return $this->credential;
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
     * Set the credential for the user
     *
     * @param string $credential
     * @param HashAlgorithm $hashAlgorithm
     * @return self
     */
    public function setCredential($credential, HashAlgorithm $hashAlgorithm)
    {
        $this->credential = $hashAlgorithm->hash($credential);
        return $this;
    }

}
