<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Controller\User;

use Doctrine\ORM\EntityManager;
use Hopelessness\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Update user controller
 */
class Update
{

    /**
     * Entity manager
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Constructor
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Execute the action
     *
     * @param User $user
     * @return JsonResponse
     */
    public function __invoke(User $user)
    {
        $validator = $user->getValidator();

        // validation

        return JsonResponse($user->toArray());
    }

}
