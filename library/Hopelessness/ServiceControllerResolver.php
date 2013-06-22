<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness;

use Silex\Application as SilexApplication;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;

/**
 * Service controller resolver
 */
class ServiceControllerResolver implements ControllerResolverInterface
{

    /**
     * Application
     *
     * @var Application
     */
    protected $application;

    /**
     * Controller resolver
     *
     * @var ControllerResolverInterface
     */
    protected $resolver;

    /**
     * Constructor
     *
     * @param ControllerResolverInterface $resolver
     * @param SilexApplication $application
     */
    public function __construct(ControllerResolverInterface $resolver, SilexApplication $application)
    {
        $this->resolver    = $resolver;
        $this->application = $application;
    }

    /**
     * {@inheritdoc}
     */
    public function getController(Request $request)
    {
        $controller = $request->attributes
            ->get('_controller', null);

        if (!is_string($controller)) {
            return $this->resolver
                ->getController($request);
        }

        return $this->application[$controller];
    }

    /**
     * {@inheritdoc}
     */
    public function getArguments(Request $request, $controller)
    {
        return $this->resolver->getArguments($request, $controller);
    }

}
