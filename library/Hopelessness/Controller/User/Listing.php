<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Controller\User;

use Closure;
use Hopelessness\Entity\User;
use Hopelessness\Repository\Users;
use Hopelessness\Traversable;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Listing users controller
 */
class Listing
{

    /**
     * Users
     *
     * @var Users
     */
    protected $users;

    /**
     * Constructor
     */
    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    /**
     * Execute the controller
     *
     * @return JsonResponse
     */
    public function __invoke()
    {
        return new JsonResponse(Traversable::map(function(User $user) {
            return $user->toArray();
        }, $this->users->findAll()));
    }

}
