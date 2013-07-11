<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace HopelessnessTest\Authentication\Adapter;

use Hopelessness\Authentication\Adapter\Users;
use Hopelessness\Repository\Users as UsersRepository;
use PHPUnit_Framework_TestCase as TestCase;
use Zend\Authentication\Result;
use Zend\Crypt\Password\PasswordInterface;

/**
 *
 */
class UsersTest extends TestCase
{

    /**
     * Users authentication adapter
     *
     * @var Users
     */
    protected $adapter;

    /**
     * Password provider
     *
     * @var PasswordInterface
     */
    protected $password;

    /**
     * Users repository
     *
     * @var UsersRepository
     */
    protected $usersRepository;

    /**
     * Setup the test case
     */
    public function setUp()
    {
        parent::setUp();

        $this->usersRepository = $this->getMockBuilder("Hopelessness\\Repository\\Users")
            ->disableOriginalConstructor()
            ->setMethods(array("findByIdentity"))
            ->getMock();

        $this->password = $this->getMock("Zend\\Crypt\\Password\\PasswordInterface");

        $this->adapter = new Users($this->usersRepository, $this->password);
    }

    /**
     * Tear down the test case
     */
    public function tearDown()
    {
        parent::tearDown();

        unset($this->adapter);
        unset($this->password);
        unset($this->usersRepository);
    }

    /**
     * Ensure the adapter returns a failure if the identity is not found in the repository
     *
     * @covers Hopelessness\Authentication\Adapter\Users::__construct
     * @covers Hopelessness\Authentication\Adapter\Users::authenticate
     * @group authentication
     */
    public function testFailureIfIdentityIsNotFoundInRepository()
    {
        $this->usersRepository
            ->expects($this->once())
            ->method("findByIdentity")
            ->with("invalid")
            ->will($this->returnValue(null));

        $result = $this->adapter
            ->setIdentity("invalid")
            ->authenticate();

        $this->assertEquals(
            Result::FAILURE_IDENTITY_NOT_FOUND,
            $result->getCode()
        );
    }

    /**
     * Ensure the adapter returns a failure if the credentials do not match
     *
     * @covers Hopelessness\Authentication\Adapter\Users::__construct
     * @covers Hopelessness\Authentication\Adapter\Users::authenticate
     * @group authentication
     */
    public function testFailureIfCredentialsDoNotMatch()
    {
        $user = $this->getMock("Hopelessness\\Entity\\User");
        $user->expects($this->once())
            ->method("getCredential")
            ->will($this->returnValue("credential"));

        $this->usersRepository
            ->expects($this->once())
            ->method("findByIdentity")
            ->with("identity")
            ->will($this->returnValue($user));

        $this->password
            ->expects($this->once())
            ->method("verify")
            ->with("invalid-credential", "credential")
            ->will($this->returnValue(false));

        $result = $this->adapter
            ->setIdentity("identity")
            ->setCredential("invalid-credential")
            ->authenticate();

        $this->assertEquals(
            Result::FAILURE_CREDENTIAL_INVALID,
            $result->getCode()
        );
    }

    /**
     * Ensure the adapter returns success if the identity and credential are correct
     *
     * @covers Hopelessness\Authentication\Adapter\Users::__construct
     * @covers Hopelessness\Authentication\Adapter\Users::authenticate
     * @group authentication
     */
    public function testSuccessIfIdentityAndCredentialAreCorrect()
    {
        $user = $this->getMock("Hopelessness\\Entity\\User");

        $user->expects($this->once())
            ->method("getCredential")
            ->will($this->returnValue("credential"));

        $this->usersRepository
            ->expects($this->once())
            ->method("findByIdentity")
            ->with("identity")
            ->will($this->returnValue($user));

        $this->password
            ->expects($this->once())
            ->method("verify")
            ->with("credential", "credential")
            ->will($this->returnValue(true));

        $result = $this->adapter
            ->setIdentity("identity")
            ->setCredential("credential")
            ->authenticate();

        $this->assertEquals(
            Result::SUCCESS,
            $result->getCode()
        );

        $this->assertSame(
            $user,
            $result->getIdentity()
        );
    }

}
