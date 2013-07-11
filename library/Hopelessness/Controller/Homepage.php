<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\Controller;

use ControllerInterface;

/**
 * Homepage controller
 */
class Homepage
{

    /**
     * {@inheritDoc}
     */
    public function __invoke()
    {
        return 'homepage';
    }

}
