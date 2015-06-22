<?php
/**
 * Brodkin CyberArts Website
 *
 * @package    robo
 * @subpackage bca/architect
 * @author     Brodkin CyberArts <info@brodkinca.com>
 * @copyright  2015 Brodkin CyberArts
 */

namespace BCA\Architect\Traits;

use \BCA\Architect\Architect;
use \BCA\Architect\Config;

trait Codeception
{
    /**
     * Run Codeception.
     *
     * @param string $suite Name of test suite to run.
     * @param array  $args  Array of arguments.
     *
     * @return Robo\Result
     */
    public function taskTest($suite = null, array $args = [])
    {
        $codecept = $this->taskCodecept()
            ->coverage()
            ->coverageHtml()
            ->coverageXml()
            ->html()
            ->xml();

        if (!empty($suite)) {
            $codecept->suite($suite);
        }

        // Show debug information?
        if (isset($args['verbose']) && $args['verbose']) {
            $codecept->debug();
        }

        return $codecept->run();
    }

    /**
     * Boot codeception trait.
     * @return void
     */
    protected function bootCodeception()
    {
        // Set weights.
        Architect::setWeight('taskTest', 60);
    }
}
