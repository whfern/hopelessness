<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Provider;

use Hopelessness\Middleware\Authentication;
use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Authentication middleware service provider
 */
class AuthenticationMiddlewareServiceProvider implements ServiceProviderInterface
{

    /**
     * {@inheritDoc}
     */
    public function register(Application $application)
    {
        $application["Hopelessness\\Middleware\\Authentication"] = function(Application $application) {
            return new Authentication(
                $application["Zend\\Authentication\\AuthenticationService"],
                $application["Hopelessness\\Authentication\\Adapter\\Users"]
            );
        };
    }

    /**
     * {@inheritDoc}
     */
    public function boot(Application $application)
    {
    }

}
