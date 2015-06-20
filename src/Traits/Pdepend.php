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

trait Pdepend
{
    /**
     * Run Pdepend.
     * @return Robo\Result
     */
    public function taskPdepend()
    {
        Config::setDefault('pathsPdepend', (array) Config::get('pathsSrc'));

        $exec = $this->taskExec(Config::get('pathComposerBin').'/pdepend')
            ->arg('--jdepend-xml='.Config::get('pathBuildDir').'/logs/pdepend.xml')
            ->arg('--summary-xml='.Config::get('pathBuildDir').'/logs/pdepend-summary.xml')
            ->arg('--jdepend-chart='.Config::get('pathBuildDir').'/logs/dependencies.svg')
            ->arg('--overview-pyramid='.Config::get('pathBuildDir').'/logs/overview-pyramid.svg')
            ->arg(Config::get('pathsPdepend'));

        return $exec->run();
    }
}
