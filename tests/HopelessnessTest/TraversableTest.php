<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace HopelessnessTest;

use \Hopelessness\Traversable;
use \PHPUnit_Framework_TestCase as TestCase;

/**
 * Unit tests for the Hopelessness\Traversable class
 */
class TraversableTest extends TestCase
{

    /**
     * Ensure that traversables can be mapped
     *
     * @covers Hopelessness\Traversable::map
     */
    public function testTraversablesCanBeMapped()
    {
        $items = array(1, 2, 3, 4);

        $results = Traversable::map(function($item) {
            return $item . 'a';
        }, $items);

        $this->assertEquals(array('1a', '2a', '3a', '4a'), $results);
    }

    /**
     * Ensure that traversables can be reduced
     *
     * @covers Hopelessness\Traversable::reduce
     */
    public function testTraversableCanBeReduced()
    {
        $result = Traversable::reduce(function($item, $memo) {
            return $memo + $item;
        }, array(1, 2, 3, 4));

        $this->assertEquals(10, $result);
    }

}
