<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\HashAlgorithm;

/**
 * Bcrypt hashing algorithm
 */
class Bcrypt implements HashAlgorithm
{

    /**
     * Default rounds to use for hashing
     *
     * @var integer
     */
    const DEFAULT_ROUNDS = 14;

    /**
     * Valid salt characters
     *
     * @var string
     */
    const SALT_CHARACTERS = "./0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

    /**
     * Rounds to use for hashing
     *
     * @var integer
     */
    protected $rounds = self::DEFAULT_ROUNDS;

    /**
     * Get the number of rounds to use for hashing
     *
     * @return integer
     */
    public function getRounds()
    {
        return $this->rounds;
    }

    /**
     * Hash the string
     *
     * @return string
     */
    public function hash($string)
    {
        return crypt($string, $this->generateSalt());
    }

    /**
     * Set the number of rounds to use for hashing
     *
     * @param integer $rounds
     * @return self
     */
    public function setRounds($rounds)
    {
        $this->rounds = $rounds;
        return $this;
    }

    /**
     * Generate a salt
     *
     * @return string
     */
    protected function generateSalt()
    {
        $characters = self::SALT_CHARACTERS;

        $salt = '$2a$' . $this->getRounds() . '$';
        for ($i = 0; $i < 22; ++$i) {
            $salt .= $characters[mt_rand(0, 61)];
        }
        $salt .= '$';

        return $salt;
    }

}
