<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Controller\User;

use Doctrine\ORM\EntityManagerInterface;
use Hopelessness\Entity\User;
use Hopelessness\HashAlgorithm\HashAlgorithm;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Add user controller
 */
class Add
{

    /**
     * Entity manager
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Hash algorithm
     *
     * @var HashAlgorithm
     */
    protected $hashAlgorithm;

    /**
     * POST parameters
     *
     * @var ParameterBag
     */
    protected $postParameters;

    /**
     * Constructor
     *
     * @param EntityManagerInterface $entityManager
     * @param ParameterBag $postParameters
     * @param HashAlgorithm $hashAlgorithm
     */
    public function __construct(EntityManagerInterface $entityManager, ParameterBag $postParameters, HashAlgorithm $hashAlgorithm)
    {
        $this->entityManager  = $entityManager;
        $this->hashAlgorithm  = $hashAlgorithm;
        $this->postParameters = $postParameters;
    }

    /**
     * Execute the controller
     */
    public function __invoke()
    {
        $user = new User();

        $user->setIdentity($this->postParameters->get('identity'))
            ->setCredential($this->postParameters->get('credential'), $this->hashAlgorithm);

        $this->entityManager
            ->persist($user);

        $this->entityManager
            ->flush();

        return new JsonResponse(array(
            "uuid" => $user->getUuid(),
            "identity" => $user->getIdentity()
        ));
    }

}
