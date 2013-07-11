<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Controller\User;

use Doctrine\ORM\EntityManagerInterface;
use Hopelessness\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Zend\Crypt\Password\PasswordInterface;

/**
 * Create user controller
 */
class Create
{

    /**
     * Entity manager
     *
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * Password service
     *
     * @var PasswordInterface
     */
    protected $password;

    /**
     * POST parameters
     *
     * @var ParameterBag
     */
    protected $postParameters;

    /**
     * Url generator
     *
     * @var UrlGenerator
     */
    protected $urlGenerator;

    /**
     * Constructor
     *
     * @param EntityManagerInterface $entityManager
     * @param ParameterBag $postParameters
     * @param PasswordInterface $password
     * @param UrlGenerator $urlGenerator
     */
    public function __construct(EntityManagerInterface $entityManager, ParameterBag $postParameters, PasswordInterface $password, UrlGenerator $urlGenerator)
    {
        $this->entityManager  = $entityManager;
        $this->password       = $password;
        $this->postParameters = $postParameters;
        $this->urlGenerator   = $urlGenerator;
    }

    /**
     * Execute the controller
     */
    public function __invoke()
    {
        $user = new User();

        $user->setIdentity($this->postParameters->get('identity'))
            ->setCredential($this->password->create($this->postParameters->get('credential')));

        $this->entityManager
            ->persist($user);

        $this->entityManager
            ->flush();

        return new JsonResponse(
            $user->toArray(),
            201,
            array(
                "Location" => $this->urlGenerator
                    ->generate('', array('user' => $user->getId()))
            )
        );
    }

}
