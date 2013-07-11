<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Authentication\Adapter;

use Hopelessness\Repository\Users as UsersRepository;
use Zend\Authentication\Adapter\AbstractAdapter;
use Zend\Authentication\Result;
use Zend\Crypt\Password\PasswordInterface;
use Zend\Crypt\Utils;

/**
 * Users based authentication adapter
 */
class Users extends AbstractAdapter
{

    /**
     * Password service
     *
     * @var PasswordInterface
     */
    protected $password;

    /**
     * Users repository
     *
     * @var UsersRepository
     */
    protected $users;

    /**
     * Constructor
     *
     * @param UsersRepository $usersRepository
     * @param PasswordInterface $password
     */
    public function __construct(UsersRepository $users, PasswordInterface $password)
    {
        $this->password = $password;
        $this->users    = $users;
    }

    /**
     * {@inheritDoc}
     */
    public function authenticate()
    {
        $user = $this->users
            ->findByIdentity($this->getIdentity());

        if (!$user) {
            return new Result(
                Result::FAILURE_IDENTITY_NOT_FOUND,
                null,
                array("Identity not found")
            );
        }

        if (!$this->password->verify($this->getCredential(), $user->getCredential())) {
            return new Result(
                Result::FAILURE_CREDENTIAL_INVALID,
                null,
                array("Credential invalid")
            );
        }

        return new Result(
            Result::SUCCESS,
            $user
        );
    }

}
