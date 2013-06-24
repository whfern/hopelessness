<?php
/**
 *
 */

namespace Hopelessness\Orm\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 *
 */
class AttachCharacterObservers implements EventSubscriber
{

    /**
     * {@inheritdoc}
     */
	public function getSubscribedEvents()
    {
        return array(
            Events::postLoad,
        );
    }

	/**
	 * Handle the post load event
	 *
	 * @param LifecycleEventArgs $args
	 */
	public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof Character) {
            $entity->setupObservers();
        }
    }

}
