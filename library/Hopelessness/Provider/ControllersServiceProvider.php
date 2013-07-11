<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Provider;

use Hopelessness\Controller\User\Create as CreateUserController;
use Hopelessness\Controller\User\Delete as DeleteUserController;
use Hopelessness\Controller\User\Listing as ListUserController;
use Hopelessness\Controller\User\Read as ReadUserController;
use Hopelessness\Controller\User\Update as UpdateUserController;
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
        $application["Hopelessness\\Controller\\User\\Create"] = function(Application $application) {
            return new CreateUserController(
                $application["Zend\\Authentication\\AuthenticationService"],
                $application["Doctrine\\ORM\\EntityManager"],
                $application["request"]->request,
                $application["Zend\\Crypt\\Password\\Bcrypt"],
                $application["url_generator"]
            );
        };

        $application["Hopelessness\\Controller\\User\\Delete"] = function(Application $application) {
            return new DeleteUserController(
                $application["Zend\\Authentication\\AuthenticationService"],
                $application["Doctrine\\ORM\\EntityManager"]
            );
        };

        $application["Hopelessness\\Controller\\User\\Listing"] = function(Application $application) {
            return new ListUserController(
                $application["Zend\\Authentication\\AuthenticationService"],
                $application["Hopelessness\\Repository\\Users"]
            );
        };

        $application["Hopelessness\\Controller\\User\\Read"] = function(Application $application) {
            return new ReadUserController(
                $application["Zend\\Authentication\\AuthenticationService"]
            );
        };

        $application["Hopelessness\\Controller\\User\\Update"] = function(Application $application) {
            return new UpdateUserController(
                $application["Zend\\Authentication\\AuthenticationService"],
                $application["Doctrine\\ORM\\EntityManager"],
                $application["request"]->request,
                $application["Zend\\Crypt\\Password\\Bcrypt"]
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
