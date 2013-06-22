<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Entity repositories service provider
 */
class RepositoriesServiceProvider implements ServiceProviderInterface
{

    /**
     * {@inheritDoc}
     */
    public function register(Application $application)
    {
        $application['users-repository'] = function(Application $application) {
            return $application['orm']->getRepository('Hopelessness\\Entity\\User');
        };
    }

    /**
     * {@inheritDoc}
     */
    public function boot(Application $application)
    {
    }

}
