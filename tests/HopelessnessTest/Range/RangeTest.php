<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace HopelessnessTest;

use \Hopelessness\Range\Range;
use \PHPUnit_Framework_TestCase as TestCase;

/**
 * Unit tests for the Hopelessness\Range\Range class
 */
class RangeTest extends TestCase
{

    /**
     * Ensure that the lower and upper parts of the range can be set and retrieved
     *
     * @covers Hopelessness\Range\Range::__construct
     * @covers Hopelessness\Range\Range::getLower
     * @covers Hopelessness\Range\Range::getUpper
     */
    public function testLowerAndUpperPartsOfRangeCanBeSetAndRetrieved()
    {
        $range = new Range(4, 100);

        $this->assertEquals(4, $range->getLower());
        $this->assertEquals(100, $range->getUpper());
    }

    /**
     * Ensure a random number can be selected from within the range
     *
     * @covers Hopelessness\Range\Range::getRandom
     */
    public function testRandomNumberCanBeSelectedFromWithinTheRange()
    {
        $range = new Range(1, 100);

        for ($i = 0; $i < 50; ++$i) {
            $random = $range->getRandom();

            $this->assertGreaterThanOrEqual(1, $random);
            $this->assertLessThanOrEqual(100, $random);
        }
    }

}
