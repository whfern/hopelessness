<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Controller;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\AuthenticationService;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Login controller
 */
class Login
{

    /**
     * Authentication service
     *
     * @var Auth
     */
    protected $auth;

    /**
     * Authentication adapter
     *
     * @var AdapterInterface
     */
    protected $authAdapter;

    /**
     * Post parameters
     *
     * @var ParameterBag
     */
    protected $postParameters;

    /**
     * Constructor
     *
     * @param AuthenticationService $authAdapter
     * @param AdapterInterface $adapter
     * @param ParameterBag $postParameters
     */
    public function __construct(AuthenticationService $auth, AdapterInterface $authAdapter, ParameterBag $postParameters)
    {
        $this->auth = $auth;
        $this->authAdapter = $authAdapter;
        $this->postParameters = $postParameters;
    }

    /**
     * Execute the controller
     */
    public function __invoke()
    {
        $result = $auth->authenticate($this->authAdapter);

        if ($result->isValid()) {
        }
    }

}
