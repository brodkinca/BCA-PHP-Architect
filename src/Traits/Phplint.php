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

trait Phplint
{
    /**
     * Run PHP linter.
     * @return Robo\Result
     */
    public function taskPhplint()
    {
        Config::setDefault('pathsPhplint', array_merge(
            (array) Config::get('pathsSrc'),
            (array) Config::get('pathsTests')
        ));

        return $this->taskExec('php')
            ->arg('-l')
            ->arg(Config::get('pathsPhplint'))
            ->run();
    }

    /**
     * Boot phplint trait.
     * @return void
     */
    protected function bootPhplint()
    {
        // Set weights.
        Architect::setWeight('taskPhplint', Architect::WEIGHT_PRE);
    }
}
