<?php
/**
 *
 */

namespace Hopelessness\StatusEffect;
 
/**
 *
 */
interface StatusEffectObserver
{

	/**
	 * Notify the observer of a change to the status effect
	 *
	 * @param StatusEffect $statusEffect
	 * @return self
	 */
	public function updateStatusEffect(StatusEffect $statusEffect);
	

}