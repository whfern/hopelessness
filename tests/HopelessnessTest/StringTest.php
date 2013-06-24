<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace HopelessnessTest;

use \Hopelessness\String;
use \PHPUnit_Framework_TestCase as TestCase;

/**
 * Unit tests for the Hopelessness\String class
 */
class StringTest extends TestCase
{

    /**
     * Ensure that the constant time string comparison function compares strings correctly
     *
     * @covers Hopelessness\String::constantTimeComparison
     */
    public function testConstantTimeStringComparisonCanBeDone()
    {
        $this->assertTrue(String::constantTimeComparison('asdfasdf', 'asdfasdf'));
        $this->assertFalse(String::constantTimeComparison('asdf', 'asdfasdf'));
        $this->assertFalse(String::constantTimeComparison('asdfasdf', 'asdf'));
        $this->assertFalse(String::constantTimeComparison('asdf', 'fdsa'));
    }

}
