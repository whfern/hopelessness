<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace HopelessnessTest\Entity;

use Hopelessness\Entity\User;
use PHPUnit_Framework_TestCase as TestCase;
use ReflectionObject;

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
     * Ensure a user has no characters by default
     *
     * @covers Hopelessness\Entity\User::__construct
     * @covers Hopelessness\Entity\User::getCharacters
     * @group entity
     */
    public function testAUserHasNoCharactersByDefault()
    {
        $this->assertEmpty($this->user->getCharacters());
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
        $character = $this->getMock("Hopelessness\\Entity\\Character");
        $this->assertNotContains($character, $this->user->getCharacters());

        $character->expects($this->once())
            ->method("getUser")
            ->will($this->returnValue($this->user));

        $this->user->addCharacter($character);
        $this->assertContains($character, $this->user->getCharacters());
    }

    /**
     * Ensure adding a duplicate character throws a runtime exception
     *
     * @covers Hopelessness\Entity\User::addCharacter
     * @group entity
     */
    public function testAddingADuplicateCharacterThrowsARuntimeException()
    {
        $character = $this->getMock("Hopelessness\\Entity\\Character");

        $character->expects($this->once())
            ->method("getUser")
            ->will($this->returnValue($this->user));

        $this->setExpectedException("RuntimeException");

        $this->user
            ->addCharacter($character)
            ->addCharacter($character);
    }

    /**
     * Ensure adding a character a different user owns throws a runtime exception
     *
     * @covers Hopelessness\Entity\User::addCharacter
     * @group entity
     */
    public function testAddingACharacterADifferentUserOwnsThrowsARuntimeException()
    {
        $user = $this->getMock("Hopelessness\\Entity\\User");

        $character = $this->getMock("Hopelessness\\Entity\\Character");

        $character->expects($this->once())
            ->method("getUser")
            ->will($this->returnValue($user));

        $this->setExpectedException("RuntimeException");

        $this->user
            ->addCharacter($character);
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
        $this->user->setIdentity("test");

        $this->assertEquals("test", $this->user->getIdentity());
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
        $this->user->setCredential("test");

        $this->assertEquals("test", $this->user->getCredential());
    }

    /**
     * Ensure the UUID can be retrieved for the user
     *
     * @covers Hopelessness\Entity\User::getUuid
     * @group entity
     */
    public function testUuidCanBeRetreived()
    {
        $refObj = new ReflectionObject($this->user);
        $refProp = $refObj->getProperty("uuid");
        $refProp->setAccessible(true);
        $refProp->setValue($this->user, "1234");
        $refProp->setAccessible(false);

        $this->assertEquals("1234", $this->user->getUuid());
    }

}
