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
        $this->user = new User();
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
     * @covers Hopelessness\Entity\User::checkCredential
     * @covers Hopelessness\Entity\User::setCredential
     * @group entity
     */
    public function testCredentialCanBeSetAndChecked()
    {
        $hashAlgorithm = $this->getMock('Hopelessness\\HashAlgorithm\\HashAlgorithm');

        $hashAlgorithm->expects($this->at(0))
            ->method('hash')
            ->with('test')
            ->will($this->returnValue('test hasted'));

        $hashAlgorithm->expects($this->at(1))
            ->method('hash')
            ->with('test')
            ->will($this->returnValue('test hasted'));

        $hashAlgorithm->expects($this->at(2))
            ->method('hash')
            ->with('asdf')
            ->will($this->returnValue('asdf hashed'));

        $this->user->setCredential('test', $hashAlgorithm);

        $this->assertTrue($this->user->checkCredential('test', $hashAlgorithm));
        $this->assertFalse($this->user->checkCredential('asdf', $hashAlgorithm));
    }

}
