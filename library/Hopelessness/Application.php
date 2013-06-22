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

        $this['debug'] = true;

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

        $this->get('/', 'homepage');
        $this->get('/users', 'list-users');
        $this->post('/users', 'add-user');
        $this->get('/users/{uuid}', 'view-user');
        $this->delete('/users/{uuid}', 'delete-user');
        $this->patch('/users/{uuid}', 'update-user');
    }

 }
