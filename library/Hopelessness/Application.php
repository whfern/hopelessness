<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness;

use Hopelessness\Provider\ControllersServiceProvider;
use Hopelessness\Provider\DoctrineOrmServiceProvider;
use Hopelessness\Provider\HashingAlgorithmServiceProvider;
use Hopelessness\Provider\RepositoriesServiceProvider;
use Hopelessness\Provider\ServiceControllerServiceProvider;
use Silex\Application as SilexApplication;
use Silex\Provider\DoctrineServiceProvider;
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

        $this['debug'] = true;

        Request::enableHttpMethodParameterOverride();

        $this->register(new ServiceControllerServiceProvider());

        $this->register(
            new DoctrineServiceProvider(),
            array(
                'db.options' => array(
                    'driver' => 'pdo_sqlite',
                    'path'   => '../database/application.db',
                )
            )
        );

        $this->register(new ControllersServiceProvider())
            ->register(new DoctrineOrmServiceProvider())
            ->register(new HashingAlgorithmServiceProvider())
            ->register(new RepositoriesServiceProvider());

        $userProvider = function($user) use ($application) {
            $entity = $application['users-repository']->find($user);

            if (!$entity) {
                throw new HttpException(404, 'Invalid user UUID');
            }

            return $entity;
        };

        $this->get('/', 'homepage');
        $this->get('/users', 'list-users');
        $this->post('/users', 'add-user');
        $this->get('/users/{user}', 'view-user')->convert('user', $userProvider);
        $this->delete('/users/{user}', 'delete-user')->convert('user', $userProvider);
        $this->match('/users/{user}', 'update-user')->method('PATCH')->convert('user', $userProvider);
    }

 }
