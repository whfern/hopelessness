<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Character;

use Hopelessness\Character\Attack;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Unit tests for the attack class
 */
class AttackTest extends TestCase
{

    /**
     * Attack attribute
     *
     * @var Attack
     */
    protected $attack;

    /**
     * Setup the test case
     */
    public function setUp()
    {
        parent::setUp();

        $this->attack = new Attack(8);
    }

    /**
     * Tear down the test case
     */
    public function tearDown()
    {
        parent::tearDown();

        unset($this->attack);
    }

    /**
     * Ensure the raw attack value can be set and retrieved
     *
     * @covers Attack::__construct
     * @covers Attack::getRawValue
     */
    public function testRawAttackValueCanBeSetAndRetrieved()
    {
        $this->assertEquals(8, $this->attack->getRaw());
    }

}
