<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness;

use Closure;

/**
 * Traversable helper class
 */
class Traversable
{

    /**
     * Map all the items in a traversable
     *
     * @return array
     */
    static public function map(Closure $closure, $items)
    {
        $results = array();
        foreach ($items as $item) {
            $results[] = $closure($item);
        }
        return $results;
    }

}
