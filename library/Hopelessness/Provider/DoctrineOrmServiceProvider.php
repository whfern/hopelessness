<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Provider;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Doctrine ORM service provider
 */
class DoctrineOrmServiceProvider implements ServiceProviderInterface
{

    /**
     * {@inheritDoc}
     */
    public function register(Application $application)
    {
        $application['orm'] = $application->share(function(Application $application) {
            $configuration = Setup::createAnnotationMetadataConfiguration(
                array('./library/Hopelessness/Entity'),
                true
            );

            return EntityManager::create(
                $application['db'],
                $configuration
            );
        });
    }

    /**
     * {@inheritDoc}
     */
    public function boot(Application $application)
    {
    }

}
