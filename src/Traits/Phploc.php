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

trait Phploc
{
    /**
     * Run PHPLOC.
     * @return Robo\Result
     */
    public function taskPhploc()
    {
        Config::setDefault('pathsPhploc', (array) Config::get('pathsSrc'));

        return $this->taskExec(Config::get('pathComposerBin').'/phploc')
            ->option('log-xml', Config::get('pathBuildDir').'/logs/phploc.xml')
            ->arg(Config::get('pathsPhploc'))
            ->run();
    }

    /**
     * Boot phploc trait.
     * @return void
     */
    protected function bootPhploc()
    {
        // Set weights.
        Architect::setWeight('taskPhploc', Architect::WEIGHT_POST);
    }
}
