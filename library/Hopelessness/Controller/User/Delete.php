<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Controller\User;

use Doctrine\ORM\EntityManager;
use Hopelessness\Entity\User;
use Symfony\Component\HttpFoundation\Response;

/**
 * Delete user controller
 */
class Delete
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
     * Execute the controller
     *
     * @param User $user
     * @return Response
     */
    public function __invoke(User $user)
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return new Response(null, 204);
    }

}
