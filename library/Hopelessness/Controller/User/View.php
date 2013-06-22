<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Controller\User;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Edit customer controller
 */
class View
{

    /**
     * Users repository
     *
     * @var EntityRepository
     */
    protected $entityRepository;

    /**
     * UUID of the user to view
     *
     * @var string
     */
    protected $userUuid;

    /**
     * Constructor
     *
     * @param EntityRepository $entityRepository
     */
    public function __construct(EntityRepository $entityRepository, $userUuid)
    {
        $this->entityRepository = $entityRepository;
        $this->userUuid         = $userUuid;
    }

    /**
     * Invoke the controller
     *
     * @return string
     */
    public function __invoke()
    {
        $user = $this->entityRepository->find($this->userUuid);

        if (!$user) {
             throw new HttpException(404, "No user with that UUID exists");
        }

        return new JsonResponse(array(
            "uuid" => $user->getUuid(),
            "identity" => $user->getIdentity()
        ));
    }

}
