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
use \Robo\Output;
use \Robo\Task\Exec;
use \Robo\Result;

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
}
