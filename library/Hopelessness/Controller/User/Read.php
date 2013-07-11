<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Controller\User;

use Hopelessness\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Read customer controller
 */
class Read
{

    /**
     * Invoke the controller
     *
     * @return JsonResponse
     */
    public function __invoke(User $user)
    {
        return new JsonResponse($user->toArray());
    }

}
