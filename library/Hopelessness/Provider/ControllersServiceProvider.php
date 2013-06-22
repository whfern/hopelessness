<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Provider;

use Hopelessness\Controller\Homepage as HomepageController;
use Hopelessness\Controller\User\Add as AddUserController;
use Hopelessness\Controller\User\View as ViewUserController;
use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Controllers service provider
 */
class ControllersServiceProvider implements ServiceProviderInterface
{

    /**
     * {@inheritDoc}
     */
    public function register(Application $application)
    {
        $application['homepage'] = function(Application $application) {
            return new HomepageController();
        };

        $application['add-customer'] = function(Application $application) {
            return new AddUserController(
                $application['orm'],
                $application['request']->request,
                $application['hash']
            );
        };

        $application['view-customer'] = function(Application $application) {
            return new ViewUserController(
                $application['users-repository'],
                $application['request']->attributes->get('uuid')
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
