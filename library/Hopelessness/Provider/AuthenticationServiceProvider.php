<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\NonPersistent;

/**
 * Authentication service provider
 */
class AuthenticationServiceProvider implements ServiceProviderInterface
{

    /**
     * {@inheritDoc}
     */
    public function register(Application $application)
    {
        $application["Zend\\Authentication\\AuthenticationService"] = $application->share(function(Application $application) {
            return new AuthenticationService(
                new NonPersistent(),
                $application["Hopelessness\\Authentication\\Adapter\\Users"]
            );
        });
    }

    /**
     * {@inheritDoc}
     */
    public function boot(Application $application)
    {
    }

}
