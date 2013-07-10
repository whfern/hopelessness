<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace HopelessnessTest\Entity;

use Hopelessness\Entity\User;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Unit tests for the user entity
 */
class UserTest extends TestCase
{

    /**
     * User entity
     *
     * @var User
     */
    protected $user;

    /**
     * Setup the test case
     */
    public function setUp()
    {
        parent::setUp();

        $this->user = new User();
    }

    /**
     * Tear down the test case
     */
    public function tearDown()
    {
        parent::tearDown();

        unset($this->user);
    }

    /**
     * Ensure that characters can be added and retrieved for the user
     *
     * @covers Hopelessness\Entity\User::addCharacter
     * @covers Hopelessness\Entity\User::getCharacters
     * @group entity
     */
    public function testCharacterCanBeAddedAndRetrieved()
    {
        $character = $this->getMock('Hopelessness\\Entity\\Character');
        $this->assertNotContains($character, $this->user->getCharacters());

        $this->user->addCharacter($character);
        $this->assertContains($character, $this->user->getCharacters());
    }

    /**
     * Ensure that the identity can be set and retrieved for the user
     *
     * @covers Hopelessness\Entity\User::getIdentity
     * @covers Hopelessness\Entity\User::setIdentity
     * @group entity
     */
    public function testIdentityCanBeSetAndRetrieved()
    {
        $this->user->setIdentity('test');

        $this->assertEquals('test', $this->user->getIdentity());
    }

    /**
     * Ensure that the credential can be set and checked for the user
     *
     * @covers Hopelessness\Entity\User::getCredential
     * @covers Hopelessness\Entity\User::setCredential
     * @group entity
     */
    public function testCredentialCanBeSetAndChecked()
    {
        $this->user->setCredential('test');

        $this->assertEquals('test', $this->user->getCredential());
    }

}
