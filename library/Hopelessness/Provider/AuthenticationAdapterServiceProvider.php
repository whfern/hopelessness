<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Provider;

use Hopelessness\Authentication\Adapter\Users;
use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Authentication adapter service provider
 */
class AuthenticationAdapterServiceProvider implements ServiceProviderInterface
{

    /**
     * {@inheritDoc}
     */
    public function register(Application $application)
    {
        $application["Hopelessness\\Authentication\\Adapter\\Users"] = function(Application $application) {
            return new Users(
                $application["Hopelessness\\Repository\\Users"],
                $application["Hopelessness\\Crypt\\Scrypt"]
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
