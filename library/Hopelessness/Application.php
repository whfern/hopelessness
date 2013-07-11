<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness;

use Hopelessness\Provider\AuthenticationAdapterServiceProvider;
use Hopelessness\Provider\AuthenticationMiddlewareServiceProvider;
use Hopelessness\Provider\AuthenticationServiceProvider;
use Hopelessness\Provider\ControllersServiceProvider;
use Hopelessness\Provider\DoctrineOrmServiceProvider;
use Hopelessness\Provider\PasswordKeyDerivationServiceProvider;
use Hopelessness\Provider\RepositoriesServiceProvider;
use Hopelessness\Provider\ServiceControllerServiceProvider;
use Silex\Application as SilexApplication;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Application
 */
class Application extends SilexApplication
{

    /**
     * Constructor
     *
     * @param array $values
     */
    public function __construct(array $values = array())
    {
        parent::__construct($values);

        $application = $this;

        $this["debug"] = true;

        Request::enableHttpMethodParameterOverride();

        $this->register(new ServiceControllerServiceProvider());

        $this->register(
            new DoctrineServiceProvider(),
            array(
                "db.options" => array(
                    "driver" => "pdo_sqlite",
                    "path"   => "../database/application.db",
                )
            )
        );

        $this->register(new AuthenticationMiddlewareServiceProvider())
            ->register(new AuthenticationServiceProvider())
            ->register(new AuthenticationAdapterServiceProvider())
            ->register(new ControllersServiceProvider())
            ->register(new DoctrineOrmServiceProvider())
            ->register(new PasswordKeyDerivationServiceProvider())
            ->register(new RepositoriesServiceProvider())
            ->register(new UrlGeneratorServiceProvider());

        $characterProvider = function($character) use ($application) {
            $entity = $application["Hopelessness\\Repository\\Characters"]->find($character);

            if (!$entity) {
                throw new HttpException(404, "Invalid character UUID");
            }

            return $entity;
        };

        $userProvider = function($user) use ($application) {
            $entity = $application["Hopelessness\Repository\Users"]->find($user);

            if (!$entity) {
                throw new HttpException(404, "Invalid user UUID");
            }

            return $entity;
        };

        $this->post("/users", "Hopelessness\\Controller\\User\\Create");
        $this->delete("/users/{user}", "Hopelessness\\Controller\\User\\Delete")->convert("user", $userProvider);
        $this->get("/users", "Hopelessness\\Controller\\User\\Listing");
        $this->get("/users/{user}", "Hopelessness\\Controller\\User\\Read")->convert("user", $userProvider);
        $this->match("/users/{user}", "Hopelessness\\Controller\\User\\Update")->method("PATCH")->convert("user", $userProvider);

        $this->post("/characters", "Hopelessness\\Controller\\Character\\Create");
        $this->delete("/characters/{character}", "Hopelessness\\Controller\\Character\\Delete")->convert("character", $characterProvider);
        $this->get("/characters", "Hopelessness\\Controller\\Character\\Listing");
        $this->get("/characters/{character}", "Hopelessness\\Controller\\Character\\Read")->convert("character", $characterProvider);
        $this->match("/characters/{character}", "Hopelessness\\Controller\\Character\\Update")->method("PATCH")->convert("character", $characterProvider);

        $application = $this;

        $this->before($application["Hopelessness\\Middleware\\Authentication"]);
    }

 }
