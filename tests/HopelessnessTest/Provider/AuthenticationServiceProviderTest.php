<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace HopelessnessTest\Provider;

use Hopelessness\Provider\AuthenticationServiceProvider;
use Silex\Application;
use PHPUnit_Framework_TestCase as TestCase;
use Zend\Authentication\AuthenticationService;

/**
 * Unit tests for the Hopelessness\Provider\AuthenticationServiceProviderTest class
 */
class AuthenticationServiceProviderTest extends TestCase
{

    /**
     * Authentication service provider
     *
     * @var AuthenticationServiceProvider
     */
    protected $serviceProvider;

    /**
     * Setup the test case
     */
    public function setUp()
    {
        parent::setUp();

        $this->serviceProvider = new AuthenticationServiceProvider();
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
     * Ensure the authentication service is created upon registration
     *
     * @covers Hopelessness\Provider\AuthenticationServiceProvider::register
     */
    public function testAuthenticationServiceIsCreatedUponRegistration()
    {
        $application = new Application();
        $application["Hopelessness\\Authentication\\Adapter\\Users"] = $this->getMockBuilder("Hopelessness\\Authentication\\Adapter\\Users")
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceProvider->register($application);

        $this->assertInstanceOf(
            "Zend\\Authentication\\AuthenticationService",
            $application["Zend\\Authentication\\AuthenticationService"]
        );

        $this->assertSame(
            $application["Hopelessness\\Authentication\\Adapter\\Users"],
            $application["Zend\\Authentication\\AuthenticationService"]->getAdapter()
        );
    }

}
