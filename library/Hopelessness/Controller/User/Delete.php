<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Controller\User;

use Doctrine\ORM\EntityManagerInterface;
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
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * Constructor
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
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
