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

use \BCA\Architect\Config;

trait Codeception
{
    /**
     * Run Codeception.
     *
     * @param string $suite Name of test suite to run.
     *
     * @return Robo\Result
     */
    public function taskTest($suite = null)
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

        return $codecept->run();
    }
}
