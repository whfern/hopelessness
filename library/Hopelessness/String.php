<?php
/**
 * Office of Hopelessness
 *
 * @author Justin Hendrickson <justin.hendrickson@gmail.com>
 */

namespace Hopelessness;

/**
 * String helper functions
 */
class String
{

    /**
     * Constant time string comparison
     *
     * @param string $a
     * @param string $b
     * @return boolean
     */
    static public function constantTimeComparison($a, $b)
    {
        $length = max(strlen($a), strlen($b));

        $valid = true;
        for ($i = 0; $i < $length; ++$i) {
            $valid = $valid && (isset($a[$i]) && isset($b[$i]) && $a[$i] == $b[$i]);
        }

        return $valid;
    }

}
