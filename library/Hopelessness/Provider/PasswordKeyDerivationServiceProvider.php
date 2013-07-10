<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Zend\Crypt\Password\Bcrypt;

/**
 * Password key derivation service provider
 */
class PasswordKeyDerivationServiceProvider implements ServiceProviderInterface
{

    /**
     * {@inheritDoc}
     */
    public function register(Application $application)
    {
        $application['Zend\\Crypt\\Password\\Bcrypt'] = $application->share(function(Application $application) {
            return new Bcrypt();
        });
    }

    /**
     * {@inheritDoc}
     */
    public function boot(Application $application)
    {
    }

}
