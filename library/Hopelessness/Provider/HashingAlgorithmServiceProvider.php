<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Provider;

use Hopelessness\HashAlgorithm\Bcrypt;
use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Hashing algorithm service provider
 */
class HashingAlgorithmServiceProvider implements ServiceProviderInterface
{

    /**
     * {@inheritDoc}
     */
    public function register(Application $application)
    {
        $application['Hopelessness\\HashAlgorithm\\Bcrypt'] = function(Application $application) {
            return new Bcrypt();
        };
    }

    /**
     * {@inheritDoc}
     */
    public function boot(Application $application)
    {
    }

}
