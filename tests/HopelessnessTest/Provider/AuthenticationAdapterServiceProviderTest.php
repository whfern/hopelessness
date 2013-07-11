<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace HopelessnessTest\Provider;

use Hopelessness\Provider\AuthenticationAdapterServiceProvider;
use PHPUnit_Framework_TestCase as TestCase;
use Silex\Application;

/**
 * Unit tests for the Hopelessness\Provider\AuthenticationAdapterServiceProvider class
 */
class AuthenticationAdapterServiceProviderTest extends TestCase
{

    /**
     * Authentication adapter service provider
     *
     * @var AuthenticationAdapterServiceProvider
     */
    protected $serviceProvider;

    /**
     * Setup the test case
     */
    public function setUp()
    {
        parent::setUp();

        $this->serviceProvider = new AuthenticationAdapterServiceProvider();
    }

    /**
     * Tear down the test case
     */
    public function tearDown()
    {
        parent::tearDown();

        unset($this->serviceProvider);
    }

    /**
     * Ensure the authentication adapter service is created upon registration
     *
     * @covers Hopelessness\Provider\AuthenticationAdapterServiceProvider::register
     */
    public function testAuthenticationAdapterServiceIsCreatedUponRegistration()
    {
        $application = new Application();
        $application["Hopelessness\\Repository\\Users"] = $this->getMockBuilder("Hopelessness\\Repository\\Users")
            ->disableOriginalConstructor()
            ->getMock();

        $application["Zend\\Crypt\\Password\\Bcrypt"] = $this->getMockBuilder("Zend\\Crypt\\Password\\PasswordInterface")
            ->getMock();

        $this->serviceProvider->register($application);

        $this->assertInstanceOf(
            "Hopelessness\\Authentication\\Adapter\\Users",
            $application["Hopelessness\\Authentication\\Adapter\\Users"]
        );
    }

}
