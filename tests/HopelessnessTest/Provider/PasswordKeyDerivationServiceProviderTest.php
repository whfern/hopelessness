<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace HopelessnessTest\Provider;

use Hopelessness\Provider\PasswordKeyDerivationServiceProvider;
use PHPUnit_Framework_TestCase as TestCase;
use Silex\Application;

/**
 * Unit tests for the Hopelessness\Provider\PasswordKeyDerivationServiceProvider class
 */
class PasswordKeyDerivationServiceProviderTest extends TestCase
{

    /**
     * Password key derivation service provider
     *
     * @var PasswordKeyDerivationServiceProvider
     */
    protected $serviceProvider;

    /**
     * Setup the test case
     */
    public function setUp()
    {
        parent::setUp();

        $this->serviceProvider = new PasswordKeyDerivationServiceProvider();
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
     * Ensure the password key derivation service is created upon registration
     *
     * @covers Hopelessness\Provider\PasswordKeyDerivationServiceProvider::register
     */
    public function testPasswordKeyDerivationServiceIsCreatedUponRegistration()
    {
        $application = new Application();

        $this->serviceProvider->register($application);

        $this->assertInstanceOf(
            "Zend\\Crypt\\Password\\Bcrypt",
            $application["Zend\\Crypt\\Password\\Bcrypt"]
        );
    }

}
