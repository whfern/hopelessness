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
     * @param Closure $closure
     * @param array|Traversable $items
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

    /**
     * Reduce all the items in a traversable to a single value
     *
     * @param Closure $closure
     * @param array|Traversable $items
     * @param mixed $memo
     * @return mixed
     */
    static public function reduce(Closure $closure, $items, $memo = null)
    {
        foreach ($items as $item) {
            $memo = $closure($item, $memo);
        }
        return $memo;
    }

}
