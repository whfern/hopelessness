<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Middleware;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Zend\Authentication\Adapter\AbstractAdapter;
use Zend\Authentication\AuthenticationService;

/**
 * Authentication middleware
 */
class Authentication
{

    /**
     * Constructor
     *
     * @param AuthenticationService $auth
     * @param AbstractAdapter $adapter
     */
    public function __construct(AuthenticationService $auth, AbstractAdapter $adapter)
    {
        $this->auth = $auth;
        $this->adapter = $adapter;
    }

    /**
     * Execute the middleware
     *
     * @param Request $request
     * @return Response|null
     */
    public function __invoke(Request $request)
    {
        if (!$request->server->has("AUTHENTICATION")) {
            return new JsonResponse(
                "Basic authentication required",
                401,
                array(
                    "WWW-Authenticate" => "Basic realm=\"Office of Hopelessness\""
                )
            );
        }

        $this->adapter
            ->setCredential($request->server->get("PHP_AUTH_USER"))
            ->setIdentity($request->server->get("PHP_AUTH_PW"));

        $result = $this->auth
            ->authenticate($this->adapter);

        if (!$result->isValid()) {
            return new JsonResponse(
                "Invalid identity or credential",
                401,
                array(
                    "WWW-Authenticate" => "Basic realm=\"Office of Hopelessness\""
                )
            );
        }
    }

}
