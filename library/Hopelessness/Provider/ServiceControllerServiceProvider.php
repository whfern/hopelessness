<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Provider;

use Hopelessness\ServiceControllerResolver;
use Silex\Application;
use Silex\ControllerResolver;
use Silex\ServiceProviderInterface;

/**
 * Service controller service provider
 */
class ServiceControllerServiceProvider implements ServiceProviderInterface
{

    /**
     * {@inheritDoc}
     */
    public function register(Application $application)
    {
        $application['resolver'] = $application->share(
            $application->extend(
                'resolver',
                function(ControllerResolver $resolver, Application $application) {
                    return new ServiceControllerResolver($resolver, $application);
                }
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function boot(Application $application)
    {
    }

}
