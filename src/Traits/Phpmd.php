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

trait Phpmd
{
    /**
     * Run PHPMD.
     * @return Robo\Result
     */
    public function taskPhpmd()
    {
        Config::setDefault('pathsPhpmd', array_merge(
            (array) Config::get('pathsSrc'),
            (array) Config::get('pathsTests')
        ));

        Config::setDefault('phpmdRuleset', 'cleancode,codesize,design,naming,unusedcode');

        // Use XML logs in CI.
        $format = 'text';
        if ((bool) getenv('CI')) {
            $format = 'xml';
        }

        $exec = $this->taskExec(Config::get('pathComposerBin').'/phpmd')
            ->arg(implode(Config::get('pathsPhpmd'), ','))
            ->arg($format)
            ->arg(Config::get('phpmdRuleset'));

        // Set log path in CI.
        if ((bool) getenv('CI')) {
            $exec->option('reportfile', Config::get('pathBuildDir').'/logs/phpmd.xml');
        }

        return $exec->run();
    }
}
