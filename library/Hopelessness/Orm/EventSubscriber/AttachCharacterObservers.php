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
	 * Get the events for the subscriber
	 *
	 * @return array
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
			foreach ($entity->getItems() as $item) {
				$item->attachObserver($entity->getAttack());
				$item->attachObserver($entity->getDefense());
			}
        }
    }

}