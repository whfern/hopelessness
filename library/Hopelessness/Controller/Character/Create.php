<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Controller\Character;

use Doctrine\ORM\EntityManagerInterface;
use Hopelessness\Entity\Character;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Create character controller
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
     */
    public function __construct(EntityManagerInterface $entityManager, ParameterBag $postParameters)
    {
        $this->entityManager  = $entityManager;
        $this->postParameters = $postParameters;
    }

    /**
     * Execute the controller
     */
    public function __invoke()
    {
        $character = new Character();

        $character->setName($this->postParameters->get('name'));

        $this->entityManager
            ->persist($character);

        $this->entityManager
            ->flush();

        return new JsonResponse($character->toArray());
    }

}
