<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness\HashAlgorithm;

/**
 * Hash algorithm interface
 */
interface HashAlgorithm
{

    /**
     * Hash a string
     *
     * @param string $string
     * @return string
     */
    public function hash($string);

}
