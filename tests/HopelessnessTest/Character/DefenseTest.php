<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Character;

use Hopelessness\Character\Defense;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Unit tests for the defense class
 */
class DefenseTest extends TestCase
{

    /**
     * Defense attribute
     *
     * @var Defense
     */
    protected $defense;

    /**
     * Setup the test case
     */
    public function setUp()
    {
        parent::setUp();

        $this->defense = new Defense(8);
    }

    /**
     * Tear down the test case
     */
    public function tearDown()
    {
        parent::tearDown();

        unset($this->defense);
    }

    /**
     * Ensure the raw value can be set and retrieved
     *
     * @covers Hopelessness\Character\Defense::__construct
     * @covers Hopelessness\Character\Defense::getRaw
     */
    public function testRawValueCanBeSetAndRetrieved()
    {
        $this->assertEquals(8, $this->defense->getRaw());
    }

}
