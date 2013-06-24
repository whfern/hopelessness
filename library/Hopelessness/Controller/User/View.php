<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Controller\User;

use Hopelessness\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * View customer controller
 */
class View
{

    /**
     * Invoke the controller
     *
     * @return JsonResponse
     */
    public function __invoke(User $user)
    {
        return new JsonResponse(array(
            'uuid' => $user->getUuid(),
            'identity' => $user->getIdentity()
        ));
    }

}
