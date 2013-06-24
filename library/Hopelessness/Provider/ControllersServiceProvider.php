<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Provider;

use Hopelessness\Controller\Homepage as HomepageController;
use Hopelessness\Controller\User\Add as AddUserController;
use Hopelessness\Controller\User\Listing as ListUserController;
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

        $application['add-user'] = function(Application $application) {
            return new AddUserController(
                $application['orm'],
                $application['request']->request,
                $application['hash']
            );
        };

        $application['list-users'] = function(Application $application) {
            return new ListUserController(
                $application['users-repository']
            );
        };

        $application['view-user'] = function(Application $application) {
            return new ViewUserController();
        };
    }

    /**
     * {@inheritDoc}
     */
    public function boot(Application $application)
    {
    }

}
